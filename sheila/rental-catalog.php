

<?php

$connection=mysqli_connect("localhost","root","","jowath");

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Items page</title>
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
<body onload="getItems('all')">
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


      <div class="logged_in">


          </a></button>
          <button class="btn name"> <a href="cart.php">
                  <button class="btn"> <a href="cart.php">
                          Cart
                  </a></button>

              </a></button>
            <button class="btn logout" > <a href="login.html">

                  Log Out
              </a></button></div>


  <div class="notlogged_in"><button class="btn"> <a href="login.html">
	Login
	  </a></button>
	  <button class="btn"> <a href="registration.html">
	Register
	  </a></button>
	  <button class="btn"> <a href="cart.php">
			Cart
		</a></button></div>	
		

		</div>

	

  </ul>
</div>

</nav>
	<div id="preloder">
		<div class="loader"></div>
	</div>

	


	<!-- Page info -->
	<!-- <div class="page-top-info">
		<div class="container">
			<h4>Product Page</h4>
			<div class="site-pagination">
			<form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" name="search_text" id="search_text" aria-label="Search">
      </form>
			</div>
		</div>
	</div> -->
	<!-- Page info end -->


	<!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
                        <ul id="link"></ul>
						
					</div>

				</div>

                <div id="data"></div>

				<div  class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div id="items-div" class="row">

					</div>
				</div>




			</div>

            <div id="searched" class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0"></div>


        </div>
	</section>
	<!-- Category section end -->

  <script>

   
  </script>
	
	

	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.nicescroll.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/main.js"></script>
	<script src="http://localhost/Sheila/javascript/addcart.js"></script>
    <script src="../jquery/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

        $(document).ready(function () {

            if(sessionStorage.getItem("logged_in_client_name")===null){

                $(".logged_in").hide();
                $(".notlogged_in").show();




            }
            else {

                $(".name").text("Welcome "+sessionStorage.getItem("logged_in_client_name"));

                $(".logged_in").show();
                $(".notlogged_in").hide();

                $(".logout").click(function () {

                    sessionStorage.clear();

                });

            }


            $.getJSON('http://localhost/Sheila/api/fetch_items.php',function (data) {


                $.each(data,function (key, value) {

                    var info=$('<button type="button" name="add_cart" ' +
                        'style="margin: 20px" class="btn  btn-sm btn-primary">View details</button>');

                    var form=$('  <form class="col-md-3 col-lg-3" id="form" style="margin: 10px" method="post" action="cart.php">\n' +
                        '                                        <div style="border: 1px ; background-color: #f1f1f1; border-radius: 5px ;padding: 10px">\n' +
                        '                                            \n' +
                        '                                            <img src="'+ this.image_url +'">\n' +
                        '                                            <h6  style="margin: 10px"class="text-info">'+ this.item_name + '</h6>\n' +
                        '                                            <h6  style="margin: 10px" class="text-danger">Kshs  ' +this.item_price+ '</h6>\n' +
                        '                                            <h6  style="margin: 10px" class="text-danger">Amount in Stock  '+ this.amount_in_stock +'</h6>\n' +
                        '\n' +
                        '                                            <div class="form-group">\n' +
                        '                                                <label>Qtty</label>\n' +
                        '                                                <input type="text" name="item_quantity" class="form-control" value="1">\n' +
                        '                                                <input type="hidden" name="item_id"  style="margin: 20px" class="form-control" value=" '+this.item_id+'">\n' +
                        '                                            </div>\n' +
                        '\n' +
                        '                                            <input type="hidden" name="item_name"  style="margin: 20px" class="form-control" value=" ' + this.item_name +'">\n' +
                        '                                            <input type="hidden" name="item_price"  style="margin: 20px" class="form-control" value=" ' + this.item_price + '">\n' +
                        '                                            <button type="submit" name="add_cart" style="margin: 20px" class="btn  btn-success">ADD CART</button>&nbsp;\n' +
                        '                                        </div>\n' +
                        '                                    </form>');



                    info.click(function () {

                        swal({
                            title: value.item_name,
                            text: value.item_description +"\nKshs : "+ value.item_price+"\nIn Stock : "+value.amount_in_stock,

                        });

                    });

                    form.append(info);


                        $("#items-div").append(form);





                });

            })





        });


    </script>



    <script>

        $(document).ready(function () {



            $("#fetched").hide();

            $("#search_text").keyup(function () {

                $("#fetched").hide();

                $("#searched").show();

                var text=$(this).val();

                if (text !=''){

                }
                else{

                    $.ajax({

                        url:"fetch.php",
                        method:"post",
                        data:{search:text},
                        dataTable:"text",
                        success:function (data) {

                            $("#searched").html(data);

                        }

                    });


                }

            });


            $("#form").submit(function (event) {

                event.preventDefault();

                alert("Data");

            })

            $.getJSON( "http://localhost/Sheila/api/fetch_item_type.php", function( data ) {

                $.each( data, function( key, val ) {

                  var link="<li> " +val.item_type+ "  "+val.counter+"</li>";
                    var name='<a href="#">' + val.item_type  + '</a>';

                  $("#link").append(link);

                });


            });

        });

    </script>

	</body>
</html>
