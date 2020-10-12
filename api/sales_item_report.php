


<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['start']) && isset($_POST['end'])){

        $start=$_POST['start'];

        $end=$_POST['end'];

        $databaseoperation=new Fetch();

        $databaseoperation->generate($start,$end);


    }
}

class Fetch{
    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function  generate($start,$end){
        mysqli_begin_transaction($this->connection);

        $query="SELECT product, SUM(qntty) as total FROM `orders`,bookings WHERE
          bookings.booking_date >='$start' AND bookings.booking_date<='$end' GROUP BY(orders.product) ";
        $result=mysqli_query($this->connection,$query);
        $activearray = array();
        mysqli_commit($this->connection);
        while ($row=mysqli_fetch_assoc($result)) {
            $activearray[]=$row;
        }

        echo json_encode($activearray);
    }
}
