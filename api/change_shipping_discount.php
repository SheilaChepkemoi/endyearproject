


<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){


    if (isset($_POST['id']) && isset($_POST['shipping'])){

        $id=$_POST['id'];

        $shipping=$_POST['shipping'];


        $database=new Update();

        $database->updateshipping($id,$shipping);



      }

    else    if (isset($_POST['id']) && isset($_POST['discount'])){

        $id=$_POST['id'];

        $discount=$_POST['discount'];


        $database=new Update();

        $database->updatediscount($id,$discount);



    }




}


class Update{


    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }


    public  function  updateshipping($id,$shipping){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->
        prepare("UPDATE `bookings` SET `shipping_fee` = 
        ? WHERE `bookings`.`primary_key` = ?; ");

        $statement->bind_param("ss",$shipping,$id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => ' updated successfully',
                'data' =>""
            );

        }
        else{


            $response = array(
                'status' => false,
                'message' => 'Failed',
                'data' =>""
            );
        }

        echo json_encode($response);
    }

    public  function  updatediscount($id,$shipping){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->
        prepare("UPDATE `bookings` SET `discount` = ? WHERE `bookings`.`primary_key` = ?; ");

        $statement->bind_param("ss",$shipping,$id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => ' updated successfully',
                'data' =>""
            );

        }
        else{


            $response = array(
                'status' => false,
                'message' => 'Failed',
                'data' =>""
            );
        }

        echo json_encode($response);
    }



}