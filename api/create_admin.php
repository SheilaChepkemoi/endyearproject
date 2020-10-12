


<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['adminname'])){

        $email=$_POST['email'];

        $password=$_POST['password'];

        $name=$_POST['adminname'];


        $database_operation=new Add();

        $database_operation->create($email,$password,$name);

    }
}


class Add{
    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function  create($email,$password,$name){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("INSERT INTO `administrator` (`admin_id`, `admin_email`, `admin_password`, `admin_name`) 
        VALUES (NULL, ?, ?, ?);");

        $statement->bind_param("sss",$email,$password,$name);

       if ( $statement->execute()){

           mysqli_commit($this->connection);

           echo "success";
       }
       else{

           echo "Failed an error occcured";
       }
    }
}
