<?php 
$venues = Venue::getAllVenues();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
	<div class="modal fade" id="editEvent" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="edit_event.php">
		      <div class="modal-body">
		      	<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="name" class="input-group-text">Name:</label>
				  </div>
				  <input type="text" id="name" name="name" required></input>
				</div>

		      	<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="start" class="input-group-text">Start date:</label>
				  </div>
				  <input type="datetime-local" id="start" name="start" required></input>
				</div>

		      	<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="end" class="input-group-text">End date:</label>
				  </div>
				  <input type="datetime-local" id="end" name="end" required></input>
				</div>
		      	
		      	<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="allowed" class="input-group-text">No. of participants:</label>
				  </div>
				  <input type="number" id="allowed" name="allowed" min="5" required></input>
				</div>

				<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="venue" class="input-group-text">Venue:</label>
				  </div>
				  <select id="venue" name="venue" onchange="getNumAllowed(this.value)">
				  	<?php foreach($venues as $venue) { ?>
				  	<option value="<?=$venue->getIdVenue(); ?>"><?=$venue->getName(); ?></option>
				  	<?php } ?>
				  </select>
				</div>
		      </div>

		      <div class="modal-footer">
		        <button type="submit" class="btn btn-warning" name="submitBtn" value="">Edit</button>
		      </div>
		      <input type="hidden" id="id" name="id" value=""/>
		      <input type="hidden" id="type" name="type" value=""/>
		      <input type="hidden" id="event" name="event" value=""/>
	  	  </form>
	    </div>
	  </div>
	</div>


    <script src="<?=HTTP_URL ?>js/eventEdit.js"></script>
  </body>
</html>
