<?php
	if(intval($_SESSION['user']['role']) != 4) { // not super admin
		$roles = array_filter(Role::getAllRoles(), function($role) {
			return $role->getName() != 'super admin';
		});
	}
	else {
		$roles = Role::getAllRoles();
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
  </head>
  <body>
	<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Edit user</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="post" action="edit_user.php">
		      <div class="modal-body">
		      	<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="name" class="input-group-text">Name:</label>
				  </div>
				  <input type="text" id="name" name="name" required></input>
				</div>

		      	<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="password" class="input-group-text">New password:</label>
				  </div>
				  <input type="password" id="password" name="password" pattern=".{4,}" title="4 characters minimum"></input>
				</div>

				<div class="input-group flex-nowrap">
				  <div class="input-group-prepend">
				  	<label for="role" class="input-group-text">Role:</label>
				  </div>
			  		<select id="role" name="role" class="form-control" required>
			  			<option value="" disabled>Choose a role</option>
			  		<?php foreach ($roles as $role) { ?>
			  			<option value="<?=$role->getIdRole() ?>"><?=ucfirst($role->getName()) ?></option>
			  		<?php } ?>	
			  		</select>
				</div>


		      <div class="modal-footer">
		        <button type="submit" class="btn btn-warning" name="submitBtn" value="">Edit</button>
		      </div>
		      <input type="hidden" id="id" name="id" value=""/>
		  	</div>
	  	  </form>
	    </div>
	  </div>
	</div>

    <script src="../../js/userEdit.js"></script>
  </body>
</html>
