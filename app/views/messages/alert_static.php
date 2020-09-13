<?php
	$icons = array("error" => "times-circle", "warning" => "exclamation-triangle", "info" => "info-circle", "success" => "check-circle");
	
	// Unset session variables upon rendering
	if(isset($_SESSION["message"])) {
		unset($_SESSION["message_type"], $_SESSION["message"]);
		if(isset($_SESSION["warn_action"])) {
			unset($_SESSION["warn_action"]);
		}
	}
?>

<div id="alert-container">
	<div class="alert alert-static alert-<?php echo $data["type"];?>">
        <div class="exit"><i class="fas fa-times clickable"></i></div>
		<table>
			<tr>
				<td><i class="fas fa-<?php echo $icons[$data["type"]];?>"></i></td>
				<td>
					<?php echo $data["message"];?>
					<?php
						if($data["warn"]) {
							echo "<br>
								  <form id='form-sure' action='".BASE_URL.$data["action"]."' method='post'>
									<input type='hidden' name='sure' value='yes' />
									<a onclick='$(`#form-sure`).submit();'>Yes, I'm sure.</a>
								  </form>";
						}
					?>
				</td>
			</tr>
		</table>
	</div>
</div>