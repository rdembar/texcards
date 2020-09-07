<?php
	// Convert cards to javascript array
	echo "<script> var cards_arr = ".json_encode($data["cards"]).";</script>";
?>

<div class="col-12">
	<div id = "card">
        <div class="card-inner">
            <div class="front card"><div class="text">Front of card</div></div>
            <div class="back card">
				<div class="text">Back of card</div>
				<button onclick="wrong();">Wrong</button><button onclick="correct();">Correct</button>
			</div>
        </div>
    </div>
	
	<div class="end-round">
		Hello, the round has ended!
	</div>
</div>

<script src="<?php echo BASE_URL;?>js/cards.js"></script>
<script src="<?php echo BASE_URL;?>js/study.js"></script>