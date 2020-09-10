<?php 
echo '<script>';
		if($data["static"]) {
			echo 'pop_up_static("'.$data["type"].'", "'.$data["message"].'")';
		} else {
			echo 'pop_up_slide("'.$data["type"].'", "'.$data["message"].'")';
		}
	  echo'</script>';
?>