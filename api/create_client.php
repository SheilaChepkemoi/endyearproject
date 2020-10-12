



<?php



if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST["phone"])){

        $username=$_POST['username'];

        $password=$_POST['password'];

        $email=$_POST['email'];

        $phone=$_POST['phone'];

        $database_operation=new Register_User();

        $database_operation->create_user($username,$email,$password,$phone);



    }

}


class  Register_User{

    private  $conn;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->conn=$db->connection();

    }


    public  function  create_user($username,$email,$password,$phone){

        mysqli_begin_transaction($this->conn);

        $encrypted_password=md5($password);

        $statement=$this->conn->prepare("INSERT INTO `client` (`client_id`, `client_name`, `phone_number`, `email_address`, `password`) 
               VALUES (NULL, ?, ?, ?, ?);");
        $statement->bind_param("ssss",$username,$phone,$email,$encrypted_password);

        if ($statement->execute()){
            mysqli_commit($this->conn);
            echo "success";
        }

        else{
            echo "An error occured please try again";
        }


    }


}
