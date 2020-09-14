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
?>
<!-- KaTeX -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.css" integrity="sha384-AfEj0r4/OFrOo5t7NnNe46zW/tFgW6x/bCJG8FqQCEo3+Aro6EYUG4+cU+KJWu/X" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.js" integrity="sha384-g7c+Jr9ZivxKLnZTDUhnkOnsh30B4H0rpLUpJ4jAIKs4fnJI+sEnkvrMWph2EDg4" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/auto-render.min.js" integrity="sha384-mll67QQFJfxn0IYznZYonOWZ644AWYC+Pt2cHqMaRhXVrursRwvLnLaebdGIlYNa" crossorigin="anonymous"></script>


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
			<input type="text" name="title" value="<?php echo str_replace('"', '&quot;', $title);?>" placeholder="Give your deck a title" />
			<span class="fine red" id="title"><?php echo $data["err"]; ?></span>
					
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