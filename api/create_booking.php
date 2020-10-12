

<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['email']) && isset($_POST['pick_up_date'])
        && isset($_POST['return_date']) && isset($_POST['address'])
        && isset($_POST['number_guests']) && isset($_POST['event_type'])
        && isset($_POST['clientid'])){

        $email=$_POST['email'];

        $pickup=$_POST['pick_up_date'];

        $return=$_POST['return_date'];

        $guests=$_POST['number_guests'];

        $type=$_POST['event_type'];

        $address=$_POST['address'];
        $clientid=$_POST['clientid'];

        $database_operation= new Create_Booking();

        $database_operation->add($email,$pickup,$return,$guests,$type,$address,$clientid);





    }
}


class  Create_Booking{


    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function  add($email,$pickup,$return,$guest,$type,$address,$clientid){

        mysqli_begin_transaction($this->connection);

        $booking_id=rand(10,1000000);



        $statement=$this->connection->prepare("INSERT INTO `bookings`
 (`booking_id`, `client_email`, `booking_date`, `pick_up_date`, `return_date`, 
 `address`, `number_of_guets`, `event_type`, `client_id`, `primary_key`) 
 VALUES (?, ?, current_timestamp(), ?, ?, ?,?,?,?, NULL);");

        $statement->bind_param("ssssssss",$booking_id,$email,$pickup,$return,$address,$guest,$type,$clientid);

        if ( $statement->execute()){

            mysqli_commit($this->connection);

            $this->addorder($booking_id,$clientid);

            $this->create_invoice($booking_id,$clientid,$email);

        }
        else{
            echo  "An error occured";
        }

    }


    public  function create_invoice($booking_id,$client_id,$email){

        mysqli_begin_transaction($this->connection);

        $query=$this->connection->prepare('INSERT INTO `invoice` (`id`, `invoice_id`, `client_id`, `clien_email`, `status`) 
          VALUES (NULL,?,?,?, \'pending\');');
        $query->bind_param('sss',$booking_id,$client_id,$email);

        if ( $query->execute()){
            mysqli_commit($this->connection);
        }


    }


    public  function addorder($booking_id,$client_id){

        session_start();


     if (!empty($_SESSION['shopping_cart'])){

         foreach ($_SESSION['shopping_cart'] as $keys =>$values){

             mysqli_begin_transaction($this->connection);

             $item_name=$values["item_name"];

             $item_quantity= $values["item_quantity"];

             $item_price=$values["item_price"];

             $total=$values["item_quantity"] *$values["item_price"];


             $statement=$this->connection->
             prepare("INSERT INTO `orders` (`order_id`, `product`, 
               `qntty`, `price`, `total`, `client_id`, `booking_id`)
                  VALUES (NULL, ?,?,?,?, ?, ?);");

             $statement->bind_param("ssssss",$item_name,
                 $item_quantity,$item_price,$total,$client_id,$booking_id);

             if ( $statement->execute()){

                 mysqli_commit($this->connection);

                 echo $booking_id;
             }
             else{
                 echo  "An error occured";
             }







         }

        }
     else{

         echo "No items in Cart";
     }

     session_destroy();

    }

}
