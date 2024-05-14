<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="main/img/icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src = 'js/script.js'></script>
	<title>ADT Tool</title>
</head>
<style type="text/css">
    	.login{
    border-radius: 10px;
    width: 730px;
    height: 170px;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
	transition: all 200ms ease-out;
	padding: 20px;
	margin: auto;
  }
  .nb{
  	background-color: rgb(75, 40, 109) !important;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.2);
  }
  .login:hover{
    box-shadow: 0 0 10px rgba(139, 226, 52);
  }
  div
  {
    padding: 2px;
  }
  .btn-success:hover{
  	background-color: rgb(102, 204, 0);
  }
  .btn-success{
  	background-color: rgb(139, 226, 52);
  }
</style>
<body><br>
	<div class = 'container login'>
		<nav class="navbar navbar-dark bg-dark nb">
  		<span class="navbar-brand mb-0 h1">ADT Productivity Tool</span>
		</nav>
		<br>
		<form action = '#' class="form-inline" id = 'login'>
      <div class="form-group mx-sm-1 mb-2">
        <input type="text" class="form-control" id="username" name = "username" placeholder="Enter XID here..." autocomplete="on">
      </div>
      <div class="form-group mx-sm-1 mb-2">
        <input type="password" class="form-control" id="password" name = "password" placeholder="Enter password here..." autocomplete="on">
      </div>
      <button type="button" id = 'submit' class="btn btn-success mb-2">Confirm identity</button>
      <!-- <div class="form-group mx-sm-1 float-right">
        <p class = 'h6'><small><a href="javascript:none()" id = 'atag'>Forgot Password?</a></small></p>
      </div> -->
    </form>
	</div>
</body>
<div id = 'frg_psw' class = "modal" tabindex="-1" role="dialog">
      <div class = 'modal-dialog' role="document">
        <div class="modal-content">
          <div class = 'modal-header'>
            <h5 class = 'modal-title'>RAP Tool - Prov Infra</h5>
            <button type = 'button' class = 'close' data-dismiss = 'modal' aria-label ='Close'>
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class = 'modal-body'>
            <form action = '#' id = 'sbmt_xid'>
              <div class = 'form-group'>
                <label for = "xid">Enter your XID:</label>
                <input type="text" class="form-control" id="xid" name = "xid" aria-describedby="xidHelp" placeholder="Not case sensitive and spaces are welcome...">
                <small id="xidHelp" class="form-text text-muted">We'll send your temporary password via email...</small>
              </div>
              <button type = 'button' id = 'submit_xid' class = 'btn btn-primary mb-2'>Submit</button>
            </form>
        </div>
      </div>
    </div>
<script type="text/javascript">
  $(document).ready(function(){
    if (window.opener && window.opener !== window) 
    {
        window.close();
    }
    else
    {
      
    }
  });
</script>
</html>
