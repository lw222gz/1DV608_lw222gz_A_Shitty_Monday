<?php

class MasterController{
    
    private $PostCont;
    private $LoginCont;
    private $lv; //login view
    private $rv; //register view
    private $psV; //poststatus view
    private $lm; //loginmodel
    private $sm; //sessionmanipulator
    private $appV;
    
    public function __construct($PostCont, $LoginCont, $lv, $rv, $psV, $sm, $appV){
        $this -> PostCont = $PostCont;
        $this -> LoginCont = $LoginCont;
        $this -> lv = $lv;
        $this -> rv = $rv;
        $this -> psV = $psV;
        $this -> sm = $sm;
        $this -> appV = $appV;
    }
    
    
    public function init(){
        try 
        {
            //TODO: could benefit from only running when on the index page.
            if($this -> sm -> getLoggedInSession()){
                $this -> appV -> setAllPosts($this -> PostCont -> getAllPosts());
            }
            
            if($this -> rv -> hasPressedRegister()){
                $this -> LoginCont -> RegisterNewUser();
            }
            
            else if ($this -> lv -> hasPressedLogin())
            {
                $this -> LoginCont-> LogIn();
            }
            
            else if($this -> lv -> hasPressedLogOut()){
                $this -> LoginCont -> LogOut();
            }
            else if($this -> psV -> hasPressedUpload()){
                $this -> PostCont -> AddPost();
            }
        }
        catch (LoginModelException $e){
            $this -> lv -> setStatusMessage($e);
        }
        catch (RegisterModelException $e){
            $this -> rv -> setErrorMessage($e);
        }
        catch (Exception $e){
            echo "An unhandeld exception was thrown. Please infrom...";
        }
    }
}