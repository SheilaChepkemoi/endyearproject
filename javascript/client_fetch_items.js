$(document).ready(function () {



    $("#create-item").click(function () {

        window.location.href="http://localhost/Sheila/add_item.html";

    });



    fetch_users();



    function fetch_users(){

        var url = 'http://localhost/Sheila/api/fetch_items.php';

        $.get(url, function (response, status) {

            $parse=JSON.parse(response);


            $.each($parse,function (key,value) {

                var button="<button style='margin: 20px' onclick=\"javascript:callJavascriptFunction()\" type=\"button\" class=\"btn btn-outline-success btn-sm user\" id='" + this.item_price + "'>ADD CART</button>";

                var price='<h6>Price Ksh ' +  value.item_price  + '</h6>';
                var name='<a href="#">' +  value.item_name  + '</a>';

                var product=$("<div class='col-lg-4 col-sm-6'>")
                    .append("<div class=\"product-item\">")
                    .append('<div class="pi-pic">')
                    .append('<img src="'+ value.image_url + '" alt="">')
                    .append(name)
                    .append(price)
                    .append(button);





                $('#items-div').append(
                    product
                );




            });


        });


    }





});