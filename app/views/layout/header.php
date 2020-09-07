<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.css" integrity="sha384-AfEj0r4/OFrOo5t7NnNe46zW/tFgW6x/bCJG8FqQCEo3+Aro6EYUG4+cU+KJWu/X" crossorigin="anonymous">

		<script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/katex.min.js" integrity="sha384-g7c+Jr9ZivxKLnZTDUhnkOnsh30B4H0rpLUpJ4jAIKs4fnJI+sEnkvrMWph2EDg4" crossorigin="anonymous"></script>

		<script defer src="https://cdn.jsdelivr.net/npm/katex@0.12.0/dist/contrib/auto-render.min.js" integrity="sha384-mll67QQFJfxn0IYznZYonOWZ644AWYC+Pt2cHqMaRhXVrursRwvLnLaebdGIlYNa" crossorigin="anonymous"></script>
        
        <link href="http://fonts.googleapis.com/css?family=Nunito|Karla|Unica+One" rel='stylesheet' type='text/css'>
		<script src="https://kit.fontawesome.com/15392706b4.js" crossorigin="anonymous"></script>                
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="http://localhost/mvc2/css/style.css" />
		
		<script src="<?php echo BASE_URL?>js/nav.js"></script>
		<script src="<?php echo BASE_URL?>js/form.js"></script>
		<script src="<?php echo BASE_URL?>js/alerts.js"></script>
		
		<title>MVC Test Application</title>
    </head>
    <body>	
		<div id="alert-container">
		</div>
	
        <nav class="menu">
        	<div class="nav-brand">
        		TexCards
        	</div>
            
            <div class="nav-toggle">
        		<i class="fas fa-bars"></i>
            </div>
	
        	<ul>
                <a href="<?php echo BASE_URL;?>page/view/home"><li>Home</li></a>
        		<a href="<?php echo BASE_URL;?>register/login"><li>Log in</li></a>
                <a href="<?php echo BASE_URL;?>register/createaccount"><li>Create an Account</li></a>
                <a href="<?php echo BASE_URL;?>register/logout"><li>Logout</li></a>
                <a href="<?php echo BASE_URL;?>decks/create"><li>Create a Deck</li></a>
                <a href="<?php echo BASE_URL;?>decks/view"><li>My Decks</li></a>
            </ul>
        </nav>
        
        <!--You are logged in as <?php if (isset($_SESSION["username"])) { echo $_SESSION["username"]; } ?>
        <br>
        Cookies are <?php if (isset($_COOKIE["username"])) {echo $_COOKIE["username"]." ".$_COOKIE["auth"];} ?> -->
		
        <div class="content">