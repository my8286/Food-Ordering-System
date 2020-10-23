
<! Doctype HTML>
<html>
<title>Reset Password And OTP authentication</title>
<head>
<link rel="stylesheet" type="text/css" href="css/registration.css">
<script src="../javascript/nodejs_email.js" type="text/javascript"></script>

<script src="jquery-3.3.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
body {
 background-image: url("img/login_page.jpg");
 background-color: black;
}
div{
    margin-top:15%
}
#password{
    display: none
}
</style>
</head>
<body>
    <div id="otp" align="center">
            <h2 style="color:white;margin-top:15px">OTP has been send on your Email enter below</h2>
                <input class="input" style="text-align:left" type="text" name="otp" placeholder="Enter OTP" required \>
                <input class="" type="button" id="otp_submit" value="submit" \>
    </div>
    <div id="password" align="center">
        <h2 style="color:white;margin-top:15px">Please enter your new password</h2>
        <form>
            <input class="input" style="text-align:left" type="text" name="pass1" placeholder="Enter password" required \><br><br>
            <input class="input" style="text-align:left" type="text" name="pass2" placeholder="Re-enter password" required \> <br><br>
            <input class="" type="button" name="submit" value="submit" \>
        </form>
    </div>
    <script>
        $(document).on('click','#otp_submit',function(){
            $("#otp").css("display", "none");
            $("#password").css("display", "block");
        });
           
    </script>
</body>
</html>


