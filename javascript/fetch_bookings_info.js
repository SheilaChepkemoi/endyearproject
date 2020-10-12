$(document).ready(function () {





    fetch_bookings();

    function fetch_bookings(){
        $("#billing_to").text("Billing To : "+sessionStorage.getItem("client_email"));
        $("#billing_address").text("Billing Address : "+sessionStorage.getItem("address"));
        $("#billing_date").text("Billing Date : "+sessionStorage.getItem("booking_date"));
        $("#invoice_number").text("Invoice Number : "+sessionStorage.getItem("invoice_number"));



        var url = 'http://localhost/Sheila/api/fetch_booking_info.php';
        var orderid=sessionStorage.getItem("booking_id");




        $.post(url, {order_id:orderid},function (response, status) {

            $parse=JSON.parse(response);


            $.each($parse,function (key,value) {


                $admin_body= $("#users_table");
                var table_row=$("<tr>")
                    .append($("<td>").append(value.product))
                    .append($("<td>").append(value.qntty))
                    .append($("<td>").append("Kshs "+value.price))
                    .append($("<td>").append("Kshs "+value.total))
                     .append($("<td>").append(value.client_id))
                    ;

                $admin_body.append(table_row);

                $("#download").click(function () {


                    var doc = new jsPDF();
                    doc.addHTML($('#download_table')[0], 15, 15, {
                        'background-color': '#ffffff',
                    }, function() {
                        doc.save('sample-file.pdf');
                    });


                })




            });


        });


        $.post("http://localhost/Sheila/api/fetch_booking_info_total.php",
            {order_id:orderid},function (response, status) {

            $parse=JSON.parse(response);


            $.each($parse,function (key,value) {



                var discount=parseInt(sessionStorage.getItem('discount'));

                var shipping=parseInt(sessionStorage.getItem('shipping_fee'));

                var summation=parseInt(value.summation)+shipping-discount;


                $("#shipping").append('Kshs '+shipping);

                $("#discount").append('Kshs '+discount);


               $("#total").append(" Kshs "+summation);



            });


        });


    }




});

