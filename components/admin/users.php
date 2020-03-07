<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: " . HTTP_URL . "index.php");
	}

	loadNavBar();
	include 'templates/edit_user.php';
	include 'templates/add_user.php';

	$users = array_filter(Attendee::getAllUsers(), function($user) {
		return $user->getIdAttendee() != $_SESSION['user']['id'];
	});
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Manage users</title>
</head>

<body>
	<?php 
		getMessage();
	?>
	<div class="table-responsive">
		<table class="table table-striped">
		  <thead class="thead-dark">
		    <tr>
		      <th scope="col">Id</th>
		      <th scope="col">Name</th>
		      <th scope="col">Role</th>
		      <th scope="col"></th>
		      <th scope="col" colspan="1"><button type="button" class="btn btn-warning icon" data-toggle="modal" data-target="#addUser"><i class="fas fa-plus-square fa-lg"></i></button></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  		if(count($users) > 0) {
		  			$roles = array();

		  			foreach($users as $user) {
		  				if(!array_key_exists($user->getRole(), $roles)) {
			  				$role = new Role();
			  				$role->setIdRole($user->getRole());
			  				if($role->getRole()) {
			  					$roles[$user->getRole()] = ucfirst($role->getName());
			  				}
			  			}
		  	?>
		    <tr>
		      <th><?=$user->getIdAttendee() ?></th>
		      <th><?=$user->getName() ?></th>
		      <th><?=$roles[$user->getRole()] ?></th>

		      <th class="has-button">
		      	<button type="button" class="btn btn-warning icon" data-toggle="modal" data-target="#editUser" data-details="<?=$user->toArray() ?>">
		      		<i class="fas fa-edit fa-lg"></i>
		      	</button>
		      </th>		 

		      <th class="has-button">
		      	<form method="post" action="delete_user.php">
		      		<input type="hidden" name="id" value="<?=$user->getIdAttendee() ?>" />
		      		<button type="submit" class="btn btn-warning icon">
		      			<i class="fas fa-trash-alt fa-lg"></i>
		      		</button>
		      	</form>
		      </th>
		    </tr>
			<?php
					}// foreach venue 
				} // if count venue
				 else {
				 	echo '<tr><td colspan="3"><h3>No users found!</h3></td></tr>';
				 }
			?>
		  </tbody>
		</table>
	</div>

	<script src="../../js/animate.js"></script>
</body>


<?php
include 'templates/footer_admin.html';
?>
