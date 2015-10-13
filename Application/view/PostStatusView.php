<?php

class PostStatusView {
    
    private static $Story = "PostStatusView::StoryID";
    private static $Post = "PostStatusView::Post";
    
    public function getHTML(){
        
        //TODO: add upload image option
        return '<form method="post" > 
				<fieldset>

					<label for="' . self::$Story . '">Write your story here :</label> 
					<textarea cols="40" rows ="5" type="text" class="PostTextBlock" id="' . self::$Story . '" name="' . self::$Story . '" maxlength="1550"></textarea> 

					<input type="submit" name="' . self::$Post . '" value="Upload" />
				</fieldset>
			</form>';
    }
    
    
    public function hasPressedUpload(){
        if(isset($_POST[self::$Post])){
            return true;
        }
        return false;
    }
    
    public function getStory(){
        if(isset($_POST[self::$Story])){
            //TODO: EXTREMLY IMPORTANT, STRIP THE TAGS, atm any1 could write a script to destroy the entire site and empty the DB
            return trim($_POST[self::$Story]);
        }
        return null;
    }
}