<?php
class DatabaseConnection{

    private  $conn;

    public function connection(){
     
        $this->conn=mysqli_connect("localhost","root","","jowath");

        return $this->conn;
    }

}

