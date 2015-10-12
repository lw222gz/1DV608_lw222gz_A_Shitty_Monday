<?php


class LoginController {
    
    //LoginView object
    private $v;
    //LoginModel object
    private $lm;
    //RegisterView object.
    private $rv;
    //RegisterModel object
    private $rm;

    
    //sets the object references.
    public function __construct($v, $lm, $rv, $rm){
        $this -> v = $v;
        $this -> lm = $lm;
        $this -> rv = $rv;
        $this -> rm = $rm;
    }
    
    //Initiate function that checks for button clicks.
    public function init(){
        try {
            if($this -> rv -> hasPressedRegister()){
                self::RegisterNewUser();
            }
            
            if ($this -> v -> hasPressedLogin())
            {
                self::LogIn();
            }
            
            else if($this -> v -> hasPressedLogOut()){
                self::LogOut();
            }
        }
        catch (LoginModelException $e){
            $this -> v -> setStatusMessage($e);
        }
        catch (RegisterModelException $e){
            $this -> rv -> setErrorMessage($e);
        }
        catch (Exception $e){
            echo "An unhandeld exception was thrown. Please infrom...";
        }
    }
    
    
   private function RegisterNewUser(){
        //validates input data and registers a user.
        $RegisterUserName = $this -> rv -> getRequestUserName();
        $this -> rm -> Register($RegisterUserName, $this -> rv -> getRequestPassword(), $this -> rv -> getRequestPasswordCheck());

        $_SESSION["newUser"] = $RegisterUserName;
        
        //redirects user to index page
        header("Location: ?");
    }
    
    //tries to log in the user
    private function LogIn(){
        $this -> lm -> CheckLoginInfo($this -> v -> getRequestUserName(), $this -> v -> getRequestUserPassword());

        //On the original log in, it shows the Welcome message
        $this -> v -> JustLoggedIn();
    }
    
    //Logs out the user
    private function LogOut(){
        $this -> lm -> LogOut();
        
        //on the original logout it shows the bye bye message
        $this -> v -> JustLoggedOut();
    }
    
}