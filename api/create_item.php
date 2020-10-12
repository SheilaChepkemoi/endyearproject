

<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['name']) && isset($_POST['type']) &&
        isset($_POST['stock']) && isset($_POST['price']) &&
        isset($_POST['description']) && isset($_FILES['image'])){

        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){


            $imageurl="http://localhost/Sheila/images/".basename($_FILES["image"]["name"]);

            $name=$_POST['name'];

            $type=$_POST['type'];

            $stock=$_POST['stock'];

            $price=$_POST['price'];

            $description=$_POST['description'];

            $database_operation= new Add_item();

            $database_operation->add($name,$type,$stock,$price,$description,$imageurl);


        }
        else{

            echo  "An error occured";

        }




    }
}

class Add_item{


    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function  add($name,$type,$stock,$price,$description,$imageurl){

        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare(
            "INSERT INTO `item` (`item_id`, `item_name`, `item_type`, 
               `item_price`, `item_description`, `amount_in_stock`, `image_url`)
            VALUES (NULL, ?, ?,?, ?, ?,?);");

        $statement->bind_param("ssssss",$name,$type,$price,$description,$stock,$imageurl);

        if ( $statement->execute()){

            mysqli_commit($this->connection);

            echo "Item created successfully";
        }
        else{
            echo  "An error occured";
        }



    }

}

