<div class="content-extra-padding">
    <div class="pop-up">
        <div class="row">
            <div class="col-6">
                <h2>Create an Account</h2>
                Welcome to TexCards! Create an account so you can start saving decks and studying flashcards.
                
                <form action = "/mvc2/register/createaccount" method = "post">
					<label>Username</label>
                    <input type="text" name="username" <?php echo $data["username_class"];?>></input>
                    <span class="fine red"><?php echo $data["username_err"]; ?></span>
                    <br>
                    <label>Password</label>
                    <input type="password" name="password" <?php echo $data["password_class"];?>></input>
                    <span class="fine red"><?php echo $data["password_err"]; ?></span>
                    <br>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password"></input>
                    <br>
                    <input type="submit" value="Create Account" class="block"></input>
                    Already have an account? <a href="<?php echo BASE_URL; ?>register/login">Log in.</a>
                </form>  
            </div>
            <div class="col-6 placeholder img-container">
                <img src="<?php echo BASE_URL;?>img/account_illustration.svg"/>
            </div>
        </div>  
    </div>
</div>