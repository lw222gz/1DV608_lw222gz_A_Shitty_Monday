<?php

class PostsDAL {
    private $DALb; //DALBase
    private $Posts;
    
    //sets the timezone for the AddNewPostMethod
    public function __construct($DALb){
        $this -> DALb = $DALb;
        date_default_timezone_set('Europe/Stockholm');
    }
        
    //Adds a new post to the DB, returns true if successful, if it fails it returns false.
    public function AddNewPostToDB($user, $title, $story){
        //get todays date
        $date = date('Y/m/d');
        
        $conn = $this -> DALb -> getSQLConn();
       
        $query = "INSERT INTO `Posts`(`Creator`, `Title`, `Message`, `DatePosted`) VALUES ('$user','$title','$story','$date')"; 

        //$result = $conn->query($query);
        $result = mysqli_query($conn, $query);
        
        mysqli_close($conn);
        
        return $result;
    }
    
    
    //Calls the removeOldPosts function, then it gets all current posts and returns it as an array with Post objects. If eighter of the query's fails
    //it returns false
    public function getAllPosts(){
        
        //TODO: anyway to call this function daily?
        if(!self::removeOldPosts()){
            return false;
        }
        
        $this -> Posts = array();
        $conn = $this -> DALb -> getSQLConn();
        
        $query = "SELECT `Creator`, `Title`, `Message`, `DatePosted` FROM `Posts` ORDER BY `DatePosted` ASC";
        
        $result = mysqli_query($conn, $query);
        
        //if result is false then the query failed.
        if(!$result){
            $conn -> close();
            return $result;
        }
        if ($result->num_rows > 0) {
            //creates a new Post for each line in the Posts table
            while($row = $result->fetch_assoc()) {
                array_push($this -> Posts, new Post($row["Creator"], $row["Title"], $row["Message"], $row["DatePosted"]));
            }
        } 
        
        $conn->close();
        
        return $this -> Posts;
    }
    
    //removes week old posts, returns the status of the query, true if it was successful, otherwise false.
    public function removeOldPosts(){
        $conn = $this -> DALb -> getSQLConn();
        
        //removes week old posts
        $query = "DELETE FROM `Posts` WHERE `DatePosted` < NOW() - INTERVAL 7 DAY";
        
        $result = mysqli_query($conn, $query);
        
        $conn -> close();
        
        
        return $result;
    }
}