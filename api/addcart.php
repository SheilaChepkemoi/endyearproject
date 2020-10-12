<?php

session_start();

if (isset($_POST['add_cart'])){


    if (isset($_SESSION['shopping_cart'])){

        $item_array_id=array_column($_SESSION['shopping_cart'],"item_id");

        if (!in_array($_POST['item_id'],$item_array_id)){

            $count=count($_SESSION['shopping_cart']);
            $item_array=array(
                "item_id"=>$_POST['item_id'],
                "item_name"=>$_POST['item_name'],
                "item_price"=>$_POST['item_price'],
                "item_quantity"=>$_POST['item_quantity']
            );
            $_SESSION['shopping_cart'][$count]=$item_array;

        }
        else{

            echo "<script>alert('Item already added')</script>>";

        }

    }
    else{

        $item_array=array(
            "item_id"=>$_POST['item_id'],
            "item_name"=>$_POST['item_name'],
            "item_price"=>$_POST['item_price'],
            "item_quantity"=>$_POST['item_quantity']
        );
        $_SESSION['shopping_cart'][0]=$item_array;
    }
}
