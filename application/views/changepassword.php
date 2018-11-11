<?php
	if(!$this->session->userdata('emailid')){
		exit('Session expired');
	}
?>
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
		var oldpassword = $("#oldpassword").val();
		var emailid = '<?php echo $this->session->userdata('emailid'); ?>';
		
		if(password == cnfrmpassword){
			$.ajax({
  				url: '<?php echo site_url('homepage/setPassword'); ?>',
				type:'POST',
  				cache: false,
				data : {"oldpassword":oldpassword,"newpassword":password,"emailid":emailid},
  				success: function(data){
					if(data == 200){
						location.replace('<?php echo site_url('home/') ?>');
					}else{
						alert(data);
					}
					
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
   <th>Old Password</th>
   <th><input type="text" required="required" id="oldpassword"></th>
  </tr
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