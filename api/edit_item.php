
<?php

if ($_SERVER['REQUEST_METHOD']=="POST"){

    if (isset($_POST['name']) && isset($_POST['item_id'])){

        $name=$_POST['name'];

        $item_id=$_POST['item_id'];

        $database_operation=new Edit_product();

        $database_operation->edit_name($name,$item_id);


    }
    if (isset($_POST['price']) && isset($_POST['item_id'])){

        $price=$_POST['price'];

        $item_id=$_POST['item_id'];

        $database_operation=new Edit_product();

        $database_operation->edit_price($price,$item_id);


    }
    if (isset($_POST['stock']) && isset($_POST['item_id'])){

        $stock=$_POST['stock'];

        $item_id=$_POST['item_id'];

        $database_operation=new Edit_product();

        $database_operation->edit_stock($stock,$item_id);


    }
    if (isset($_POST['description']) && isset($_POST['item_id'])){

        $description=$_POST['description'];

        $item_id=$_POST['item_id'];

        $database_operation=new Edit_product();

        $database_operation->edit_description($description,$item_id);


    }
    if (isset($_FILES['image']) && isset($_POST['item_id'])){

        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){

            $imageurl="http://localhost/Sheila/images/".basename($_FILES["image"]["name"]);
            $item_id=$_POST['item_id'];

            $database_operation=new Edit_product();

            $database_operation->edit_image($imageurl,$item_id);

        }


    }

}

class  Edit_product{

    private  $connection;

    function  __construct()
    {
        include_once ("connection.php");
        $db=new DatabaseConnection();

        $this->connection=$db->connection();
    }

    public  function edit_name($name,$item_id){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("UPDATE `item` SET `item_name` = ? 
        WHERE `item`.`item_id` = ?; ");

        $statement->bind_param("ss",$name,$item_id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => 'Item name updated successfully',
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
    public  function edit_stock($stock,$item_id){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("UPDATE `item` SET `amount_in_stock` = ? 
        WHERE `item`.`item_id` = ?; ");

        $statement->bind_param("ss",$stock,$item_id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => 'Item stock updated successfully',
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

    public  function edit_price($price,$item_id){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("UPDATE `item` SET `item_price` = ? 
        WHERE `item`.`item_id` = ?; ");

        $statement->bind_param("ss",$price,$item_id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => 'Item price updated successfully',
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

    public  function edit_description($description,$item_id){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("UPDATE `item` SET `item_description` = ? 
        WHERE `item`.`item_id` = ?; ");

        $statement->bind_param("ss",$description,$item_id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => 'Item description updated successfully',
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
    public  function edit_image($image_url,$item_id){
        mysqli_begin_transaction($this->connection);

        $statement=$this->connection->prepare("UPDATE `item` SET `image_url` = ? 
        WHERE `item`.`item_id` = ?; ");

        $statement->bind_param("ss",$image_url,$item_id);

        $statement->execute();
        if ($this->connection->affected_rows > 0){

            mysqli_commit($this->connection);


            $response = array(
                'status' => true,
                'message' => 'Image updated successfully',
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
