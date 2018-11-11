<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
</head>

<script>
$(document).ready(function(){
    $("#login").click(function(){
        var password = $("#password").val();
		var emailid = $("#emailid").val();
		if(password != '' && emailid != ''){
			$.ajax({
  				url: '<?php echo site_url('login/validateUser'); ?>',
				type:'POST',
  				cache: false,
				data : {"password":password,"emailid":emailid},
  				success: function(data){
					if (data == 200){
						location.replace("<?php echo site_url('homepage/') ?>");
					}else{
						alert(data);
					}
  				},
				error: function(){
					alert("server cannot be reached");
				}
			});
			
		}else{ 
			alert('Enter correct credentials');
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
   <th>Email Id</th>
   <th><input type="text" required="required" id="emailid"></th>
  </tr>
  <tr>  
   <th>Password</th>
   <th><input type="password" required="required" id="password"></th>
  </tr>
  <tr>
   <th><button id="login">Login</button></th> 
  </tr>
</table>

</body>
</html>