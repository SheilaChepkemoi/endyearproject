

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


if (isset($_GET['action'])){

    if ($_GET['action']=="delete"){

        foreach ($_SESSION['shopping_cart'] as $keys => $values){

            if ($values["item_id"]==$_GET["id"]){

                unset($_SESSION['shopping_cart'][$keys]);

                echo "<script>window.location='cart.php'</script>";
            }

        }
    }
}

?>



<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>CART</title>
	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<!-- <link href="img/favicon.ico" rel="shortcut icon"/> -->

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>
	<link rel="stylesheet" href="./css/landing-page.css">


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">

		<nav class="navbar navbar-light bg-light">
		  <a class="navbar-brand" href="#">
			<img src="images/projectlogo.PNG" width="60" height="40" alt="">
		  </a>
		</nav>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
		  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		  <span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		  <ul class="navbar-nav mr-auto">
			<li class="nav-item active">
			  <a class="nav-link" href="index.html#home">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="index.html#about">About Us</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown"
				  aria-haspopup="true" aria-expanded="false">
				  Services
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="index.html#services">Catering Services</a>
				  <a class="dropdown-item" href="index.html#services">Events & Wedding Planning</a>
				  <a class="dropdown-item" href="index.html#services">Tent Solutions</a>
				  <a class="dropdown-item" href="index.html#services">Furniture Solutions</a>
				</div>
			  </li>
			<li class="nav-item">
			  <a class="nav-link" href="rental-catalog.php">
				Rental Catalog
			  </a>
			  
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="index#contact">Contact Us</a>
			</li>
			
		  </ul>
	
		 
		  <ul class="logs">


<div class="notlogged_in"><button class="btn"> <a href="login.html">
Login
  </a></button>
  <button class="btn"> <a href="registration.html">
Register
  </a></button>
  <button class="btn"> <a href="cart.php">
	Cart
  </a></button></div>	
  
  <div class="logged_in">

  </a></button>
  <button class="btn name"> <a href="cart.php"> Cart
	
	
  </a></button>
  
  
<button class="btn"> <a href="login.html">
	
	Log Out
	</a></button>
	
	  </div>	
  </div>



</ul>
</div>

	  </nav>
	<div class="page-top-info">
		<div class="container">
			<h4>Your cart</h4>
			<div class="site-pagination">
				
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart-table">
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table class="table table-bordered ">
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									
									<th class="total-th">Price</th>
									<th class="total-th">Total</th>
									<th class="total-th">Action</th>
								</tr>
							</thead>
							<tbody>

                            <?php

                            if (!empty(($_SESSION['shopping_cart']))){

                                $total=0;

                                foreach ($_SESSION['shopping_cart'] as $keys =>$values){
                                    ?>

                                    <tr>
                                        <td><?php echo $values["item_name"] ?></td>
                                        <td><?php echo $values["item_quantity"] ?></td>
                                        <td><?php echo $values["item_price"] ?></td>
                                        <td><?php echo number_format($values["item_quantity"] *
                                                $values["item_price"] )?></td>
                                        <td><a href="cart.php?action=delete&id=<?php echo $values["item_id"] ?>"><span class="text-success">Remove</span></a></td>
                                    </tr>

                                    <?php

                                    $total=$total+($values["item_quantity"] *$values["item_price"]);

                                }

                                ?>

                                <tr>
                                    <td colspan="3" align="right">Total</td>
                                    <td align="right">Kshs <?php echo number_format($total,2)?></td>
                                </tr>


                            <?php

                            }

                            ?>


							</tbody>
						</table>

						</div>


                        <div style="margin: 20px"></div>

                        <tr>
                            <td style="margin: 10px" align="right"> <a href="http://localhost/Sheila/sheila/booking-form.php" class="btn btn-primary checkout">CHECKOUT</a></td>
                        </tr>


					</div>



			</div>
		</div>
	</section>
	
			</div>
		</div>
	</section>
	<!-- Footer section end -->



	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>


<script>

	$(".checkout").click(function(){

		


		if(sessionStorage.getItem("logged_in_client_name")===null){

			alert("Please login inorder to check out");

		}
		else{

			window.location.href="http://localhost/Sheila/sheila/booking-form.php";

		}

		


	});

    $("#download").click(function () {

        html2canvas(document.getElementById('invoice'), {
            onrendered: function (canvas) {
                var data = canvas.toDataURL();
                var docDefinition = {
                    content: [{
                        image: data,
                        width: 500
                    }]
                };
                pdfMake.createPdf(docDefinition).download("Table.pdf");
            }
        });


    });



</script>
<script>
      $(document).ready(function(){

if(sessionStorage.getItem("logged_in_client_name")===null){

  $(".logged_in").hide();
  $(".notlogged_in").show();


}
else{

$(".logged_in").show();
$(".notlogged_in").hide();

$(".name").text("Welcome "+sessionStorage.getItem("logged_in_client_name"));




}



$("#formcart").submit(function(event){

event.preventDefault();


});

});
    </script>

	</body>
</html>
