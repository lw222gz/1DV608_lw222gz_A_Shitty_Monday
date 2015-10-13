<?php

class ApplicationView{
    
    private $PostView;
    private $sm; //session manipulator
    
    private $Posts = array();
    
    public function __construct($PostView, $sm){
        $this -> PostView = $PostView;
        $this -> sm = $sm;
    }
    
    public function GetAppView(){
        
        $ret = '<h2>WELCOME ' . $this -> sm -> getUserNameSession() . ' TO A SHITTY MONDAY!</h2> 
                <h4>Here you can post your painful monday stories to see if you actually got the worst one.</h4>
                
                ' . self::getHTML() . '';
                //TODO:Add so that a user can see all of the current posts.
                
        return $ret;
    }
    
    private function getAllPosts(){
        $ret = "";
        foreach ($this -> Posts as $post){
            $ret .= "<p><b>Posted by: </b>". $post->getCreator(). "<br/> <b>At date:</b> " . $post -> getDateCreated() . "<br/> <b>Story:</b> " . $post -> getStory() . "<br/></p>";
            //var_dump($post -> getDateCreated());
        }
        
        //Loopar igenom $Posts och skapar HTML för varje post. 
        return $ret;
    }
    
    public function setAllPosts($Array){
        $this -> Posts = $Array;
    }
    
    private function getHTML(){
        if(isset($_GET['PostStatus'])){
            return '<a href=?>Home</a><br/>' . $this -> PostView -> getHTML();
        }
        return '<a href=?PostStatus>Upload your own story!</a><br/>' . self::getAllPosts();
    }
    
    
    public function isOnIndex(){
        if(isset($_GET["?"])){
            return true;
        }
        return false;
    }
}