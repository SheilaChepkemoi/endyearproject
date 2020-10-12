

<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){


    if (isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){

        $email=$_POST['email'];

        $subject=$_POST['subject'];

        $message=$_POST['message'];

        $database=new Sendfeedbak();

        $database->send($email,$subject,$message);

    }
}


class Sendfeedbak{

    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function  send($email,$subject,$message){

        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare(
            "INSERT INTO `feedback` (`id`, `email`, `subject`, `message`)
             VALUES (NULL, ?, ?, ?);");

        $statement->bind_param("sss",$email,$subject,$message);

        if ( $statement->execute()){

            mysqli_commit($this->connection);

            echo "Feedback sent successfully";
        }
        else{
            echo  "An error occured";
        }
    }


}
