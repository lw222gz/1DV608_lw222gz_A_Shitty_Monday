<?php

class Post{
    private $Creator;
    private $Story;
    private $DateCreated;
    
    public function __construct($Creator, $Story, $DateCreated){
        $this -> Creator = $Creator;
        $this -> Story = $Story;
        $this -> DateCreated = $DateCreated;
    }
    
    public function getCreator(){
        return $this -> Creator;
    }
    
    public function getStory(){
        return $this -> Story;
    }
    
    public function getDateCreated(){
        return $this -> DateCreated;
    }
}