
<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){
    if (isset($_POST['email']) && isset($_POST['password'])){

        $email=$_POST['email'];

        $password=$_POST['password'];

        $database_operation=new Authenticate_user();

        $database_operation->Sign_In_User($email,$password);

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


    public  function Sign_In_User($email,$password){
        mysqli_begin_transaction($this->connection);

        $encryptedpassword=md5($password);

        $query="SELECT * FROM `client` WHERE email_address='$email' AND password='$encryptedpassword';";
        $result=mysqli_query($this->connection,$query);
        $activearray = array();
        mysqli_commit($this->connection);
        while ($row=mysqli_fetch_assoc($result)) {
            $activearray[]=$row;
        }

        echo json_encode($activearray);


    }

}