

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
	  <button class="btn name"> <a href="cart.php">
		  
			
		</a></button>
		<button class="btn logout" > <a href="login.html">
		  
			Log Out
		  </a></button></div>	
		</div>

	

  </ul>
</div>

</nav>
<div class="container">

    <div class="login-content" style="padding-top: 70px">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="login-form">
                        <form id="send_feedback" method="post" action="http://localhost/Sheila/api/send_feedback.php">
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="true">
                            </div>

                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required="true">
                            </div>

                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="4"  name="message" class="form-control" placeholder="Message"  required="true"></textarea>
                            </div>
                            <!-- <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm" class="form-control" placeholder=" Confirm Password"  required="true">
                            </div>
-->
                            <button id="buttonlogin" type="submit"
                                    class="btn btn-success btn-flat m-b-30 m-t-30">Send</button>


                        </form>
                    </div>

                </div>

            </div>
        </div>
        <div></div>


    </div>
</div>
	


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

<script>

    $(document).ready(function () {

        $('#send_feedback').submit(function (event) {

            event.preventDefault();

            var form_data = $(this).serializeArray();
            var requestinfo=$(this);

            $.ajax(
                {
                    url: requestinfo.attr("action"),
                    type: requestinfo.attr("method"),
                    data: form_data,
                    success: function (response) {

                     alert(response);


                    },
                    error: function (response) {
                        alert('ajax failed');
                        // ajax error callback
                    },
                }

            );

        })

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

                $(".logout").click(function () {

                    sessionStorage.clear();

                });

	$(".name").text("Welcome "+sessionStorage.getItem("logged_in_client_name"));

	


}

		

		  $("#formcart").submit(function(event){

			event.preventDefault();


		  });

		});
	</script>

	</body>
</html>
