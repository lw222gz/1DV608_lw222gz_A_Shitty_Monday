<?php

class ApplicationView{
    
    private static $PostStatus = "ApplicationView::Post";
    private $PostView;
    
    private $Posts = array();
    
    public function __construct($PostView){
        $this -> PostView = $PostView;
    }
    
    public function GetAppView(){
        
        $ret = '<h2>WELCOME ' . $_SESSION["LoggedInUser"] . ' TO A SHITTY MONDAY!</h2> 
                <h4>Here you can post your painful monday stories to see if you actually got the worst one.</h4>
                
                ' . self::getHTML() . '';
                //TODO:Add so that a user can see all of the current posts.
                
        return $ret;
    }
    
    private function getAllPosts(){
        //Loopar igenom $Posts och skapar HTML för varje post. 
        return 'Here will all posts be looped out';
    }
    
    public function setAllPosts($Array){
        self::$Posts = $Array;
    }
    
    private function getHTML(){
        if(isset($_GET['PostStatus'])){
            return '<a href=?>Home</a><br/>' . $this -> PostView -> getHTML();
        }
        return '<a href=?PostStatus>Upload your own story!</a><br/>' . self::getAllPosts();
    }
    
    
    public function HasPressedPost(){
        if(isset($_POST[self::$PostStatus])){
            return $_POST[self::$PostStatus];
        }
        return false;
    }
}