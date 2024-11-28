<?php
session_start();

	include "./import/bdd.php";

	if(empty($_SESSION["account"]) and !empty($_COOKIE['mail']) and !empty($_COOKIE['password']))
	{
		$verif_user = $bdd->prepare('SELECT code_key FROM users WHERE mail = ? AND password = ?');
		$verif_user->execute(array($_COOKIE['mail'], $_COOKIE['password']));
		$verif_user = $verif_user->fetch();

		$_SESSION["account"] = $verif_user['code_key'];
	}

	$account = array();

	if(isset($_SESSION["account"]))
	{
		$get_user = $bdd->prepare('SELECT * FROM users WHERE code_key = ?');
		$get_user->execute(array($_SESSION["account"]));
		$account = $get_user->fetch(PDO::FETCH_ASSOC);
	}

	$options = array(
		"menu" => array(
			/*
			Normal menu => array("Accueil", "index.php")
			Submenu menu => array("Accueil", "index.php", array(array("Sous-Accueil", "sub-index.php")))
			*/

			array("Accueil", "index.php"),
			array("Tournois", "tournois.php",
				array(
					array("Séries de tournois", "#"),
					array("Calendrier des tournois", "#"),
					array("Les plus mémorables", "#")
				)
			),
			array("Les joueurs", "players.php",
				array(
					array("Ranking des joueurs", "#"),
					array("Ranking des équipes 2v2", "#"),
					array("Ranking des équipes E-Sport", "#")
				)
			),
			array("Articles", "article.php"),
			array("Équipe", "equipe.php"),
			array("Boutique", "boutique.php")
		),
		"permissions" => array(
			"acces.admin_panel" => "Acc�s au panel administratif"
		)
	);

	function get_perms($grade, $get_perms)
	{
		global $bdd;
		$perms_req = $bdd->prepare('SELECT permissions FROM grade WHERE id = ?');
		$perms_req->execute(array($grade));
		$perms = $perms_req->fetch();

		$result = false;

		if(!empty($perms['permissions']))
		{
			$perms_list = explode("$", $perms['permissions']);

			foreach ($perms_list as $key => $val) {
				if($key == $get_perms or $key = "*")
				{
					$result = true;
				}
			}
		}

		return $result;
	}

	function pre_header($title)
	{
	?>
		<head>
			<!-- Required meta tags -->
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<title><?php echo $title; ?></title>
			<link rel="icon" href="img/favicon.png">
			<!-- Bootstrap CSS -->
			<link rel="stylesheet" href="css/bootstrap.min.css">
			<!-- animate CSS -->
			<link rel="stylesheet" href="css/animate.css">
			<!-- owl carousel CSS -->
			<link rel="stylesheet" href="css/owl.carousel.min.css">
			<!-- font awesome CSS -->
			<link rel="stylesheet" href="css/all.css">
			<!-- flaticon CSS -->
			<link rel="stylesheet" href="css/flaticon.css">
			<link rel="stylesheet" href="css/themify-icons.css">
			<link rel="stylesheet" href="css/nice-select.css">
			<!-- font awesome CSS -->
			<link rel="stylesheet" href="css/magnific-popup.css">
			<!-- swiper CSS -->
			<link rel="stylesheet" href="css/slick.css">
			<!-- style CSS -->
			<link rel="stylesheet" href="css/style.css">
			<!-- Pro Font Awesome -->
        	<link rel="stylesheet" href="https://kit-pro.fontawesome.com/releases/v6.2.0/css/pro.min.css">
		</head>
	<?php
	}

	function head($nav,$client)
	{
	?>
		<!--::header part start::-->
		<header class="main_menu single_page_menu">
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-12">
						<nav class="navbar navbar-expand-lg navbar-light">
							<a class="navbar-brand" href="index.html"> <img src="img/logo.png" alt="logo"> </a>
							<button class="navbar-toggler" type="button" data-toggle="collapse"
								data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="menu_icon"><i class="fas fa-bars"></i></span>
							</button>

							<div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
								<ul class="navbar-nav">
									<?php
									foreach ($nav['menu'] as $key => $val) {
										if(!isset($val[2]))
										{
										?>
											<li class="nav-item">
												<a class="nav-link" href="<?php echo $val[1]; ?>"><?php echo $val[0]; ?></a>
											</li>
										<?php
										}
										else
										{
										?>
											<li class="nav-item dropdown">
												<a class="nav-link dropdown-toggle" href="<?php echo $val[1]; ?>" id="navbarDropdown"
													role="button" data-toggle="dropdown" aria-haspopup="true"
													aria-expanded="false">
													<?php
														echo $val[0];
													?>
												</a>
												<div class="dropdown-menu" aria-labelledby="navbarDropdown">
													<?php
													foreach ($val[2] as $key => $var) {
													?>
														<a class="dropdown-item" href="<?php echo $var[1]; ?>"><?php echo $var[0]; ?></a>
													<?php
													}
													?>
												</div>
											</li>
										<?php
										}
									}
									?>
								</ul>
							</div>
							<?php
							if(empty($client))
							{
							?>
								<a href="login.php" class="btn_1 d-none d-sm-block">Connexion</a>
							<?php
							}
							else
							{
							?>
								<div class="dropdown">
									<button class="btn_1 btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php echo $client['pseudo']; ?>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a class="dropdown-item" href="profil.php"><i class="fa-solid fa-user"></i> Profil</a>
										<a class="dropdown-item" href="#"><i class="fa-solid fa-people-group"></i> Gérer votre équipe</a>
										<a class="dropdown-item" href="#"><i class="fa-solid fa-gear"></i> Paramètre</a>
										<?php if(get_perms($client['grade'], "acces.admin_panel")){echo '<a class="dropdown-item" href="#"><i class="fa-solid fa-lock"></i> Panel d\'administration</a>';} ?>
										<a class="dropdown-item" href="login.php?option=4"><i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion</a>
									</div>
								</div>
							<?php
							}
							?>
						</nav>
					</div>
				</div>
			</div>
		</header>
		<!-- Header part end-->
	<?php
	}

	function foot()
	{
	?>
		<!--::footer_part start::-->
		<footer class="footer_part">
			<div class="footer_top">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-lg-3">
							<div class="single_footer_part">
								<a href="index.html" class="footer_logo_iner"> <img src="img/logo.png" alt="#"> </a>
								<p>Ce site à était créer pour la communauté Albigeoise, centralisé chaque information de tournois de ses derniers !</p>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="single_footer_part">
								<h4>Liens importants</h4>
								<ul class="list-unstyled">
									<li><a href="">Calendrier des tournois</a></li>
									<li><a href="">Les séries de tournois</a></li>
									<li><a href="">Ranking des joueurs (1v1)</a></li>
									<li><a href="">Ranking des joueurs (2v2)</a></li>
									<li><a href="">Articles</a></li>
									<li><a href="">Notre équipê</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="single_footer_part">
								<h4></h4><br>
								<ul class="list-unstyled">
									<li><a href="">Mentions légales</a></li>
									<li><a href="">Condition d'utilisation</a></li>
									<li><a href="">Conditions générales de vente</a></li>
									<li><a href="">Smash.gg</a></li>
								</ul>
							</div>
						</div>
						<div class="col-sm-6 col-lg-3">
							<div class="single_footer_part">
								<h4>Newsletter</h4>
								<p>Être au courrant des dernières nouvelles du site et des tournois présent à Albi</p>
								<div id="mc_embed_signup">
									<form target="_blank"
										action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
										method="get" class="subscribe_form relative mail_part">
										<input type="email" name="email" id="newsletter-form-email"
											placeholder="Adresse E-Mail" class="placeholder hide-on-focus"
											onfocus="this.placeholder = ''"
											onblur="this.placeholder = ' Adresse E-Mail '">
										<button type="submit" name="submit" id="newsletter-submit"
											class="email_icon newsletter-submit button-contactForm"><i
												class="far fa-paper-plane"></i></button>
										<div class="mt-10 info"></div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copygight_text">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-8">
							<div class="copyright_text">
								<P><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
									Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
									<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></P>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="footer_icon social_icon">
								<ul class="list-unstyled">
									<li><a href="#" class="single_social_icon"><i class="fab fa-facebook-f"></i></a>
									</li>
									<li><a href="#" class="single_social_icon"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#" class="single_social_icon"><i class="fas fa-globe"></i></a></li>
									<li><a href="#" class="single_social_icon"><i class="fab fa-behance"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!--::footer_part end::-->
	<?php
	}

	function random($car){
		$string = "";
		$chaine = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		srand((double)microtime()*1000000);
		for($i=0; $i<$car; $i++)
		{
			$string .= $chaine[rand()%strlen($chaine)];
		}
		return $string;
	}

?>
