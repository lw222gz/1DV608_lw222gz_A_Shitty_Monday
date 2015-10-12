<?php

class User{
    private $Name;
    private $Password;
    
    public function __construct($userName, $password){
        $this -> Name = $userName;
        $this -> Password = $password;
    }
    
    public function getUserName(){
        return $this -> Name;
    }
    
    public function getHasedPassword(){
        return $this -> Password;
    }
    
}