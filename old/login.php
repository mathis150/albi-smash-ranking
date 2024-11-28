<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	if(isset($_GET['option']) and $_GET['option'] == 4)
	{
		session_start();
		if(!empty($_COOKIE['mail']) and !empty($_COOKIE['password']))
		{
			unset($_COOKIE["password"]); 
    		setcookie("password", null, -1, '/'); 
			unset($_COOKIE["mail"]); 
    		setcookie("mail", null, -1, '/'); 
			echo '#1';
		}
		unset($_SESSION['account']);

		echo '<script type="text/javascript">
			window.location = "index.php";
		</script>';
	}
	else
	{
		include "./import/header.php";

		?>
			<!doctype html>
			<html lang="fr">

			<?php pre_header("ASR"); ?>

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
										<h2>
											<?php
												if(!isset($_GET['option']) or $_GET['option'] == "1"){ echo "Connexion"; }
												elseif($_GET['option'] == "2"){ echo "Inscription"; }
												elseif($_GET['option'] == "3"){ echo "Validation du compte"; } 
											?> 
										</h2>
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
						<div class="container box_1170">
							<?php
							if(!isset($_GET['option']) or $_GET['option'] == 1)
							{
								$message = "";
								$mail = "";
								$pw = "";
								if(isset($_POST['submit']))
								{
									if(!empty($_POST['mail']) and !empty($_POST['password']))
									{
										$mail = $_POST['mail'];
										$pw = $_POST['password'];
										$mdp = sha1($_POST['password']);

										$verif_user = $bdd->prepare('SELECT id FROM users WHERE mail = ? AND password = ?');
										$verif_user->execute(array($_POST['mail'], $mdp));
										$verif_user = $verif_user->rowCount();

										if($verif_user == 1)
										{
											$verif_user = $bdd->prepare('SELECT * FROM users WHERE mail = ? AND password = ?');
											$verif_user->execute(array($_POST['mail'], $mdp));
											$verif_user = $verif_user->fetch();

											if(!empty($verif_user['valided']))
											{
												if(isset($_POST['login']))
												{
													echo '<script type="text/javascript">
														function setCookie(cname, cvalue, exdays) {
															const d = new Date();
															d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
															let expires = "expires="+d.toUTCString();
															document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
														}

														setCookie("mail", "'.$_POST['mail'].'", 60*60*24*30);
														setCookie("password", "'.$mdp.'", 60*60*24*30);
													</script>';
													$_SESSION["account"] = $verif_user['code_key'];
												}
												else
												{
													$_SESSION["account"] = $verif_user['code_key'];
												}
												
												echo '<script type="text/javascript">
													window.location = "index.php";
												</script>';
											}
											else
											{
												$message = "<br><h5 style='color: red;'>Le compte n'est pas validé.</h5>";
											}
										}
										else
										{
											$message = "<br><h5 style='color: red;'>Le mail ou le mot de passe est incorrecte.</h5>";
										}
									}
									else
									{
										$message = "<br><h5 style='color: red;'>Merci de compléter les champs demandé.</h5>";
									}
								}
								?>
								<form method="POST" action="#">
									<div class="section-top-border">
										<center>
											<div class="mt-10" style="margin-bottom: 20px; width: 40%;">
												<h4>Adresse E-Mail:</h4>
												<input type="email" name="mail" placeholder="Adresse E-Mail"
													onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required
													class="single-input" value="<?php echo $mail; ?>">
											</div>
											<div class="mt-10" style="margin-bottom: 20px; width: 40%;">
												<h4>Mot de passe:</h4>
												<input type="password" name="password" placeholder="Mot de passe"
													onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required
													class="single-input" value="<?php echo $pw; ?>">
											</div>
											<div class="row">
												<div class="col-md-2"></div>
												<div class="col-md-4" align="left">
													<div class="switch-wrap d-flex">
														<div class="primary-switch">
															<input type="checkbox" id="default-switch" name="login">
															<label for="default-switch"></label>
														</div>
														<h5 style="margin-left: 10px;">Rester connecté.</h5>
													</div>
												</div>
												<div class="col-md-4" align="right">
													Pas de compte ? <a href="login.php?option=2"><u>Incrivez-vous maintenant !</u></a>
												</div>
												<div class="col-md-2"></div>
											</div>
											<?php
												echo $message;
												if(isset($_GET['message_valid'])){ echo "<br><h5 style='color: green;'>".$_GET['message_valid']."</h5>"; }
											?>
											<br>
											<button type="submit" name="submit" class="genric-btn primary e-large" style="font-size: 16px;">Se connecter !</a>
										</center>
									</div>
								</form>
								<?php
							}
							elseif($_GET['option'] == 2)
							{
								$message = "";
								if(isset($_POST['submit']))
								{
									if(!empty($_POST["pseudo"]) and !empty($_POST["mail"]) and !empty($_POST["password"]) and !empty($_POST["password_confirm"]))
									{
										if($_POST["password"] == $_POST["password_confirm"])
										{
											$verif_user = $bdd->prepare('SELECT id FROM users WHERE pseudo = ? OR mail = ?');
											$verif_user->execute(array($_POST["pseudo"], $_POST["mail"]));

											$verif_user = $verif_user->rowCount();

											if($verif_user != 1)
											{
												$code = random(32);
												$mdp = sha1($_POST["password"]);

												$insert_user = $bdd->prepare('INSERT INTO users (pseudo, mail, password, city, country, code_key) VALUES (?, ?, ?, ?, ?, ?)');
												$insert_user->execute(array($_POST["pseudo"], $_POST["mail"], $mdp, $_POST["citys"], $_POST["country"], $code));
												
												echo '<script type="text/javascript">
													window.location = "login.php?message_valid=Un mail viens de vous être envoyé, il est nécessaire de valider se dernier.";
												</script>';
											}
											else
											{
												$message = "<br><h5 style='color: red;'>Cette utilisateur existe déjà.</h5>";
											}
										}
										else
										{
											$message = "<br><h5 style='color: red;'>Le mot de passe de confirmation ne correspond pas.</h5>";
										}
									}
									else
									{
										$message = "<br><h5 style='color: red;'>Merci de compléter les champs demandé.</h5>";
									}
								}
								?>
								<div class="section-top-border">
									<center>
										<form method="POST" action="#">
											<div class="mt-10" style="margin-bottom: 20px; width: 40%;">
												<h4>Pseudo:</h4>
												<input type="text" name="pseudo" placeholder="Pseudonyme"
													onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required
													class="single-input">
											</div>
											<div class="mt-10" style="margin-bottom: 20px; width: 40%;">
												<h4>Adresse E-Mail:</h4>
												<input type="email" name="mail" placeholder="Adresse E-Mail"
													onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required
													class="single-input">
											</div>
											<div class="mt-10" style="margin-bottom: 20px; width: 40%;">
												<h4>Mot de passe:</h4>
												<input type="password" name="password" placeholder="Mot de passe"
													onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required
													class="single-input">
											</div>
											<div class="mt-10" style="margin-bottom: 20px; width: 40%;">
												<h4>Confirmer votre mot de passe:</h4>
												<input type="password" name="password_confirm" placeholder="Mot de passe"
													onfocus="this.placeholder = ''" onblur="this.placeholder = ''" required
												class="single-input">
											<div>
											<br>
											<br>
											<h4>Si vous êtes de France, quel est votre ville ?</h4>
											<div class="input-group-icon mt-10">
												<div class="icon"><i class="fa fa-plane" aria-hidden="true"></i></div>
												<div class="form-select" id="citys">
													<select name="citys">
														<?php
														$get_citys = $bdd->query('SELECT * FROM citys ORDER BY name ASC');

														while ($c = $get_citys->fetch()) {
															if($c['local'])
															{
																echo '<option value="'.$c['id'].'" selected>'.$c['name'].'</option>';
															}
															else
															{
																echo '<option value="'.$c['id'].'">'.$c['name'].'</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
											<h4>Si vous êtes extérieur à la France, quel est votre pays ?</h4>
											<div class="input-group-icon mt-10">
												<div class="icon"><i class="fa fa-globe" aria-hidden="true"></i></div>
												<div class="form-select" id="country">
													<select name="country">
														<?php
														$get_citys = $bdd->query('SELECT * FROM country ORDER BY name ASC');

														while ($c = $get_citys->fetch()) {
															if($c['local'])
															{
																echo '<option value="'.$c['id'].'" selected>'.$c['name'].'</option>';
															}
															else
															{
																echo '<option value="'.$c['id'].'">'.$c['name'].'</option>';
															}
														}
														?>
													</select>
												</div>
											</div>
											<br>
											<h5>Déjà un compte ? <a href="login.php?option=1"><u>Connectez-vous maintenant !</u></a></h5>
											<?php echo $message; ?>
											<br>
											<button type="submit" class="genric-btn primary e-large" style="font-size: 16px;" name="submit">S'inscrire !</a>
										</form>
									</center>
								</div>
								<?php
							}
							elseif($_GET['option'] == 3 AND isset($_GET['code']))
							{
								$update_user = $bdd->prepare('UPDATE users SET valided=? WHERE code_key = ?');
								$update_user->execute(array(true, $_GET['code']));
								?>
								<div class="section-top-border">
									<center>
										<h4>Validation de la création de votre compte...</h4>
										<p style="font-size: 16px;">
											Nous vous remercions de vous être inscrit sur le site, Albi Smash Ranking !<br>
											Sachez que nous sommes à l'écoute de vos demandes et que nous restons donc à votre disposition à tout moment !<br>
											<br>
											Vous pouvez donc nous contacter à l'email suivant: <b>contact@asr.mathis-lenoir.net</b><br>
											(Pour toute les <b>raisons cité ci-après:</b> Bug, Demande d'ajout de contenue, Échange commercial, Réclamation)<br>
											<br>
											Nous vous souhaitons donc bonne continuation et navigation sur notre site web !<br>
											<br>
											<b>L'équipe Albi Smash Ranking.</b><br><br>
										</p>
										<a href="login.php?option=1&message_valid=Votre mail à bien était validé ! Vous pouvez désormer vous connectez !" class="genric-btn primary e-large" style="font-size: 16px;">Allez à la page de connexion</a>
									</center>
								</div>
								<?php
							}
							?>
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
		<?php
	}
?>
