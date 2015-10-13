<?php

class PostStatusModel{
    //Note: this class feels useless, move it's responsibilities to PostDAL instead?
    
    private $pDAL; //PostsDAL
    
    public function __construct($pDAL){
        $this -> pDAL = $pDAL;
    }
    
    public function addNewPost($user, $message){
        //TODO:verify data
        //TODO: NEED TO CHECK IF A REPOST, annars så blir det många meddelanden
        if(!$this -> pDAL -> AddNewPostToDB($user, $message)){
            throw new PostStoryError("An error occured when trying to post your story.");
        }
    }
    
    public function getAllPosts(){
        //returns an array with all posts sorted by date
        return $this -> pDAL -> getAllPosts();
    }
    
    
}

class PostStoryError extends Exception{}