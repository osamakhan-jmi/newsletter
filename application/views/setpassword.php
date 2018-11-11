<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Set Password</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
</head>

<script>
$(document).ready(function(){
    $("#setPassword").click(function(){
        var password = $("#password").val();
		var cnfrmpassword = $("#cnfrmpassword").val();
		var emailid = '<?php echo $email ?>';
		if(password == cnfrmpassword){
			$.ajax({
  				url: '<?php echo site_url('home/setpassword'); ?>',
				type:'POST',
  				cache: false,
				data : {"password":password,"emailid":emailid},
  				success: function(data){
					window.location.replace('<?php echo site_url('home/') ?>');
  				},
				error: function(){
					alert("server cannot be reached");
				}
			});
			
		}else{ 
			alert('Enter correct password');
		}
		
    });
});
</script>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">d-Fast Newsletter</a>
    </div>
  </div>
</nav>


<table align="center">
  <tr>
   <th>Enter Password</th>
   <th><input type="text" required="required" id="password"></th>
  </tr>
  <tr>  
   <th>Confirm Password</th>
   <th><input type="password" required="required" id="cnfrmpassword"></th>
  </tr>
  <tr>
   <th><button id="setPassword">Set Password</button></th> 
  </tr>
</table>

</body>
</html>