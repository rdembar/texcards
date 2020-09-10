<!DOCTYPE HTML>
    <head>
        <link href="http://fonts.googleapis.com/css?family=Nunito|Karla|Unica+One" rel='stylesheet' type='text/css'>
		<script src="https://kit.fontawesome.com/15392706b4.js" crossorigin="anonymous"></script>                
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="http://localhost/mvc2/css/style.css" />
        
        <style>
            .color-card {
                font-weight: bold;
                text-align: center;
            }
            .color {
                width: 100%;
                height: 100px;
                box-sizing: content-box;
                padding: 5px 15px;
                margin: -10px 0 5px -15px;
            }
			.alert {
				position: relative !important;
			}
			.small-text {
				width: 40px !important;
				font-size: 0.8em;
				padding: 2px !important;
			}
        </style>
    </head>
    <body style="padding: 10px;">
        <h2>Color pallete</h2>
        <label>Main</label>
        <div class="row">
            <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #007EFA"></div>
                    #007EFA
					<br>
					rgb(0, 126, 250)
                </div>
            </div>
            
            <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #FFC937"></div>
                    #FFC937
					<br>
					rgb(255, 201, 55)
                </div>
            </div>
        </div>
        
        <label>Secondary</label>
        <div class="row">
            <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #03d565"></div>
                    #03D565
					<br>
					rgb(3, 213, 101)
                </div>
            </div>
            
            <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #EB5157"></div>
                    #EB5157
					<br>
					rgb(235, 81, 87)
                </div>
            </div>
        </div>
        
        <label>Other</label>
        <div class="row">
            <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #4c4c4c"></div>
                    #4C4C4C (Text)
                </div>
            </div>
            
            <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #777777"></div>
                    #777777
                </div>
            </div>
            
             <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #f8f9fa"></div>
                    #F8F9FA
                </div>
            </div>
             
              <div class="col-3">
                <div class="card color-card">
                    <div class="color" style="background: #ffffff"></div>
                    #FFFFFF
                </div>
            </div>
        </div>
        
        <h2>Navigation</h2>

        <label>Menu</label>
        <nav class="menu">
        	<div class="nav-brand">
        		TexCards
        	</div>
            
            <div class="nav-toggle">
        		<i class="fas fa-bars"></i>
            </div>
	
        	<ul>
        		<li class="active">My Decks</li>
        		<li>Create a Deck</li>
        		<li>My Account</li>
        		<li>Home</li>
        	</ul>
        </nav>

        <br>

        <h2 class="blue">Buttons</h2>

        <button class="button-fill">Filled In</button>
        <button class="button-outline">Outline</button>

        <br><br>

        <button class="button-fill large">Large button</button>
        <button class="button-fill">Default button</button>
        <button class="button-fill small">Small button</button>

        <br><br>

        <button class="button-fill block large">Block button</button>

        <br><br>

        <h1>Typography</h1>

        <h1>Heading 1</h1>
        <h2>Heading 2</h2>
        <h3>Heading 3</h3>
        <h4>Heading 4</h4>
        <h5>Heading 5</h5>
        <h6>Heading 6</h6>

        <br>

        <h2>Heading</h2>
        <h3 class="muted">With a subheading</h2>

        <br>

        <h1>Body text</h1>
        Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque
        penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam
        <a href="#">id dolor id</a> nibh ultricies vehicula.

        <br><br>

        <span class="fine">This line of text is meant to be treated as fine print.</span>

        <br><br>

        The following is <b>rendered as bold text.</b>

        <br><br>

        The following is <i>rendered as italicized text</i>

        <br><br>

        <h1>Form elements</h1>

        <form>
        	<label>Email address</label>
        	<input type="text" placeholder="Enter email"></input>
        	<span class="fine">We'll never share your email with anyone else.</span>
        	<br>
        	<label>Password</label>
        	<input type="password" placeholder="Password"></input>
        	<br>
        	<label>Example textarea</label>
        	<textarea></textarea>
        	<br>
        	<label>Disabled input</label>
        	<input type="text" placeholder="Disabled input here" disabled></input>
        	<br>
        	<label>Valid input</label>
        	<input type="text" value="Correct value" class="valid"></input>
        	<span class="fine green">Success! You've done it.</span>
        	<br>
        	<label>Invalid input</label>
        	<input type="text" value="Wrong value" class="invalid"></input>
        	<span class="fine red">Sorry, that username's taken. Try another?</span>
        	<br>
        	<label>Checkboxes</label>
            <span class="container">Here is an item
                <input type="checkbox" name="remember_me" />
                <span class="checkmark"></span>
            </span>
            <br>
            <span class="container">And another one
                <input type="checkbox" name="remember_me" />
                <span class="checkmark"></span>
            </span>
        	<br>
        	<input type="submit" value="Submit"></input>
        </form>

        <br><br>

        <h1>Indicators</h1>

        <div class="alert alert-error">
        	<div class="exit"><i class="fas fa-times"></i></div>
			<table>
				<tr>
					<td><i class="fas fa-times-circle"></i></td>
					<td>
						<b>Error</b>
						<br>
						Message goes here.
					</td>
				</tr>
			</table>
        </div>

        <br>

        <div class="alert alert-warning">
        	<div class="exit"><i class="fas fa-times"></i></div>
			<table>
				<tr>
					<td><i class="fas fa-exclamation-triangle"></i></td>
					<td>
						<b>Warning</b>
						<br>
						Message goes here.
					</td>
				</tr>
			</table>
        </div>
		
		<br>
		
		<div class="alert alert-info">
        	<div class="exit"><i class="fas fa-times"></i></div>
			<table>
				<tr>
					<td><i class="fas fa-info-circle"></i></td>
					<td>
						<b>Info</b>
						<br>
						Message goes here.
					</td>
				</tr>
			</table>
        </div>
		
		<br>
		
		<div class="alert alert-success">
        	<div class="exit"><i class="fas fa-times"></i></div>
			<table>
				<tr>
					<td><i class="fas fa-check-circle"></i></td>
					<td>
						<b>Success</b>
						<br>
						Message goes here.
					</td>
				</tr>
			</table>
        </div>
        
        <br>
        
        <div class="pop-up">
            <div class="exit"><i class="fas fa-times"></i></div>
            <h2>Pop-up</h2>
            This is a pop-up box. It is bigger than an alert.
        </div>

        <h1>Progress</h1>
    
		<label>Progress Bars</label>
        <div class="progress"><div class="progress-fill" style="width: 40%;"></div></div>
        <br>
        <div class="progress"><div class="progress-fill progress-fill-red" style="width: 20%;"></div></div>
        <br>
        <div class="progress"><div class="progress-fill progress-fill-green" style="width: 70%;"></div></div>
        
		<br><br>
		
		<label>Progress dots</label>
		<br> % filled: <input type="text" class="small-text" value="0"/>
		<div class="progress-dots"></div>
		
		<br><br>
		
        <h2>Cards</h2>

        <label>Basic cards</label>
        <div class="card">
        	<div class="card-header">Header</div>
        	This is some text inside of the card
        	<br>
        	<span class="fine">Extra information that is small</span>
        </div>

        <div class="card">
        	<div class="card-header card-header-grey">Header</div>
        	Grey header
        </div>


        <div class="card">
        	<h3>A card without a header</h3>
        	With some text
        </div>
        
        <label>Create a Deck</label>
        <div class="card">
            <div class="card-header">Card 1</div>
            <table>
                <tr>
                    <td>
                        <label>Term</label>
                        <textarea></textarea>
                    </td>
                    <td>
                        <label>Answer</label>
                        <textarea></textarea>
                    </td>
                </tr>
            </table>
        </div>
        
        <label>My Decks</label>
        <div class="card">
            <h3>A Deck</h3>
            <span class="fine">5 cards</span>
            <br>
            <span class="fine"><i class="far fa-clock"></i> Last studied on Jun 12, 2020</span>
        </div>

        <label>Flashcard</label>
        <div id = "card">
            <div class="card-inner">
                <div class="front card"><div class="text">Front of card</div></div>
                <div class="back card"><div class="text">Back of card</div></div>
            </div>
        </div>

        <br><br><br>
    </body>
    
    <script>
		// Flashcard flip
        $('#card').on('click', function() {
            if ($('.card-inner').css('transform') == 'none') {
                $('.card-inner').css('transform', 'rotateY(180deg)');
            } else {
                $('.card-inner').css('transform', 'none');   
            }
        });
		
		// Progress dots
		var num_dots = 0;
		var progress = 0;
		var prev_progress = 0;
		
		$(document).ready(function() {
			fill_dots();
			set_progress();
			
			$(window).resize(function() {
				fill_dots();
				set_progress();
			});
			
			$('.small-text').on('keydown', function(e) {
				if(e.which == 13) {
					prev_progress = progress;
					progress = ($(this).val())/100;
					set_progress();
				}
			});
		});
		
		function fill_dots() {
			$('.progress-dots').html('');
			num_dots = Math.floor($('.progress-dots').width()/24);
			for (var i = 0; i < num_dots; i++) {
				$('.progress-dots').append('<div class="progress-dot" />');
			}
		}
		
		function set_progress() {
			if(progress > prev_progress) {
				for(var i = Math.floor(num_dots*prev_progress); i < Math.floor(num_dots*progress); i++) {
					fill_dot(i, 50*(i-Math.floor(num_dots*prev_progress)));
				}
			}else if (progress < prev_progress) {
				for(var i = Math.floor(num_dots*prev_progress)-1; i >= Math.floor(num_dots*progress); i--) {
					unfill_dot(i, 50*(Math.abs(i-Math.floor(num_dots*prev_progress)+1)));
				}
			}
		}
		
		function fill_dot(i, time) {
			setTimeout(function() {
				$($('.progress-dot')[i]).addClass('dot-fill');
			}, time);
		}
		
		function unfill_dot(i, time) {
			setTimeout(function() {
				$($('.progress-dot')[i]).removeClass('dot-fill');
			}, time);
		}
    </script>
    <script src="<?php echo BASE_URL?>js/nav.js"></script>
    <script src="<?php echo BASE_URL?>js/form.js"></script>
</html>