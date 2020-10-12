<?php


if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['cliendid']) && isset($_POST['name'])
        && isset($_POST['phone']) && isset($_POST['code'])
        && isset($_POST['amount']) && isset($_POST['date'])
        && isset($_POST['invoice_id'])){

        $clientid=$_POST['cliendid'];

        $invoice_id=$_POST['invoice_id'];

        $name=$_POST['name'];

        $phone=$_POST['phone'];

        $code=$_POST['code'];

        $amount=$_POST['amount'];
        $date=$_POST['date'];


        $datababseoperation=new Create();

        $datababseoperation->add($clientid,$name,$phone,$code,$amount,$date,$invoice_id);

    }
}


class  Create{

    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function updateinvoive($id){

        mysqli_begin_transaction($this->connection);

        $query=$this->connection->prepare("UPDATE `invoice` SET 
           `status` = 'done' WHERE `invoice`.`id` = ?; ");

        $query->bind_param("s",$id);

        $query->execute();

        mysqli_commit($this->connection);



    }

    public  function  add($clientid,$name,$phone,$code,$amount,$date,$invoice_id){

        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("INSERT INTO `payment` (`payment_id`, `client_id`, `name`, `phone`, `code`, `amount`, `date`)  
             VALUES (NULL,?, ?, ?, ?, ?, ?);");

        $statement->bind_param("ssssss",$clientid,$name,$phone,$code,$amount,$date);

        if ($statement->execute()){

            mysqli_commit($this->connection);

            $this->updateinvoive($invoice_id);

            echo "Payment success";

        }
        else{

            echo "failed";

        }
    }

}