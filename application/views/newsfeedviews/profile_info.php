<body style = "background-color: #999966">
<!-- Navigation Bar-->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href ="<?php echo base_url()?>UserStatusWeb/nfHome">Chikahan</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
    <ul class="nav navbar-nav">
        <li class=""><a href ="<?php echo base_url()?>UserStatusWeb/nfHome">Home</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href ="<?php echo base_url()?>AccountSetupWeb/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class = "container-fluid" style= "padding-top: 30px">
  <div class="row">
    <div class="col-sm-4" >
    </div>
    <div class="col-sm-4" >
    <div class="panel panel-primary">
    <div class="panel-body">
<!--       <input type="text" id="myProduct" onkeyup="mySearch()" placeholder="Search Product" style="width: 60% !important"><br> -->  
        <div id = "showaccount"></div>
        <input type="button" class="btn btn-primary" id = "edit_btn" data-toggle ="modal" data-target = "#myModal" style = "margin-bottom: 5px; width: 100% !important" value="Edit Account">

        <input type="button" class="btn btn-danger" id = "del_btn" style = "width: 100% !important" value="Delete Account">

    <div class="col-sm-4" >
    </div>
  </div>
</div>


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class = " well well-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" style="text-align: center">Edit Profile</h4>
        </div>
    </div>

    <div class="modal-body">
      <div class = " well well-sm">

            <form method="post" id = "register_account">
              <div class="form-group">

              <div class="form-group">
                <input type="hidden" class="form-control"  placeholder="" label = "user_id" id="user_id" name="user_id" style="width: 100% !important">
              </div>

<!--               <div class="form-group">
              <input type="file" accept="image/*" class="form-control" id="img_id" label = "img_id" name="img_id" style = "width: 100% !important; height: 35px; margin-top: 20px !important">
              </div> -->

              <div class="form-group">
              <label>Username:</label>
                <input type="text" class="form-control" id="un"  label = "un" name="un" style = "width: 100% !important; height: 30px !important; text-align: center !important">
                  <?php echo form_error('un'); ?>
              </div>

              <div class="form-group">
              <label>Password:</label>
                <input type="text" class="form-control" id="pw"  label = "pw" name="pw" style = "width: 100% !important; height: 30px !important; text-align: center !important">
                  <?php echo form_error('pw'); ?>
              </div>

              <div class="form-group">
              <label>Name:</label>
                <input type="text" class="form-control" id="nm" label = "nm" name="nm" style = "width: 100% !important; height: 30px !important; text-align: center !important">
                  <?php echo form_error('nm'); ?>
              </div>

              <div class="form-group">
              <label>Email:</label>
                <input type="email" class="form-control" id="em" label = "em" name="em" style = "width: 100% !important; height: 30px !important; text-align: center !important">
                  <?php echo form_error('em'); ?>
              </div>

              <div class="form-group">
              <label>Phone:</label>
                <input type="" class="form-control" id="pn" label = "pn" name="pn" style = "width: 100% !important; height: 30px !important; text-align: center !important">
                  <?php echo form_error('pn'); ?>
              </div>

              <div class="form-group">
                <input type="submit" name= "submit" id = "submit" class="btn btn-primary" value = "Update" style = "width: 100% !important">
              </div>
            </form>
      </div>
    </div>
  </div>
</div>

<script>
//Show Account Information
showAccount();
function showAccount(){
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url()?>AccountSetupWeb/showAccount',
    async: false,
    dataType: 'json',
    success: function(data){
      var html = "";
      var i;
      for(i = 0; i < data.length; i++){
        html += '<label>' +
          '<label style = "border: 1px solid gray; text-align:center; font-size: 25px; width:  500px; height: auto; overflow-x: auto !important;"><img class="img-thumbnail" style = " hieght: 200px; width: 200px; background-color: white !important" src="<?php echo base_url();?>uploads/'+data[i].p_image+'"></img></label><br>'+
          '<label style = "border: 1px solid; text-align:center; font-size: 25px; width:  500px; height: 20; overflow-x: auto !important;">'+data[i].username+'</label><br>'+
          '<label style = "border: 1px solid; text-align:center; font-size: 25px; width:  500px; height: 20; overflow-x: auto !important;">'+data[i].password+'</label><br>'+
          '<label style = "border: 1px solid; text-align:center; font-size: 25px; width:  500px; height: 20; overflow-x: auto !important;">'+data[i].name+'</label><br>'+
          '<label style = "border: 1px solid; text-align:center; font-size: 25px; width:  500px; height: 20; overflow-x: auto !important;">'+data[i].email+'</label><br>'+
          '<label style = "border: 1px solid; text-align:center; font-size: 25px; width:  500px; height: 20; overflow-x: auto !important;">'+data[i].phone+'</label><br>'+
        '</label>';
    }
    $('#showaccount').html(html);
      $('#user_id').val(data[0].user_id);
      $('#un').val(data[0].username);
      $('#pw').val(data[0].password);
      $('#nm').val(data[0].name);
      $('#em').val(data[0].email);
      $('#pn').val(data[0].phone);
   
    },
    error: function(){
    swal('could not load database');
    }
  });
}

//Edit Account
$(document).on('submit','#register_account',function(e){
  e.preventDefault();
  $.ajax({
        url:'<?php echo base_url();?>AccountSetupWeb/editAccount',
        type: 'post',
        data: new FormData(this),
        contentType: false,
        processData: false,
        success: function(data){
          if(data){
            showAccount();
            swal("Good job!", "Account Updated Successfully", "success");
          }else{
            swal("Error");
          }
        }
  });
});
</script>


