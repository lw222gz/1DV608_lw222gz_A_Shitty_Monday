<?php


class LoginModel {
    
    private static $UserDAL;
    private static $isLoggedin = "isLoggedin";
    
    
    public function __construct($DAL){
        self::$UserDAL = $DAL;
        //if the session isent set yet, I give it default value false so that any if-statements later on wont crash due to an undefined session.
        if(!isset($_SESSION[self::$isLoggedin])){
            $_SESSION[self::$isLoggedin] = false;
        }
    }
    
    //Takes the given data and throws a proper Exception if anything is wrong, 
    //otherwise returns @boolean
    public function CheckLoginInfo($UserN, $Pass) {
        
        $RegisterdUsers = self::$UserDAL -> getUnserializedUsers();
        //if $RegisterdUsers is false then the .bin is empty
        if($RegisterdUsers == false){
            throw new LoginModelException("No registerd users yet");
        }
        
        //When an Exception is thrown, the controller will pick that exception up, 
        //pass it on to the view that uses the message in the exception to present it to the user.
        if(empty($UserN)){
            throw new LoginModelException('Username is missing');
        }
        else if(empty($Pass)){
            throw new LoginModelException('Password is missing');
        }
        //If this session allready exsists and is true, then it's a repost, 
        //if it's a repost I throw an empty error to remove the StatusMessage
        else if(isset($_SESSION[self::$isLoggedin]) && $_SESSION[self::$isLoggedin] == true){
                throw new LoginModelException();
        }
        
        //Otherwise it's the origninal login and the user credentials will be checked.
        foreach ($RegisterdUsers as $Ruser){
            if($UserN == $Ruser -> getUserName()){
                if(sha1(file_get_contents("../Data/salt.txt")+$UserN.$Pass) == $Ruser -> getHasedPassword()){
                    //--
                    $_SESSION["LoggedInUser"] = $UserN;
                    //$_SESSION[$_SESSION["LoggedInUser"]] = $UserN;
                    //--
                    $_SESSION[self::$isLoggedin] = true;
                    break;
                }
            }
        }
        if(!$_SESSION[self::$isLoggedin]){
            throw new LoginModelException('Wrong name or password');
        }
    }

    
    //@returns boolean, 
    //true if logged in, false if not logged in.
    public function getLoginStatus(){
        if(isset($_SESSION[self::$isLoggedin])){
            return $_SESSION[self::$isLoggedin];
        }
        else{
            return false;
        }
    }
    
    //Logs the user out of the system
    public function LogOut(){
        //If this session allready exsists and it's value is false, then it's a repost, 
        //if it's a repost I throw an empty error to remove the StatusMessage
        if (isset($_SESSION[self::$isLoggedin]) && !$_SESSION[self::$isLoggedin]){
            throw new LoginModelException();
        }
    
        unset($_SESSION["LoggedInUser"]);
        //Otherwise the person just logged out and the bye bye message will be shown.
        $_SESSION[self::$isLoggedin] = false;
    }
}



/**
 * Custom error for code optimization in the controller
 */
class LoginModelException extends Exception
{}
