<?php

class PostStatusView {
    
    private static $StatusID = "PostStatusView::StatusID";
    private static $Post = "PostStatusView::Post";
    
    public function getHTML(){
        
        //TODO: add upload image option
        return '<form method="post" > 
				<fieldset>

					<label for="' . self::$StatusID . '">Write your story here :</label> 
					<textarea cols="40" rows ="5" type="text" class="PostTextBlock" id="' . self::$StatusID . '" name="' . self::$StatusID . '" maxlength="1550"></textarea> 

					<input type="submit" name="' . self::$Post . '" value="Upload" />
				</fieldset>
			</form>';
    }
}