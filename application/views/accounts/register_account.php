<body style = "background-color: #999966">

<!--Account-->
<div class = "container-fluid" style="margin-top: 50px; padding-top: 50px">
  <div class="row">
    <div class="col-sm-3">
    </div>

    <!-- Login Form -->
    <div class="col-sm-6">
      <div class="panel panel-primary" style="border-color: black">
        <div class = "panel-heading" style="text-align: center; border-color: black" > LOGIN ACCOUNT </div>
          <div class = "panel-body">
              <div class = " well well-sm">
                <form method="post" id = "login_account">
                  <div class="form-group">
                    <input type="text" class="form-control" id="un" placeholder="Username" label = "un" name="un" style = "width: 100% !important; height: 50px !important; text-align: center !important; margin-top: 20px !important">
                        <?php echo form_error('un'); ?>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control" id="pw" placeholder="Password" label = "pw" name="pw" style = "width: 100% !important; height: 50px !important; text-align: center !important">
                        <?php echo form_error('pw'); ?>
                  </div>

                  <div class="form-group">
                    <input type="submit" name="login" id = "login" class="btn btn-primary" value = "Login" style = "width: 100% !important">
                  </div>

                  <div class="form-group">
                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style = "width: 100% !important" value="Sign Up">
                  </div>
                </form>
              </div>
        </div> 
      </div>  
    </div>

    <div class="col-sm-3">
    </div>

  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class = " well well-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="text-align: center">Register Account</h4>
        </div>
    </div>

    <div class="modal-body">
      <div class = " well well-sm">
        <center style = ""> 
            <form method="post" id = "register_account" enctype="multipart/form-data">

              <div class="form-group">
              <input type="file" accept="image/*" class="form-control" id="img_id" label = "img_id" name="img_id" style = "width: 100% !important; height: 35px; margin-top: 20px !important">
              </div>

              <div class="form-group">
              <input type="text" class="form-control" id="un" placeholder="Username" label = "un" name="un" style = "width: 100% !important; height: 50px !important; text-align: center !important; margin-top: 20px !important">
                  <?php echo form_error('un'); ?>
              </div>

              <div class="form-group">
                <input type="password" class="form-control" id="pw" placeholder="Password" label = "pw" name="pw" style = "width: 100% !important; height: 50px !important; text-align: center !important">
                  <?php echo form_error('pw'); ?>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="nm" placeholder="Name" label = "nm" name="nm" style = "width: 100% !important; height: 50px !important; text-align: center !important">
                  <?php echo form_error('nm'); ?>
              </div>

              <div class="form-group">
                <input type="email" class="form-control" id="em" placeholder="Email" label = "em" name="em" style = "width: 100% !important; height: 50px !important; text-align: center !important">
                  <?php echo form_error('em'); ?>
              </div>

              <div class="form-group">
                <input type="number" class="form-control" id="pn" placeholder="Phone Number" label = "pn" name="pn" style = "width: 100% !important; height: 50px !important; text-align: center !important">
                  <?php echo form_error('pn'); ?>
              </div>

              <div class="form-group">
                <input type="submit" name= "submit" id = "submit" class="btn btn-primary" value = "Register" style = "width: 100% !important">
              </div>
            </form>
          </center>
      </div>
    </div>
  </div>
</div>


<!-- Script -->
<!-- Register Account -->
<script>
$(document).ready(function(){
$(document).on('submit', '#register_account', function(e){
      e.preventDefault();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url();?>accountsetupweb/registerAccount",
        data : new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function(){
          $empty = $('form#register_account').find("input").filter(function(){
            return this.value === "";
          });
          if($empty.length){
            $('#register_account')[0].reset();
            swal('Incomplete Registration');
            return false;
          }
        },
        success: function(data){
          if(data){
            $('#register_account')[0].reset();
            swal('Added Succesful');
          }
          else {
            $('#register_account')[0].reset();
            swal("invalid");
          }
          }
      });
  });
}); 

// Login Account
$(document).ready(function(){
    $(document).on('submit', '#login_account', function(e){
      e.preventDefault();
      var username = $('#username').val();
      var password = $('#password').val();
      $.ajax({
        type : "POST",
        url  : base_url + "AccountSetupweb/loginAccount",
        data : new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function(){
          $empty = $('form#login_account').find("input").filter(function(){
            return this.value === "";
          });
          if($empty.length){
            $('#login_account')[0].reset();
            swal('Incorrect Username or Password');
            return false;
          }
        },
        success: function(data){
          if(data){
            window.location = base_url + "UserStatusWeb/nfHome";
          }
          else {
            $('#login_account')[0].reset();
            swal("Incorrect Username or Password");
          }
        }
      })
      
    });
  });

</script>

