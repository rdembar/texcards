<div class="content-extra-padding">
	<div class="pop-up login">
		<div class="row img-row">
			<div class= "col-6">
				<h2>Login</h2>
				Welcome back! Log into your account to start studying.
                
				<form action = "/mvc2/register/login" method = "post">
					<label>Username</label>
					<input type="text" name="username" <?php echo $data["username_class"];?>></input>
					<span class="fine red username_err"><?php echo $data["username_err"]; ?></span>
					<br>
					<label>Password</label>
					<input type="password" name="password" <?php echo $data["password_class"];?>></input>
					<span class="fine red password_err"><?php echo $data["password_err"]; ?></span>
					<br>
					<span class="container">Remember Me
						<input type="checkbox" name="remember_me" />
						<span class="checkmark"></span>
					</span>
					<br>
					<input type="submit" value="Login" class="block"></input>
					Don't have an account? <a href="<?php echo BASE_URL; ?>register/createaccount">Sign up.</a>
				</form>  
			</div>
			<div class="col-6 placeholder-med img-container">
				<img src="<?php echo BASE_URL;?>img/login_illustration.svg"/>
			</div>
		</div>
	</div>
</div>
