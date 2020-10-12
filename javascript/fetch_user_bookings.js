$(document).ready(function () {

    fetch_bookings();

    function fetch_bookings(){



        var url = 'http://localhost/Sheila/api/fetch_user_booking.php';
        var user_id=sessionStorage.getItem("client_id");


        $.post(url, {user_id:user_id},function (response, status) {

            $parse=JSON.parse(response);

            $("#total_items").text($parse.length);

            var total=0;


            $.each($parse,function (key,value) {


                var button='<button class="btn btn btn-outline-success btn-sm">VIEW INFO</button>&nbsp;';
                $admin_body= $("#users_table");
                var table_row=$("<tr>")
                    .append($("<td>").append(value.booking_id))
                    .append($("<td>").append(value.client_email))
                    .append($("<td>").append(value.booking_date))
                    .append($("<td>").append(value.pick_up_date))
                    .append($("<td>").append(value.return_date))
                        .append($("<td>").append(value.address))
                        .append($("<td>").append(value.number_of_guets))
                        .append($("<td>").append(value.event_type))
                        .append($("<td>").append(button))
                    ;
                table_row.click(function () {

                    sessionStorage.setItem("booking_id",value.booking_id);
                    sessionStorage.setItem("address",value.address);
                    sessionStorage.setItem("booking_date",value.booking_date);
                    sessionStorage.setItem("invoice_number",value.booking_id);
                    sessionStorage.setItem("client_email",value.client_email);

                    window.location.href="http://localhost/Sheila/clientbookings.html";



                });
                $admin_body.append(table_row);




            });


        });


    }




});

