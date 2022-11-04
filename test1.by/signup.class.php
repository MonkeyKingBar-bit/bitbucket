<?php

$user = new RegisterUser($_POST['username'], $_POST['login'], $_POST['email'],
    $_POST['password'], $_POST['password_confirm']) ;

class RegisterUser {
    private $username;
    private $login;
    private $email;
    private $raw_password;
    private $password_confirm;
    private $encrypted_password;
    private $storage = "db/data.json";
    private $stored_users; // array
    private $new_user; // array

    public function __construct($username, $login, $email, $password, $password_confirm){
        $this->login = filter_var(trim($login), FILTER_SANITIZE_STRING);
        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->username = filter_var(trim($username), FILTER_SANITIZE_STRING);
        $this->email = filter_var(trim($email), FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);
        $this->password_confirm = filter_var(trim($password_confirm), FILTER_SANITIZE_STRING);
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->new_user = [
            "username" => $this->username,
            "login" => $this->login,
            "email" => $this->email,
            "password" => $this->encrypted_password,
        ];

        if($this->checkFieldValues()) {
            if ($this->raw_password !== $this->password_confirm) {
                $response = [
                    "status" => false,
                    "message" => 'Password and Confirm password should match!',
                ];
                echo json_encode($response);
            } else {
                $this->insertUser();
            }
        }
    }

    private function checkFieldValues(){
        if ($this->login === '') $error[] = 'login';
        if ($this->raw_password === '') $error[] = 'password';
        if ($this->username === '') $error[] = 'username';
        if ($this->email === '' || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) $error[] = 'email';
        if ($this->password_confirm === '') $error[] = 'password_confirm';
        if (!empty($error)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => 'Check data in fields!',
                "fields" => $error
            ];
            echo json_encode($response);
            die();
        }
        if (!preg_match("/^[a-zA-Z]{2,}$/", $this->username)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => 'Username must must have more than 2 chars and letters!',
                "fields" => ["username"]
            ];
            echo json_encode($response);
            die();
        } elseif (!preg_match("/^[a-zA-Z0-9]{6,}$/", $this->login)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => 'Login must have more than 6 chars, letters and digits!',
                "fields" => ["login"]
            ];
            echo json_encode($response);
            die();
        }
        if (!preg_match("/^(?=.*\d)[a-zA-Z].{5,}(?!.*\s).*$/", $this->raw_password)) {
            $response = [
                "status" => false,
                "type" => 1,
                "message" => 'Password must have more than 6 chars, letters and digits!',
                "fields" => ["password"]
            ];
            echo json_encode($response);
            die();
        }
       return true;
    }

    private function usernameExists(){
            foreach ($this->stored_users as $user) {
                if ($this->email == $user['email'] || $this->login == $user['login']){
                    $response = [
                        "status" => false,
                        "type" => 1,
                        "message" => 'E-mail or login already taken, please choose a different one.',
                        "fields" => ["email", "login"]
                    ];
                    echo json_encode($response);
                    die();
                }
            }
            return false;
    }

    private function insertUser(){
        if(!$this->usernameExists()){
            $this->stored_users[] = $this->new_user;
            if (file_put_contents($this->storage, json_encode($this->stored_users))) {
                $response = [
                    "status" => true,
                    "message" => 'Your registration was successful',
                ];
                echo json_encode($response);
                die();
            } else {
                $response = [
                    "status" => false,
                    "message" => 'Something went wrong, please try again'
                ];
                echo json_encode($response);
            }
        }
    }
}