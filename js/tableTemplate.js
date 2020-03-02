function getRow(id, arr, col1, col2, col3, col4, col5=null) {
	let row = `<thead class="thead-light">
		    <tr>
		      <th scope="col"><?=${col1} ?></th>
		      <th scope="col"><?=${col2} ?></th>
		      <th scope="col"><?=${col3} ?></th>
		      <th scope="col"><?=${col4} ?></th>
		      <th scope="col"><?=${(col5 != null) ? col5 : ""} ?></th>
		      <th scope="col"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editEvent" data-details="<?=${arr} ?>">Edit</button></th>
		      <th scope="col">
		      	<form method="post" action="delete_event.php">
		      		<input type="hidden" name="id" value="<?=${id} ?>" />
		      		<button type="submit" class="btn btn-warning">Delete</button>
		      	</form>
		      </th>
		    </tr>
		 </thead>`;
}