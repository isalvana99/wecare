$(document).ready(function () {
    $('.checking_email').keyup(function (e) { 
        //alert("mic test");

        var email = $('.checking_email').val();
        $.ajax({
            type: "POST",
            url: "../php/checkemail.php",
            data: {
                "check_submit_btn":1,
                "email_id":email,
            },
            success: function (response) {
                //alert(response);
                $("#emailreport").text(response);
                
                if(response=="*email already exist"){
                    document.getElementById("submit").disabled = true;
                }else{
                    document.getElementById("submit").disabled = false;
                }
            }
        });
    });
});

