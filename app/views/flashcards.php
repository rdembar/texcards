<?php
	// Convert cards to javascript array
	echo "<script> var cards_arr = ".json_encode($data["cards"]).";</script>";
?>

<script>
	pop_up_alert("warning", "Are you sure?", "Hello");
</script>

<div class="row">
	<div class="col-4">
		<h2><?php echo $data["title"];?></h2>
		<?php echo count($data["cards"]);?> card<?php echo count($data["cards"]) == 1 ? "" : "s";?>
		<br>
		Last studied on ???
		<br>
		<button class="button-fill block"
				onclick="window.location.href='<?php echo BASE_URL;?>cards/study/<?php echo $data["deck_id"];?>';">Study</button>
		<br>
		<button class="button-outline block"
				onclick="window.location.href='<?php echo BASE_URL;?>decks/edit/<?php echo $data["deck_id"];?>';">Edit</button>
		<br><br>
		<a href = ""><i class="fas fa-trash"></i>Delete Deck</a>
	</div>
	
	<div class="col-8">
		<div id = "card">
            <div class="card-inner">
                <div class="front card"><div class="text">Front of card</div></div>
                <div class="back card"><div class="text">Back of card</div></div>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-12">
		<h3>Cards</h3>
		<table class="card-table">
			<tr>
				<td><label>Card</label></td>
				<td><label>Term</label></td>
				<td><label>Answer</label></td>
			</tr>
			
			<?php 
				$card_num = 1;
				
				foreach($data["cards"] as $k => $v) {
					echo '<tr>
							<td>'.$card_num.'</td>
							<td>'.$k.'</td>
							<td>'.$v.'</td>
						  </tr>';
					$card_num += 1;
				}
			?>
		</table>
	</div>
</div>

<script src="<?php echo BASE_URL;?>js/cards.js"></script>