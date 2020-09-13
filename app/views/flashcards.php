<?php
	// Convert cards to javascript array
	echo "<script> var cards_arr = ".json_encode($data["cards"]).";</script>";
?>

<div class="row">
	<div class="col-4">
		<h2><?php echo $data["title"];?></h2>
		<?php echo count($data["cards"]);?> card<?php echo count($data["cards"]) == 1 ? "" : "s";?>
		<br>
		Last studied on <?php echo date_format(date_create($data["last_studied"]), 'M j, Y');?>
		
		<br><br>
		
		<span class="fine">Use arrow keys to go to next/previous card. Use spacebar or click to flip card.</span>
		
		<br><br>
		
		<button class="button-fill block spaced"
				onclick="window.location.href='<?php echo BASE_URL;?>cards/study/<?php echo $data["deck_id"];?>';">Study</button>
		<br>
		<button style="margin-bottom: 8px;" class="button-outline block spaced"
				onclick="window.location.href='<?php echo BASE_URL;?>decks/edit/<?php echo $data["deck_id"];?>';">Edit</button>
		<br>
		
		<a id="delete" style="margin-top: 8px;" href="<?php echo BASE_URL;?>decks/delete/<?php echo $data['deck_id'];?>">
			<i class="fas fa-trash"></i>Delete Deck
		</a>
	</div>
	
	<div class="col-8">
		<div id = "card">
            <div class="card-inner">
                <div class="front card"><div class="text"></div></div>
                <div class="back card"><div class="text"></div></div>
            </div>
        </div>
		
		<br>
		
		<span class="fine" style="float: right;">Card <span id="index">1</span>/<?php echo count($data["cards"]);?></span>
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

<script>
	var study = false;
</script>
<script src="<?php echo BASE_URL;?>js/progress.js"></script>
<script src="<?php echo BASE_URL;?>js/cards.js"></script>
<script src="<?php echo BASE_URL;?>js/study.js"></script>