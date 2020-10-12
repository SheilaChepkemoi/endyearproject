


<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['user_id'])){

        $user_id=$_POST['user_id'];


        $database_operation=new Authenticate_user();

        $database_operation->Sign_In_User($user_id);

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


    public  function Sign_In_User($order_id){
        mysqli_begin_transaction($this->connection);

        $query="SELECT * FROM `invoice` WHERE client_id='$order_id' and status='pending'";
        $result=mysqli_query($this->connection,$query);
        $activearray = array();
        mysqli_commit($this->connection);
        while ($row=mysqli_fetch_assoc($result)) {
            $activearray[]=$row;
        }

        echo json_encode($activearray);


    }

}