<!DOCTYPE html>
<html>
<head>
	<title>CodeIgniter</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles_login.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/sweetalert.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<script src = "<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src = "<?php echo base_url();?>assets/js/sweetalert.min.js"></script>
	<script src = "<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<style>
		body {
				background-image: url("");
    		background-repeat: no-repeat, repeat;
    		background-size: 100% 150%;
		}
	</style>
</head>
<body>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<!-- Login -->
<div class = "container">
<div class="row">
<div class="col-sm-12">
  <center>
  <form method="post" id = "kakaiba">
  <h2>LOGIN YOUR ACOOUNT</h2>
  <br>
    <div class="form-group">
      <input type="text" class="form-control" id="uid" placeholder="Username" label = "Username" name="uid" style = "width: 100% !important">
      <?php echo form_error('uid'); ?>
    </div>

    <div class="form-group">
      <input type="password" class="form-control" id="pwd" placeholder="Password" label = "Password" name="pwd" style = "width: 100% !important">
      <?php echo form_error('pwd'); ?>
    </div>
    <div class="form-group">
    	<input type="checkbox" style=" width: 5% !important" onclick="myFunction()">Show Password
    </div>
     <div class="form-group">
    	<input type="submit" name= "login" id = "login" class="btn btn-primary" value = "Login" style = "width: 100% !important">
  </form>
  </center>
  </div>
</div>
</center>




<!-- Login Script-->
<script>
	$(document).ready(function(){
		$(document).on('submit', '#kakaiba', function(e){
			e.preventDefault();
			var username = $('#username').val();
			var password = $('#password').val();

			$.ajax({
				type : "POST",
				url  : "<?php echo base_url();?>hello/login",
				data : new FormData(this),
				contentType: false,
				processData: false,
				beforeSend: function(){

					$empty = $('form#kakaiba').find("input").filter(function(){
						return this.value === "";
					});
					if($empty.length){
						swal('You must fill out all fields');
						return false;
					}
				},
				success: function(data){
					if(data){
							window.location = "hello/Pmanage";

					}

					else {
						$('#kakaiba')[0].reset();
						swal("Invalid");
					}

				}
			})
			
		});

	});


	function myFunction() {
    var x = document.getElementById("pwd");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

</script>







</body>
</html>