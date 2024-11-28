<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include "./import/header.php";

	if(isset($_GET['user']))
	{
		$get_user = $bdd->prepare('SELECT * FROM users WHERE pseudo = ?');
		$get_user->execute(array($_GET['user']));
		$profil = $get_user->fetch(PDO::FETCH_ASSOC);
	}
	else
	{
		$get_user = $bdd->prepare('SELECT * FROM users WHERE code_key = ?');
		$get_user->execute(array($_SESSION["account"]));
		$profil = $get_user->fetch(PDO::FETCH_ASSOC);
	}

?>
<!doctype html>
<html lang="fr">

	<?php pre_header("ASR"); ?>

	<style>
	img.banner_config {
		max-height: 320px;
		max-width: 1170px;
		object-fit: cover;
			object-position: auto auto;
	}
	@media screen and (max-width: 1200px) and (min-width: 991px) {
		img.center_screen {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		div.center_screen {
			margin-top: 15px;
			text-align: center;
		}
		img.banner_config {
			max-height: 380px;
		}
	}
	@media screen and (max-width: 990px) {
		img.center_screen {
			display: block;
			margin-left: auto;
			margin-right: auto;
		}
		div.center_screen {
			margin-top: 15px;
			text-align: center;
		}
		img.banner_config {
			max-height: 280px;
		}
	}
	</style>

	<body>
		<!--::header part start::-->
		<header class="main_menu single_page_menu">
			<?php
				head($options,$account);
			?>
		</header>
		<!-- Header part end-->

		<!-- breadcrumb start-->
		<section class="breadcrumb breadcrumb_bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="breadcrumb_iner text-center">
							<div class="breadcrumb_iner_item">
								<h2>Profil utilisateur</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- breadcrumb start-->

		<div class="element_page black">
			<!-- Start Align Area -->
			<div class="whole-wrap">
				<div class="container" style="margin-top: 20px;">
					<div class="card">
						<img class="banner_config" src="./img/users/<?php echo $profil['banner']; ?>">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-2">
									<img class="center_screen" src="./img/users/<?php echo $profil['avatar']; ?>" style="width: 163px;">
								</div>
								<div class="col-lg-7 center_screen">
									<h2>
										<?php
											echo $profil['pseudo'];

											$get_grade = $bdd->prepare('SELECT * FROM grade WHERE id = ?');
											$get_grade->execute(array($profil["grade"]));
											$get_grade = $get_grade->fetch();

											echo '<img class="center_screen" src="./img/grade/'.$get_grade['icon'].'" title="'.$get_grade['name'].'" style="width: 40px;">';

											if(!empty($profil['title_selected']))
											{
												$get_title = $bdd->prepare('SELECT * FROM titles WHERE id = ?');
												$get_title->execute(array($profil['title_selected']));
												$get_title = $get_title->fetch();
												echo "
												<br>
												<p><b>✨ ".$get_title['nom']."</b></p>";
											}
										?>
									</h2>
									<h4>
										<?php
											if(!empty($profil['organisme']))
											{
												echo "TEST";
											}
											if(!empty($profil['team']))
											{
												echo "TEST";
											}
											echo "Inscrit depuis le ".date("d/m/Y", strtotime($profil['registered']));
										?>
									</h4>
									<h4>
										<i>
										<?php
											echo $profil['first_name']." ".$profil['last_name'];
										?>
										</i>
									</h4>
								</div>
								<div class="col-lg-3" align="center">
									<?php
										if(!isset($_GET['user']) or $_GET['user'] == $account['pseudo'])
										{
										?>
											<div class="dropdown">
												<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Gestion du compte
												</button>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
													<a class="dropdown-item" href="edit_profil.php?option=1">Changer la bannière ou l'avatar</a>
													<a class="dropdown-item" href="edit_profil.php?option=2">Gérer les informations généraux</a>
													<a class="dropdown-item" href="edit_profil.php?option=4">Gérer les informations de confidentialité</a>
													<a class="dropdown-item" href="edit_profil.php?option=5">Changer de mot de passe</a>
													<a class="dropdown-item" href="support.php?option=1">Demander un titre</a>
													<a class="dropdown-item" href="support.php?option=2">Faire une réclamation</a>
												</div>
											</div>
										<?php
										}
									?>
								</div>
							</div>
							<?php
							if(!empty($profil['description']))
							{
								echo "
								<br>
								<h2>Description:</h2>
								<blockquote class='generic-blockquote'>
									".$profil['description']."
								</blockquote>
								";
							}
							?>
							<?php
							if(!empty($profil['tournaments_register']))
							{
							?>
								<br>
								<h2>Prochains tournois inscrits:</h2>
								<div style="display: flex">
									<div class="card" style="width: 18rem; margin-left: 5px;">
										<img class="card-img-top" src="..." alt="Card image cap">
										<div class="card-body">
											<h5 class="card-title">Nom de l'event</h5>
											<p class="card-text">
												<b>Ville:</b> Toulouse<br>
												<b>Adresse:</b> Nb Adresse<br>
												<b>Date:</b> 01-01-2022 18h00 au 03-01-2022 23h30<br>
												<b>Joueurs inscrits:</b> 98/128<br><br>
											</p>
											<a href="#" class="btn btn-primary">S'inscrire à l'évènement</a>
										</div>
									</div>
									<div class="card" style="width: 18rem; margin-left: 5px;">
										<img class="card-img-top" src="..." alt="Card image cap">
										<div class="card-body">
											<h5 class="card-title">Nom de l'event</h5>
											<p class="card-text">
												<b>Ville:</b> Toulouse<br>
												<b>Adresse:</b> Nb Adresse<br>
												<b>Date:</b> 01-01-2022 18h00 au 03-01-2022 23h30<br>
												<b>Joueurs inscrits:</b> 98/128<br><br>
											</p>
											<a href="#" class="btn btn-primary">S'inscrire à l'évènement</a>
										</div>
									</div>
									<div class="card" style="width: 18rem; margin-left: 5px;">
										<img class="card-img-top" src="..." alt="Card image cap">
										<div class="card-body">
											<h5 class="card-title">Nom de l'event</h5>
											<p class="card-text">
												<b>Ville:</b> Toulouse<br>
												<b>Adresse:</b> Nb Adresse<br>
												<b>Date:</b> 01-01-2022 18h00 au 03-01-2022 23h30<br>
												<b>Joueurs inscrits:</b> 98/128<br><br>
											</p>
											<a href="#" class="btn btn-primary">S'inscrire à l'évènement</a>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							<?php
							if(!empty($profil['titles']))
							{
							?>
								<br>
								<h2>Titres obtenues:</h2>
								<div style="display: flex">
									<?php
									if(!empty($profil['titles']))
									{
										$titles = explode('$', $profil['titles']);

										foreach ($titles as $key => $value) {
											$get_title = $bdd->prepare('SELECT * FROM titles WHERE id = ?');
											$get_title->execute(array($value));
											$get_title = $get_title->fetch();

											echo '
											<div class="card" style="width: 18rem; margin-left: 5px;">
												<img class="card-img-top" src="..." alt="Card image cap">
												<div class="card-body">
													<h5 class="card-title">'.$get_title['nom'].'</h5>
													<p class="card-text">
														<b>Description:</b><br>'.$get_title['description'].'<br>
													</p>
												</div>
											</div>';
										}
									}
									?>
								</div>
							<?php
							}
							?>
							<br>
							<?php
							if(!empty($profil['tournaments_played']))
							{
							?>
								<br>
								<h2>Derniers tournois ou vous avez participé:</h2>
								<div style="display: flex">
									<div class="card" style="width: 18rem; margin-left: 5px;">
										<img class="card-img-top" src="..." alt="Card image cap">
										<div class="card-body">
											<h5 class="card-title">Nom de l'event</h5>
											<p class="card-text">
												<b>Ville:</b> Toulouse<br>
												<b>Adresse:</b> Nb Adresse<br>
												<b>Date:</b> 01-01-2022 18h00 au 03-01-2022 23h30<br>
												<b>Joueurs inscrits:</b> 98/128<br><br>
											</p>
											<a href="#" class="btn btn-primary">S'inscrire à l'évènement</a>
										</div>
									</div>
									<div class="card" style="width: 18rem; margin-left: 5px;">
										<img class="card-img-top" src="..." alt="Card image cap">
										<div class="card-body">
											<h5 class="card-title">Nom de l'event</h5>
											<p class="card-text">
												<b>Ville:</b> Toulouse<br>
												<b>Adresse:</b> Nb Adresse<br>
												<b>Date:</b> 01-01-2022 18h00 au 03-01-2022 23h30<br>
												<b>Joueurs inscrits:</b> 98/128<br><br>
											</p>
											<a href="#" class="btn btn-primary">S'inscrire à l'évènement</a>
										</div>
									</div>
									<div class="card" style="width: 18rem; margin-left: 5px;">
										<img class="card-img-top" src="..." alt="Card image cap">
										<div class="card-body">
											<h5 class="card-title">Nom de l'event</h5>
											<p class="card-text">
												<b>Ville:</b> Toulouse<br>
												<b>Adresse:</b> Nb Adresse<br>
												<b>Date:</b> 01-01-2022 18h00 au 03-01-2022 23h30<br>
												<b>Joueurs inscrits:</b> 98/128<br><br>
											</p>
											<a href="#" class="btn btn-primary">S'inscrire à l'évènement</a>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							<?php
							if($profil['contact_mail'] == true or $profil['contact_phone'] == true or $profil['contact_discord'] == true)
							{
								echo "<br><h2>Me contacter:</h2>";

								if($profil['contact_mail'] == true){ echo "<h4><b>Mail:</b> ".$account['mail']."</h4>"; }

								if($profil['contact_phone'] == true){ echo "<h4><b>Mon numéro:</b> ".$account['phone_number']."</h4>"; }

								if($profil['contact_discord'] == true){ echo "<h4><b>Mon discord:</b> ".$account['discord_user']."</h4>"; }
							}
							?>
							<br>
							<?php
								$mains = explode('$', $account['mains']);
								$formers_mains = explode('$', $account['formers_mains']);
								$secondarys = explode('$', $account['secondarys']);
							?>
							<h2>Mains (<?php echo (count($mains)-1); ?>):</h2>
							<div style="display: flex">
								<?php
								$get_characters = $bdd->query('SELECT * FROM characters');

								while ($gc = $get_characters->fetch())
								{
									if(in_array($gc['id'],$mains))
									{
									?>
										<div class="card" style="width: 10rem; margin-left: 5px;">
											<img class="card-img-top" src="img/characters/<?php echo $gc['icon']; ?>" alt="Card image cap">
											<div class="card-body">
												<h5 class="card-title" align="center">
													<?php
														echo $gc['name'];

													if($gc['dlc'] == 1)
													{
														echo " <img src='img/system/dlc.png' title='Personnage DLC' width='20px'>";
													}
													?>
												</h5>
											</div>
										</div>
									<?php
									}
								}
								?>
							</div>
							<br>
							<h2>Formers Mains (<?php echo (count($formers_mains)-1); ?>):</h2>
							<div style="display: flex">
								<?php
								$get_characters = $bdd->query('SELECT * FROM characters');

								while ($gc = $get_characters->fetch())
								{
									if(in_array($gc['id'],$formers_mains))
									{
									?>
										<div class="card" style="width: 10rem; margin-left: 5px;">
											<img class="card-img-top" src="img/characters/<?php echo $gc['icon']; ?>" alt="Card image cap">
											<div class="card-body">
												<h5 class="card-title" align="center">
													<?php
														echo $gc['name'];

													if($gc['dlc'] == 1)
													{
														echo " <img src='img/system/dlc.png' title='Personnage DLC' width='20px'>";
													}
													?>
												</h5>
											</div>
										</div>
									<?php
									}
								}
								?>
							</div>
							<br>
							<h2>Secondarys (<?php echo (count($secondarys)-1); ?>):</h2>
							<div style="display: flex">
								<?php
								$get_characters = $bdd->query('SELECT * FROM characters');

								while ($gc = $get_characters->fetch())
								{
									if(in_array($gc['id'],$secondarys))
									{
									?>
										<div class="card" style="width: 10rem; margin-left: 5px;">
											<img class="card-img-top" src="img/characters/<?php echo $gc['icon']; ?>" alt="Card image cap">
											<div class="card-body">
												<h5 class="card-title" align="center">
													<?php
														echo $gc['name'];

													if($gc['dlc'] == 1)
													{
														echo " <img src='img/system/dlc.png' title='Personnage DLC' width='20px'>";
													}
													?>
												</h5>
											</div>
										</div>
									<?php
									}
								}
								?>
							</div>
							<br>
							<h2>Mes réseaux:</h2>
							<?php
							$links = explode("§", $profil['links']);
							foreach ($links as $key => $val) {
								$link = explode("$",$val);

								if(!empty($link[1]))
								{
									switch ($link[0]) {
										case 'twitch':
											$link[2] = 'https://www.twitch.tv/';
											break;
										case 'twitter':
											$link[2] = 'https://twitter.com/';
											break;
										case 'youtube':
											$link[2] = 'https://www.youtube.com/channel/';
											break;
										case 'startgg':
											$link[2] = 'https://www.start.gg/user/';
											break;
										case 'steam':
											$link[2] = 'https://steamcommunity.com/profiles/';
											break;
									}
									
									echo '
									<div class="card" style="width: 100%;">
										<div class="card-body">
											<h5 class="card-title"><b>'.strtoupper($link[0]).':</b> <a href="'.$link[2].$link[1].'">Accéder au réseau ici.</a></h5>
										</div>
									</div>
									';
								}
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<!-- End Align Area -->
			<?php foot(); ?>
		</div>

		<!--::footer_part end::-->
		<!-- jquery plugins here-->
		<script src="js/jquery-1.12.1.min.js"></script>
		<!-- popper js -->
		<script src="js/popper.min.js"></script>
		<!-- bootstrap js -->
		<script src="js/bootstrap.min.js"></script>
		<!-- easing js -->
		<script src="js/jquery.magnific-popup.js"></script>
		<!-- swiper js -->
		<script src="js/swiper.min.js"></script>
		<!-- swiper js -->
		<script src="js/masonry.pkgd.js"></script>
		<!-- particles js -->
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/jquery.nice-select.min.js"></script>
		<!-- slick js -->
		<script src="js/slick.min.js"></script>
		<script src="js/jquery.counterup.min.js"></script>
		<script src="js/waypoints.min.js"></script>
		<script src="js/contact.js"></script>
		<script src="js/jquery.ajaxchimp.min.js"></script>
		<script src="js/jquery.form.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/mail-script.js"></script>
		<!-- custom js -->
		<script src="js/custom.js"></script>
	</body>
</html>
