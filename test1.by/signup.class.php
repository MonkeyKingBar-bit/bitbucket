<?php

class RegisterUser
{
    // class properties.
    private $username;
    private $login;
    private $email;
    private $raw_password;
    private $password_confirm;
    private $encrypted_password;
    public $error;
    public $success;
    private $storage = "data.json";
    private $stored_users; // array
    private $new_user; // array

    public function __construct($username, $login, $email, $password, $password_confirm){
        $this->username = filter_var(trim($username), FILTER_SANITIZE_STRING);
        $this->login = filter_var(trim($login), FILTER_SANITIZE_STRING);
        $this->email = filter_var(trim($email), FILTER_SANITIZE_STRING);
        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->password_confirm = filter_var(trim($password_confirm), FILTER_SANITIZE_STRING);
        $this->encrypted_password = password_hash($this->raw_password, PASSWORD_DEFAULT);
        $this->stored_users = json_decode(file_get_contents($this->storage), true);
        $this->new_user = [
            "username" => $this->username,
            "login" => $this->login,
            "email" => $this->email,
            "password" => $this->encrypted_password,
        ];

        if($this->checkFieldValues()){
            if($this->raw_password !== $this->password_confirm) {
                return $this->error = "Password and Confirm password should match!";
            } else {
                $this->insertUser();
            }
        }
    }

    private function checkFieldValues(){
        if(empty($this->username) || empty($this->login) || empty($this->email) ){
            $this->error = "Please fill all required fields!";
            return false;
        } else {
            return true;
        }
    }

    private function usernameExists(){
            foreach ($this->stored_users as $user) {
                if($this->username == $user['username']){
                    $this->error = "Username already taken, please choose a different one.";
                    return true;
                }
            }
            return false;
    }

    private function insertUser(){
        if(!$this->usernameExists()){
            $this->stored_users[] = $this->new_user;
            if (file_put_contents($this->storage, json_encode($this->stored_users))) {
                return $this->success = "Your registration was successful";
            } else {
               return  $this->error = "Something went wrong, please try again";
            }
        }
    }
}