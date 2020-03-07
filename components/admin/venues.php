<?php 
	if(!isset($_SESSION['user'])) {
		header("Location: " . HTTP_URL . "index.php");
	}

	loadNavBar();
	include 'templates/add_venue.html';
	include 'templates/edit_venue.html';

	$venues = Venue::getAllVenues();
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Manage venues</title>
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
		      <th scope="col">Capacity</th>
		      <th scope="col"></th>
		      <th scope="col" colspan="1"><button type="button" class="btn btn-warning icon" data-toggle="modal" data-target="#addVenue"><i class="fas fa-plus-square fa-lg"></i></button></th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		  		if(count($venues) > 0) {
		  			foreach($venues as $venue) {
		  	?>
		    <tr>
		      <th><?=$venue->getIdVenue() ?></th>
		      <th><?=$venue->getName() ?></th>
		      <th><?=$venue->getCapacity() ?></th>

		      <th class="has-button">
		      	<button type="button" class="btn btn-warning icon" data-toggle="modal" data-target="#editVenue" data-details="<?=$venue->toArray() ?>">
		      		<i class="fas fa-edit fa-lg"></i>
		      	</button>
		      </th>		 

		      <th class="has-button">
		      	<form method="post" action="delete_venue.php">
		      		<input type="hidden" name="id" value="<?=$venue->getIdVenue() ?>" />
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
				 	echo '<tr><td colspan="5"><h3>No venues found!</h3></td></tr>';
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
