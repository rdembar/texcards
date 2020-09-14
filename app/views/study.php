<?php
	// Convert cards to javascript array
	echo "<script> var cards_arr = ".json_encode($data["cards"]).";</script>";
?>
<!-- KaTeX -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.css" integrity="sha384-AfEj0r4/OFrOo5t7NnNe46zW/tFgW6x/bCJG8FqQCEo3+Aro6EYUG4+cU+KJWu/X" crossorigin="anonymous">
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.js" integrity="sha384-g7c+Jr9ZivxKLnZTDUhnkOnsh30B4H0rpLUpJ4jAIKs4fnJI+sEnkvrMWph2EDg4" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/auto-render.min.js" integrity="sha384-mll67QQFJfxn0IYznZYonOWZ644AWYC+Pt2cHqMaRhXVrursRwvLnLaebdGIlYNa" crossorigin="anonymous"></script>


<div class="flashcard-container">
	<div class="row" id="title-row">
		<div class="col-12">
			<h2>Studying: <?php echo $data["title"];?></h2>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<span id="back" class="fine"><i class="fas fa-undo"></i> Back to previous card</span>
			<span class="fine" id="progress" style="float: right;">Card <span id="index">1</span>/<?php echo count($data["cards"]);?></span>
			<div id = "card">
				<div class="card-inner">
					<div class="front card">
						<div class="text">Front of card</div>
					</div>
					<div class="back card">
						<div class="text">Back of card</div>
						<div class="button-container">
							<button class="button-fill button-wrong" onclick="wrong();">Wrong</button><button class="button-fill button-correct" onclick="press_correct();">Correct</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
			
	<!-- End of round screen -->
	<div class="row end-round" style="display: none;">
		<div class="col-12">
			<h2>End of Round 1</h2>
			<br>
			
			<label>Progress</label>
			
			<table style="text-align: center;">
				<tr>
					<td>
						<div class="card">
							<span id="span-cards" class="large">21</span> 
							<br>
							Cards
						</div>
					</td>
					<td>
						<div class="card">
							<span id="span-correct" class="large green">21</span> 
							<br>
							Correct
						</div>
					</td>
					<td>
						<div class="card">
							<span id="span-wrong" class="large red">21</span> 
							<br>
							Wrong
						</div>
					</td>
				</tr>
			</table>
			
			<br>
			
			<button class="button-fill block" onclick="new_round();">Next Round</button>
		</div>
	</div>
</div>

<!-- End of deck screen -->	
<div class="row end-study">
	<div class="col-12">
		<h2>Congratulations!</h2>
		You have finished studying <b><?php echo $data["title"];?></b>. Keep up the good work!
		
		<br><br>
		
		<h3>Progress</h3>
		
		<table id="progress-table" class="card-table">
			<tr>
				<td><label>Round</label></td>
				<td><label>Cards</label></td>
				<td><label>Correct</label></td>
				<td><label>Incorrect</label></td>
			</tr>
		</table>
		
	</div>
	<div class="col-6">
		<button class="button-outline block"
				onclick="window.location.href='<?php echo BASE_URL;?>decks/view';">Return to Decks</button>
	</div>
	<div class="col-6">
		<button class="button-fill block"
				onclick="window.location.href='<?php echo BASE_URL;?>cards/study/<?php echo $data["deck_id"];?>';">Study again</button>
	</div>
</div>

<script>
	var study = true;
</script>
<script src="<?php echo BASE_URL;?>js/cards.min.js"></script>
<script src="<?php echo BASE_URL;?>js/study.js"></script>

