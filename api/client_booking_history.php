


<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['client_id'])){

        $client_id=$_POST['client_id'];


        $database_operation=new Authenticate_user();

        $database_operation->Sign_In_User($client_id);

    }
}

class Authenticate_user{

    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }


    public  function Sign_In_User($client_id){
        mysqli_begin_transaction($this->connection);

        $query="SELECT * FROM `bookings` WHERE client_id='$client_id' ";
        $result=mysqli_query($this->connection,$query);
        $activearray = array();
        mysqli_commit($this->connection);
        while ($row=mysqli_fetch_assoc($result)) {
            $activearray[]=$row;
        }

        echo json_encode($activearray);


    }

}