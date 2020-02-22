<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login form</title>
  </head>
  <body>
  	<div class="container">
  		<form id=login-form method="post" action="login.php">
		  <div class="form-group">
		    <label for="name">Full name</label><span class="required">*</span>
		    <input type="text" class="form-control" id="name" name="name" required>
		  </div>
		  <div class="form-group">
		    <label for="pass">Password</label><span class="required">*</span>
		    <input type="password" class="form-control" id="pass" name="pass" required>
		  </div>
		  <button type="submit" class="btn btn-warning w-100">Submit</button>
		  <?php if(isset($_GET['error'])) { echo "<p class='error'>This is a danger alert—check it out!</p>"; } ?>
		</form>
  	</div>
  </body>
</html>
