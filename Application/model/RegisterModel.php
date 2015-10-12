<?php

class RegisterModel {
    
    private static $UserDAL;
    
    public function __construct($DAL){
        self::$UserDAL = $DAL;
    }
    
    public function Register($Username, $Password, $PasswordCheck){
        
        if (self::ValidateData($Username, $Password, $PasswordCheck)){
            //hashing the password before going to the DAL just to make sure no bugg in the DAL will cause an unhased password to be stored.
            //using the default salt+username to make sure that 2 people with diffrent usernames but same passwords dont get the same hash.
            self::$UserDAL -> AddUser($Username, sha1(file_get_contents("../Data/salt.txt")+$Username.$Password));
        }
    }
    
    private function ValidateData($Username, $Password, $PasswordCheck){
        //get all the users to check if username allready exists, if $RegisterdUsers == false then the .bin is empty
        $RegisterdUsers = self::$UserDAL -> getUnserializedUsers();
        if($RegisterdUsers != false){
            foreach($RegisterdUsers as $Ruser){
                if($Username == $Ruser -> getUserName()){
                    throw new RegisterModelException("User exists, pick another username.");
                }
            }
        }
        
        //character validation
        if($Username != strip_tags($Username)){
            throw new RegisterModelException("Username contains invalid characters.");
        }
        if($Password != strip_tags($Password)){
            throw new RegisterModelException("Password contains invalid characters.");
        }
        if($Password != $PasswordCheck){
            throw new RegisterModelException("Passwords do not match.");
        }
        if(strlen($Username) < 3){
            if(strlen($Password) < 6){
                throw new RegisterModelException("Username has too few characters, at least 3 characters. <br/>Password has too few characters, at least 6 characters.");
            }
            throw new RegisterModelException("Username has too few characters, at least 3 characters.");
        }
        if(strlen($Password) < 6){
            throw new RegisterModelException("Password has too few characters, at least 6 characters.");
        }

        return true;
    }
}


/**
 * Custom exceptions for code optimization in the controller.
 */
class RegisterModelException extends Exception
{}