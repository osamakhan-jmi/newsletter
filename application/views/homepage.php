<?php
	if(!$this->session->userdata('emailid')){
		exit('Session expired');
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
<script src="<?php echo base_url().'js/jquery.bpopup.min.js'?>"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">d-Fast Newsletter</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="<?php echo site_url('homepage/logout'); ?>">Logout</a></li>
    </ul>
    <ul class="nav navbar-nav">
      <li><a href="<?php echo site_url('homepage/changePassword'); ?>">Change Password</a></li>
    </ul>
  </div>
</nav>
</body>
</html>