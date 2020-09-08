<?php
// Fill in title in edit mode or save if form not submitted
$title = "";
if (isset($_POST["title"])) {
	$title = $_POST["title"];
} elseif (isset($data["title"])) {
	$title = $data["title"];
}

// Fill in cards in edit mode or save if form not submitted
if (isset($data["cards"])) {
	echo "<script>var cards_arr = ".json_encode($data["cards"]).";</script>";
}

// New account alert
if ($data["new_account"] == true) {
	echo '<script>
			pop_up_slide("success", "Success!", "Your account has been created successfully. Get started by creating your first deck.");
		  </script>';
}
?>

<div class="row">
    <form action = "" method = "post">
		<div class="col-12">
			<h2>
				<?php if (isset($data["title"])) {
					echo "Edit ".$data["title"];
				} else {
					echo "Create a Deck";
				}?>
			</h2>
			<label>Title</label>
			<input type="text" name="title" value="<?php echo $title;?>" placeholder="Give your deck a title" />
			<span class="fine red"><?php echo $data["err"]; ?></span>
					
			<br><br>
			<span class="fine">Add LaTeX to cards by putting it in between double dollar sign characters '$$'.</span>
			
			
			<table id="cards" class="create-table card-table">
				<tr>
					<td><label>Card</label></td>
					<td><label>Question</label></td>
					<td><label>Answer</label></td>
					<td></td>
				</tr>
			</table>
			<button id="add_card" class="button-outline right"><i class="fas fa-plus-circle"></i>Add a Card</button>
			<div class="create-buttons">
				<input type="submit" name="save" value="Save Deck" />
				<input type="submit" class="green" value="Start Studying" />
			</div> 
		</div>
    </form>
</div>
<script src="<?php echo BASE_URL; ?>js/create.js"></script>