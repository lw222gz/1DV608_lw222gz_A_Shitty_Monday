<?php

class PostsDAL {
    private $DALb; //DALBase
    private $Posts;
    
    public function __construct($DALb){
        $this -> DALb = $DALb;
    }
        
    public function AddNewPostToDB($user, $story){
        //get todays date
        $date = date('Y/m/d');
        
        $conn = $this -> DALb -> getSQLConn();
       
        $query = "INSERT INTO `Posts`(`Creator`, `Message`, `DatePosted`) VALUES ('$user','$story','$date')"; 
        //$result = $conn->query($query);
        $result = mysqli_query($conn, $query);
        
        mysqli_close($conn);
        
        return $result;
    }
    
    
    public function getAllPosts(){
        $this -> Posts = array();
        $conn = $this -> DALb -> getSQLConn();
        
        $query = "SELECT `Creator`,`Message`,`DatePosted` FROM `Posts` ORDER BY `DatePosted` ASC";
        
        $result = mysqli_query($conn, $query);
        
        if ($result->num_rows > 0) {
            //creates a new Post for each line in the Posts table
            while($row = $result->fetch_assoc()) {
                    array_push($this -> Posts, new Post($row["Creator"], $row["Message"], $row["DatePosted"]));
            }
        } 
        
        $conn->close();
        
        return $this -> Posts;
    }
}