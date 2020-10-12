
$(document).ready(function () {

    $('#booking_form').submit(function (e) {

        e.preventDefault()

        swal("Check the email provided for your invoice then proceed to payment")
            .then((value) => {

                if (value==true){

                    var form_data = $(this).serializeArray();
                    var requestinfo=$(this);
                    var email  = $("input[name='email']").val();
                    var address  = $("input[name='address']").val();
                    var eventtype  =$('#dropDownId :selected').text();
                    var guests  = $("input[name='number_guests']").val();
                    var pickup  = $("input[name='pick_up_date']").val();
                    var returndate  = $("input[name='return_date']").val();

                    if (returndate < pickup){

                        alert("The return date should be greater than pick up date");
                    }

                    else {

                        var client_id=sessionStorage.getItem("client_id");


                        $.ajax(
                            {
                                url: requestinfo.attr("action"),
                                type: requestinfo.attr("method"),
                                data: {
                                    "email":email,
                                    "address":address,
                                    "event_type":eventtype,
                                    "number_guests":guests,
                                    "pick_up_date":pickup,
                                    "return_date":returndate,
                                    "clientid":client_id
                                },
                                success: function (response) {

                                    alert(response);


                                    window.location.href="http://localhost/Sheila/sheila/pending.html";
                                },
                                error: function (response) {
                                    alert('ajax failed');
                                    // ajax error callback
                                },
                            }

                        );

                    }

                }


            });






    });

})
