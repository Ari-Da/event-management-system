<?php
include 'templates/nav.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login form</title>
  </head>
  <body>
  	<div class="container">
  		<form id="authenticate-form" method="post" action="authenticate.php">
        <h4>        
        <?php if(isset($_POST['login']) || isset($_GET['error'])) { ?>
          Login form
        <?php } else if(isset($_POST['signup']) || isset($_GET['duplicate'])) { ?>
          Registration form
        <?php } ?>
        </h4>
  		  <input type="hidden" name="type" value="<?=(isset($_POST['login'])) ? 0 : 1  ?>" />
		  <div class="form-group">
		    <label for="name">Full name</label><span class="required">*</span>
		    <input type="text" class="form-control" id="name" name="name" required>
		  </div>
		  <div class="form-group">
		    <label for="pass">Password</label><span class="required">*</span>
		    <input type="password" class="form-control" id="pass" name="pass" required>
		  </div>
		  <button type="submit" class="btn btn-warning w-100">
		  	<?php if(isset($_POST['login']) || isset($_GET['error'])) { ?>
		  		Login
		  	<?php } else if(isset($_POST['signup']) || isset($_GET['duplicate'])) { ?>
		  		Register
		  	<?php } ?>
		  </button>
		</form>
  		<?php 
  			if(isset($_GET['error'])) { 
  				echo "<p class='info error'>Username or password is incorrect!</p>"; 
  			} 
  			else if(isset($_GET['duplicate'])) {
  				echo "<p class='info error'>Username and password already exists!</p>"; 
  			}
  		?>
  	</div>
  </body>
</html>

<?php
include 'templates/footer_attendee.html';
?>
