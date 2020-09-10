<?php
	if(isset($data["pop-up"])) {
		echo '<div id="alert-container" style="display: block;">';
	}
?>

<div class="pop-up-container">
	<div class="pop-up">
		<div class="row">
			<div class="col-6">	
				<table>
					<tr>
						<td>
							<?php if (isset($data["pop-up"])) {
									echo '<span class="fine red">Create an account to start making flashcards.</span>';
									}
							?>
							<h2>Create an Account</h2>
							Welcome to TexCards! Create an account so you can start saving decks and studying flashcards.
						</td>
						<td><img src="<?php echo BASE_URL;?>img/account_illustration.svg"/></td>
					</tr>
				</table>
			
			
				<form action = "<?php echo BASE_URL;?>register/createaccount" method = "post">
					<label>Username</label>
					<input type="text" name="username"></input>
					<span class="fine red" id="username"><?php echo isset($data["username_err"]) ? $data["username_err"] : ""; ?></span>
					<br>
					<label>Password</label>
					<input type="password" name="password"></input>
					<span class="fine red" id="password"><?php echo isset($data["password_err"]) ? $data["password_err"] : ""; ?></span>
					<br>
					<label>Confirm Password</label>
					<input type="password" name="confirm_password"></input>
					<br>
					<input type="submit" value="Create Account" class="block"></input>
					Already have an account? <a href="<?php echo BASE_URL; ?>register/login">Log in.</a>
				</form>  
			</div>
			<div class="img-contain">
				<img src="<?php echo BASE_URL;?>img/account_illustration.svg"/>
			</div>
		</div>  
	</div>
</div>

<?php
	if(isset($data["pop-up"])) {
		echo '</div>';
	}
?>