<?php
class Database{
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;
    
    public function __construct(){
        $this->host="localhost";
        $this->username="Dhiren Chotwani";
        $this->password="activa9015";
        $this->database="classmanagement";
        $this->connectDB();
    }
    
    //PHP Does not support OVERLOADING!
    public function connectionString($host,$username,$password,$database){
        $this->host=$host;
        $this->username=$username;
        $this->password=$password;
        $this->database=$database;
    }
    public function connectDB(){
        $this->connection=new mysqli($this->host,$this->username,$this->password);
        if(mysqli_connect_error()){
            die("Connection Failed: ".mysqli_error());
        }
        
        //in order to select the db we want to use
        $selected=$this->connection->select_db($this->database);
        if(!$selected){
            // *********** NOTE ***********
            //For open dource projects lets say the selected database is not present
            //then we should provide a solun to this
            //when we deploy projects to the client the project should be self installing and the user does not needs to follow a lot of process for correct installation
            //for this if the db is not selected we must create the database and the required tables here to do so read next part of code
            //$query="CREATE DATABASE classmanagement";
            //if((mysqli_query($this->connection,$query))){
              //  echo "DATABASE CREATED SUCCESSFULLY"
            //}
            // this creates the database needed now we need to create the tables for the tables execute the query for the tables (CREATE TABLE QWERY) copy it from the localhost phpmyadmin
           // echo "DB not selected";
        }
        else{
            //echo "DB Selected";
        }
         //   return $this->connection;   
    }   
    public function query($sql){
        $result=$this->connection->query($sql);
        if(!$result){
            die("Query Failed: ".$sql);
        }
        return $result;
    }
    public function escape_string($string){
        return $this->connection->real_escape_string($string);
    }
    public function getConnection(){
        return $this->connection;
    }
    function __destruct(){
        //this is destructor in php
    }
    
  
}
  $database = new Database();
?>