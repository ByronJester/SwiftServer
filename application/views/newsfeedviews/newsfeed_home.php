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
          <li><a href ="<?php echo base_url()?>UserStatusWeb/profileInfo"><span class="glyphicon glyphicon-user"></span>&nbsp<?= $this->session->userdata('name');?></a></li>
          <li><a href ="<?php echo base_url()?>AccountSetupWeb/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

<!-- Newsfeead View -->
<div class = "container-fluid">
  <div class="row">
    <div class="col-sm-3">
    </div>

    <div class="col-sm-6">
      <div class="well well-sm">
      <label><?= $this->session->userdata('name'); ?></label>
          <center style = ""> 
            <form method="post" id = "status_post">
              <div class="form-group">
                <input type="text" class="form-control" id="pid" placeholder="What's on your mind ?" label = "" name="pid" style = "width: 90% !important; height: 100px !important; text-align: center !important">
                <?php echo form_error('pid'); ?>
              </div>

              <div class="form-group">
                <input type="submit" name= "submit" id = "submit" class="btn btn-primary" value = "Post" style = "width: 90%; margin-bottom: 10px !important">
              </div>
            </form>
          </center>
    </div> 

      <div class = "panel panel-success" style="border-color: black">
        <div class = "panel-heading" style="text-align: center; font-size: 20px; border-color: black"> NEWSFEED</div>
        <div class = "panel-body">
          <div id ="showpost"> </div><br>
        </div>
    </div>

    <div class="col-sm-3">
    </div>
</div>

<script>
//Post Status 
$(document).ready(function(){
  showPost();
$(document).on('submit', '#status_post', function(e){
      e.preventDefault();
      $.ajax({
        type : "POST",
        url  : "<?php echo base_url();?>UserStatusWeb/newsfeed",
        data : new FormData(this),
        contentType: false,
        processData: false,
        beforeSend: function(){
          $empty = $('form#status_post').find("input").filter(function(){
            return this.value === "";
          });
          if($empty.length){
            $('#status_post')[0].reset();
            swal('Invalid to Post Blank');
            return false;
          }
        },
        success: function(data){
          if(data){
            $('#status_post')[0].reset();
            swal('Posted Succesful');
            showPost();

          }
          else {
            $('#status_post')[0].reset();
            swal("Invalid");
          }
          }
      });
  });
});

//Display Post
function showPost(){
  $.ajax({
    type: 'ajax',
    url: '<?php echo base_url()?>UserStatusWeb/showPost',
    async: false,
    dataType: 'json',
    success: function(data){
      var html = "";
      var i;
      for(i = 0; i < data.length; i++){
        html += '<label style = "border: 1px solid">' +
          '<label style = "width: 200px; height: 20; padding-left: 5px; overflow-x: auto !important;">'+data[i].name+'</label><br>'+
          '<label style = "text-align: center;width: 750px; height: 50px; overflow-x: auto !important;">'+data[i].post_status+'</label><br>'+
        '</label>';
    }
    $('#showpost').html(html);
    },
    error: function(){
    swal('could not load database');
  }
});
}

//Side navbar Design
function openNav() {
    document.getElementById("mySidenav").style.width = "170px";
    document.getElementById("main").style.marginLeft = "150px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

</script>

