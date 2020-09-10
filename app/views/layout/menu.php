<nav class="menu">
	<div class="nav-brand">
		TexCards
	</div>
	
	<div class="nav-toggle">
		<i class="fas fa-bars"></i>
	</div>

	<ul>
		<?php
			$menu = Router::get_menu('menu_acl');

			foreach ($menu as $k => $v) {
				echo '<a href="'.BASE_URL.$v.'"><li>'.$k.'</li></a>';
			}
		?>
	</ul>
</nav>

<div class="content">