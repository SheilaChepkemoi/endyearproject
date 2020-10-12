

<?php


session_start();



?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Booking</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/landing-page.css">
</head>

<body>
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
      <button class="btn name"> <a href="cart.php"> Cart
        
        
      </a></button>
      
   
          <button class="btn"> <a href="login.html">
        
            Log Out
            </a></button></div>	

  

 

  </ul>
</div>

</nav>
  <div id="booking" class="section" style="background-color: #f1f1f1">
    <div class="section-center">
      <div class="container-fluid bookingsformcontainer-fluid">
        <!-- <div class="container bookingscontainer"> -->
        <div class="row bookingsrow">
          <div class="col-md-3">

          </div>
          <div class="col-md-6 bookingcolumn">
            <div class="booking-form">
              <div class="form-header">
                <h1>Bookings</h1>
              </div>
              <form action="http://localhost/Sheila/api/create_booking.php"
                    method="post" id="booking_form">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <span class="form-label">Email</span>
                      <input name="email" id="email" class="form-control" type="email">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <span class="form-label">Physical Address</span>
                      <input name="address" class="form-control" type="text" onkeypress="return (event.charCode > 64 && 
                    event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <span class="form-label">Event type</span>
                      <select id="dropDownId" class="form-control" name="event_type">
                        <option>Wedding</option>
                        <option>Corporate</option>
                        <option>Party</option>
                        <option>Other</option>
                      </select>
                      <span class="select-arrow"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <span class="form-label">Number of Guests</span>
                      <input class="form-control" type="number" name="number_guests">

                    </div>
                  </div>
                </div>

                <div class="row">

                  <div class="col-sm-4">
                    <div class="form-group dates">
                      <span class="form-label">Pickup Date</span>
                      <input name="pick_up_date" id="txtDate" class="form-control" type="date" required>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group dates">
                      <span class="form-label">Return Date</span>
                      <input  name="return_date"  id="txtDate" class="form-control" type="date" required>
                    </div>
                  </div>

                </div>


                <div class="form-btn">
                  <button class="submit-btn btnbookingrequest">CONFIRM BOOKING</button>
                </div>



              </form>
                <!-- <div class="form-btn">
                    <button class="submit-btn btnbookingrequest">DOWNLOAD INVOICE</button>
                </div> -->
                <a class="pay" href="pay.html">Proceed to Payment</a>


            </div>
          </div>
          <div class="col-md-3"></div>
        </div>
        <!-- </div> -->
      </div>
    </div>
      <div style="margin: 40px"></div>
      <footer class="page-footer font-small mdb-color pt-4 footer footerrow">

<!-- Footer Links -->

  
  <!-- Grid column -->

  <!-- Grid column -->
  


      
  </div>
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

<script src="http://localhost/Sheila/javascript/create_booking.js"></script>
<script src="http://localhost/Sheila/jquery/jquery-3.4.1.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
   $(document).ready(function () {

       var email  = $("input[name='email']").val();
       var address  = $("input[name='address']").val();

       $("#bill").index("your new header");
       $("#address").innerText("your new header");

       $(".btnbookingrequest").click(function () {



       });

   })
</script>
<script>
  $(function(){
    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('min', maxDate);
    var maxDate = year + '-' + month + '-' + day;
    $('#txtDate').attr('min', maxDate);
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</html>