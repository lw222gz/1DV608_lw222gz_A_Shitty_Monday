<?php

class RegisterView{
    
    private static $RegisterID = "RegisterView::Register";
    private static $UserNameID = "RegisterView::UserName";
    private static $PasswordID = "RegisterView::Password";
    private static $PasswordCheckID = "RegisterView::PasswordRepeat";
    private static $messageID = "RegisterView::Message";
    
    private static $message = "";
    
    private static $saveUserName = "";
    
    
    
    public function RegisterLayout(){
        return '
			<form method="post"> 
				<fieldset>
					<legend>Register - enter the fields below</legend>
					<p id="' . self::$messageID . '">' . self::$message . '</p>
					
					
					<label for="' . self::$UserNameID . '">Username :</label>
					<input type="text" id="' . self::$UserNameID . '" name="' . self::$UserNameID . '" value="' . self::$saveUserName . '"/><br/>
					
					<label for="' . self::$PasswordID . '">Password :</label>
					<input type="password" id="' . self::$PasswordID . '" name="' . self::$PasswordID . '" /><br/>
					
					<label for="' . self::$PasswordCheckID . '">Re-type Password :</label>
					<input type="password" id="' . self::$PasswordCheckID . '" name="' . self::$PasswordCheckID . '" /><br/>
					
					<input type="submit" name="' . self::$RegisterID . '" value="Register" />
				</fieldset>
			</form>
		';
    }
    
    
    public function getRequestUserName(){
        if (isset($_POST[self::$UserNameID])){
            self::$saveUserName = trim($_POST[self::$UserNameID]);
            return self::$saveUserName;
            
        }
        return null;
    }
    
    public function getRequestPassword(){
        if (isset($_POST[self::$PasswordID])){
            return trim($_POST[self::$PasswordID]);
        }
        return null;
    }
    
    public function getRequestPasswordCheck(){
        if(isset($_POST[self::$PasswordCheckID])){
            return trim($_POST[self::$PasswordCheckID]);
        }
        return null;
    }
    
    public function hasPressedRegister(){
        if(isset($_POST[self::$RegisterID])){
            return trim($_POST[self::$RegisterID]);
        }
        return null;
    }
    
    
    public function setErrorMessage($e){
        //checks if error message is cause due to invalid characters
        if(strpos($e -> getMessage(), " contains invalid characters.")){
            //if so those are removed.
            self::$saveUserName = strip_tags(self::$saveUserName);
        }
        self::$message = $e -> getMessage();
    }
}