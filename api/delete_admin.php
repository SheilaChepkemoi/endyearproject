


<?php


if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['id'])){

        $id=$_POST['id'];

        $operation=new Delete();

        $operation->admin($id);

    }

}

class Delete{


    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }


    public  function  admin($id){

        mysqli_begin_transaction($this->connection);

        $statement=$this->
        connection->prepare("DELETE FROM `administrator` WHERE admin_id=?");

        $statement->bind_param("s",$id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => 'Deleted successfully',
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