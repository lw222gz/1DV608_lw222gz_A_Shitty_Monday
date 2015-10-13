<?php

class PostController {
    private $psV; //PostStatusView
    private $psM; //PostStatusModel
    private $sm; //sessionmanipulator
    
    public function __construct($psV, $psM, $sm){
        $this -> psV = $psV;
        $this -> psM = $psM;
        $this -> sm = $sm;
    }
    
    public function AddPost(){
        try
        {
            $this -> psM -> addNewPost($this -> sm -> getUserNameSession(), $this -> psV -> getStory());
        }
        catch (PostStoryError $e){
            echo "ERROR! EXTERMINATE! EXTERMINATE!";
        }
        catch (Exception $e){
            echo "An unknown error was thrown, please inform...";
        }
    }
    
    public function getAllPosts(){
        return $this -> psM -> getAllPosts();
    }
}