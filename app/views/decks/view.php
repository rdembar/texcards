<?php
// Display deck deleted pop-up
if ($data["deleted"] == true) {
	echo "<script>
			pop_up_slide('success', 'Success', 'Your deck has been deleted', 1200);
		  </script>";
}
?>

<div class="row">
	<div class="col-12">
		<table>
			<tr>
				<td style="width: 100px;"><i class="far fa-folder block-large"></i></td>
				<td>
					<h2><?php echo $_SESSION["username"];?>'s decks</h2>
					<?php echo count($data["decks"]);?> decks
				</td>
			</tr>
		</table>
	</div>
</div>


<div class="row">
	<div class="col-12">
		<?php
			// Display message if no decks
			if(count($data["decks"]) == 0) {
				echo "You have not made any decks yet. <a href='".BASE_URL."decks/create'>Create a deck?</a>";
			}
		?>
		<table class="view-decks card-table">
			<?php
				foreach ($data["decks"] as $deck) {
					echo '<tr>
							<td><h3>'.$deck["title"].'</h3></td>
							<td>'.$deck["num_cards"].' cards</td>
							<td>
								<button class="small button-fill" 
										onclick="window.location.href = \''.BASE_URL.'cards/view/'.$deck["deck_id"].'\';">View</button>
								<button class="small button-fill green"
										onclick="window.location.href = \''.BASE_URL.'cards/study/'.$deck["deck_id"].'\';">Study</button>
								<button class="small button-outline"
										onclick="window.location.href= \''.BASE_URL.'decks/edit/'.$deck["deck_id"].'\';">Edit</button>
							</td>
						  </tr>';
				}
			?>
		</table>
	</div>
</div>