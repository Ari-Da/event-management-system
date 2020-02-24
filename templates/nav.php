<?php  
$FILE_NAME = basename($_SERVER['PHP_SELF']);

$event_url = "";

// if(isset($_SESSION['user'])) {
// 	$role = intval($_SESSION['user']['role']);
// 	$event_url = getEventComponent($role);
// }
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

		<link rel="stylesheet" href="<?=HTTP_URL ?>css/style.css">
	</head>
	<body>

		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item <?php if ($FILE_NAME == 'index.php') { echo 'active'; } ?>">
		        <a class="nav-link" href="<?=HTTP_URL ?>index.php">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <?php if(isset($_SESSION['user'])) { ?>
		      	<li class="nav-item <?php if ($FILE_NAME == 'events.php') { echo 'active'; } ?>">
			        <a class="nav-link" href="components/events.php">Events</a>
			    </li>
		      <?php } ?>
		    </ul>

		    <?php if(!isset($_SESSION['user'])) { ?>
			    <form id="user-form" class="form-inline" method="post" action="user.php">
			     	<button class="btn btn-outline-warning" type="submit" name="login">Login</button>
			      	<button class="btn btn-outline-warning" type="submit" name="signup">Sign Up</button>
			    </form>
			<?php } else { ?>
				<span class="navbar-text"><?=$_SESSION['user']['name'] ?></span>
				<a href="<?=HTTP_URL . 'logout.php' ?>"><i class="fas fa-sign-out-alt fa-lg"></i></a>
			<?php } ?>
		</nav>
		
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
</html>