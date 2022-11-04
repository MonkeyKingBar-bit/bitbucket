<?php

$user = new LoginUser($_POST['login'], $_POST['password']);

class LoginUser {
    private $login;
    private $password;
    private $storage = "db/data.json";
    private $stored_users;

    public function __construct($login, $password){
        $this->login = $login;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->logIn();
    }

    private function logIn(){
            foreach ($this->stored_users as $user) {
                if($this->login === '') $error[] = 'login';
                if($this->password === '') $error[] = 'password';
                if (!empty($error)) {
                    $response = [
                        "status" => false,
                        "type" => 1,
                        "message" => 'Check data in fields!',
                        "fields" => $error
                    ];
                    echo json_encode($response);
                    die();
                } else {
                    if($user['login'] === $this->login){
                        if(password_verify($this->password, $user['password'])){
                            session_start();
                            $_SESSION['user'] = $this->login;
                            $response = [
                                "status" => true,
                                "message" => 'Your signin is successful!',

                            ];
                            echo json_encode($response);
                        } else {
                            $response = [
                                "status" => false,
                                "message" => 'Wrong username or password'
                            ];
                            echo json_encode($response);
                            die();
                        }
                    }
                }
        }
    }

}