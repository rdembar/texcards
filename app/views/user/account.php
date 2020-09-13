<div class="row">
	<div class="col-6">
		<h2>Account Information</h2>
		<form action = "" method = "post">
			<input type="hidden" name="change_username" value="yes" />
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $_SESSION["username"];?>" />
			<span class="fine red" id="username"><?php echo $data["username_err"];?></span>
			<input type="submit"  class="block" value="Save Changes" />
		</form>
		
		<br>
		
		<h3>Change Password</h3>
		<form action = "" method = "post">
			<input type="hidden" name="change_password" value="yes" />
			<label>Current Password</label>
			<input type="password" name="password" />
			<span class="fine red" id="password"><?php echo $data["password_err"];?></span>
			<br>
			<label>New Password</label>
			<input type="password" name="new_password" />
			<span class="fine red" id="new_password"><?php echo $data["new_password_err"];?></span>
			<br>
			<label>Confirm New Password</label>
			<input type="password" name="confirm_new_password" />
			<input type="submit" class="block" value="Save Password" />
		</form>
		
		<br>
		
		<a href="<?php echo BASE_URL;?>account/delete_account"><i class="fas fa-trash"></i>Delete Account</a>
	</div>
</form>
	
	<div class="col-6 placeholder">
         <img src="<?php echo BASE_URL;?>img/account_illustration_2.svg"/>
    </div>
</div>