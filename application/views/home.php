<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
<script>
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}
	
$(document).ready(function(){
    $("#subscribe").click(function(){
        var emailid = $("#emailid").val();
		if(validateEmail(emailid)){
			$.ajax({
  				url: '<?php echo site_url('home/subscribe'); ?>',
				type:'POST',
  				cache: false,
				data : {"emailid":emailid},
  				success: function(data){
					alert(data);
  				},
				error: function(){
					alert("server cannot be reached");
				}
			});
			
		}else{ 
			alert( emailid + " is invalid, enter correct emailid");
		}
		
    });
});
</script>

</head>

<body>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">d-Fast Newsletter</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a target="_blank" href="<?php echo site_url('login/'); ?>">Login</a></li>
    </ul>
  </div>
</nav>


<table align="center">
  <tr>
    <th><input type="email" required="required" id="emailid"></th>
    <th><button id="subscribe">Subscribe</button></th> 
  </tr>
</table>
</body>

</html>
