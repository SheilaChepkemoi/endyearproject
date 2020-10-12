
<?php
if ($_SERVER['REQUEST_METHOD']=="GET"){


    $database_operation=new Fetch_active_users();
    $database_operation->active();

}


class  Fetch_active_users{

    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function  active(){

        mysqli_begin_transaction($this->connection);

        $query="SELECT * FROM `invoice` INNER  JOIN bookings ON invoice.invoice_id=bookings.booking_id";
        $result=mysqli_query($this->connection,$query);
        $activearray = array();
        mysqli_commit($this->connection);
        while ($row=mysqli_fetch_assoc($result)) {
            $activearray[]=$row;
        }

        echo json_encode($activearray);

    }


}