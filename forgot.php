<style>
	<?php
	include('style/stylelogpage.css');
	?>
</style>


<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>mercury login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">


</head>
<body>
<!-- partial:index.partial.html -->
<div class="container right-panel-active">

			<!-- Sign In -->
			<div class="container__form container--signin">
				<form action="#" class="form" id="form" method="post">
					<h2 class="form__title">Reset Password</h2>
					<input id="email" placeholder="Email"  class="input">
                <a href="index.php" class="link">Log ing</a>
                <input type="button" onclick="sendEmail()" value="RESET" class="btn">
				</form>
			</div>

			<!-- Overlay -->
			<div class="container__overlay">
				<div class="overlay">
					
				</div>
			</div>
		</div>
<!-- partial -->
  <script  src="app/script.js"></script>
  <!-- JS -->

    
  <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function sendEmail() {
            var name = $("#name");
            var email = $("#email");
            var subject = $("#subject");
            var body = $("#body");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                $.ajax({
                   url: 'forgetpassword/sendEmail.php',
                   method: 'POST',
                   dataType: 'json',
                   data: {
                       name: name.val(),
                       email: email.val(),
                       subject: subject.val(),
                       body: body.val()
                   }, success: function (response) {
                        if (response.status == "success")
                            alert('Email Has Been Sent!');
                        else {
                            alert('Please Try Again!');
                            console.log(response);
                        }
                   }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }
    </script>









</body>
</html>