<?php

$connect=mysqli_connect("localhost","root","","jowath");

$output='';

$sql="SELECT * FROM `item` WHERE item_name LIKE '%".$_POST['search']."%'";

$result=mysqli_query($connect,$sql);

if (mysqli_num_rows($result) >0){


    while ($row=mysqli_fetch_array($result)){


        $output.='<form id="form" style="margin: 10px" method="post" action="cart.php">
                                        <div style="border: 1px ; background-color: #f1f1f1; border-radius: 5px ;padding: 10px">
                                            
                                            <img src="'.$row["image_url"].'">
                                            <h6  style="margin: 10px"class="text-info">'.$row["item_name"].'</h6>
                                            <h6  style="margin: 10px" class="text-danger">Kshs '.$row["item_price"].' </h6>
                                            <h6  style="margin: 10px" class="text-danger">Amount in Stock  '.$row["amount_in_stock"].'</h6>

                                            <div class="form-group">
                                                <label>Qtty</label>
                                                <input type="text" name="item_quantity" class="form-control" value="1">
                                                <input type="hidden" name="item_id"  style="margin: 20px" class="form-control" value="'.$row["item_id"].'">
                                            </div>

                                            <input type="hidden" name="item_name"  style="margin: 20px" class="form-control" value=" '.$row["item_name"].'">
                                            <input type="hidden" name="item_price"  style="margin: 20px" class="form-control" value=" '.$row["item_price"].'">
                                            <button type="submit" name="add_cart" style="margin: 20px" class="btn  btn-success">ADD CART</button>&nbsp;
                                        </div>
                                    </form>';

        echo  $output;


    }


}
else{

    echo "Data Not found";

}