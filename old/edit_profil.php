<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

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
										if($_GET['option'] == "1"){ echo "Gestion de l'avatar et de la bannière"; }
										elseif($_GET['option'] == "2"){ echo "Gestion des informations généraux"; }
										elseif($_GET['option'] == "4"){ echo "Gestion des informations confidentiels"; }
										elseif($_GET['option'] == "5"){ echo "Changer de mot de passe"; } 
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
						$message_avatar = "";
						$message_banner = "";
						if(isset($_POST['submit']))
						{
							if(isset($_FILES['avatar']) and !empty($_FILES['avatar']['name']))
							{
								var_dump($_FILES['avatar']);

								$taille = (get_perms($account['grade'], "vip.gif_avatar")) ? 20971520 : 2097152;
								$extensions = array('jpg','jpeg','png');
								if(get_perms($account['grade'], "vip.gif_avatar")){ $extensions[] = 'gif'; }

								if($_FILES['avatar']['size'] <= $taille)
								{
									$ext_upload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));
									if(in_array($ext_upload,$extensions))
									{
										$chemin = "./img/users/".$file_name = random(32).".".$ext_upload;
										$export = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);

										if($export)
										{
											$update_file = $bdd->prepare('UPDATE users SET avatar = ? WHERE id = ?');
											$update_file->execute(array($file_name, $account['id']));

											echo '<script type="text/javascript">
												window.location = "profil.php";
											</script>';
										}
										else
										{
											$message_avatar = "<br><h5 style='color: red;'>Une erreur est survenue lors de l'importation de votre photo de profil...</h5>";
										}
									}
									else
									{
										$message_avatar = "<br><h5 style='color: red;'>L'extension du fichier ne correspond pas à une extension autorisé.</h5>";
									}
								}
								else
								{
									$message_avatar = "<br><h5 style='color: red;'>L'image ou le fichier importé est trop volumineux.</h5>";
								}
							}
							if(isset($_FILES['banner']) and !empty($_FILES['banner']['name']))
							{
								var_dump($_FILES['banner']);

								$taille = (get_perms($account['grade'], "vip.gif_banner")) ? 50971520 : 15971520;
								$extensions = array('jpg','jpeg','png');
								if(get_perms($account['grade'], "vip.gif_banner")){ $extensions[] = 'gif'; }

								if($_FILES['banner']['size'] <= $taille)
								{
									$ext_upload = strtolower(substr(strrchr($_FILES['banner']['name'], '.'),1));
									if(in_array($ext_upload,$extensions))
									{
										$chemin = "./img/users/".$file_name = random(32).".".$ext_upload;
										$export = move_uploaded_file($_FILES['banner']['tmp_name'], $chemin);

										if($export)
										{
											$update_file = $bdd->prepare('UPDATE users SET banner = ? WHERE id = ?');
											$update_file->execute(array($file_name, $account['id']));

											echo '<script type="text/javascript">
												window.location = "profil.php";
											</script>';
										}
										else
										{
											$message_banner = "<br><h5 style='color: red;'>Une erreur est survenue lors de l'importation de votre photo de profil...</h5>";
										}
									}
									else
									{
										$message_banner = "<br><h5 style='color: red;'>L'extension du fichier ne correspond pas à une extension autorisé.</h5>";
									}
								}
								else
								{
									$message_banner = "<br><h5 style='color: red;'>L'image ou le fichier importé est trop volumineux.</h5>";
								}
							}
						}
						if(isset($_POST['cancel']))
						{
							echo '<script type="text/javascript">
								window.location = "profil.php";
							</script>';
						}
						?>
						<form method="POST" action="#" enctype="multipart/form-data">
							<div class="section-top-border">
								<center>
									<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-4" align="left">
											<h4>Avatar:</h4>
											<input class="form-control" type="file" name="avatar">
											<p>Format recommandé: <b>500px x 500px</b></p>
											<p>Extension accepté: <b>PNG, JPG, JPEG <?php if(get_perms($account['grade'], "vip.gif_avatar")){ echo ", GIF"; }?></b></p>
											<p>Taille maximum: <b><?php if(get_perms($account['grade'], "vip.gif_avatar")){ echo "20Mb"; }else{ echo "2Mb"; }?></b></p>
											<h4>Avatar actuelle:</h4>
											<img src="./img/users/<?php echo $account['avatar']; ?>" style="width: 163px;">
										</div>
										<div class="col-md-4" align="right">
											<h4>Bannière:</h4>
											<input class="form-control" type="file" name="banner">
											<p>Format recommandé: <b>1765px x 718px</b></p>
											<p>Extension accepté: <b>PNG, JPG, JPEG <?php if(get_perms($account['grade'], "vip.gif_banner")){ echo ", GIF"; }?></b></p>
											<p>Taille maximum: <b><?php if(get_perms($account['grade'], "vip.gif_avatar")){ echo "50Mb"; }else{ echo "15Mb"; }?></b></p>
											<h4>Bannière actuelle:</h4>
											<img src="./img/users/<?php echo $account['banner']; ?>">
										</div>
										<div class="col-md-2"></div>
									</div>
									<?php
										echo $message_avatar;
										echo $message_banner;
									?>
									<br>
									<button type="submit" name="submit" class="genric-btn primary e-large" style="font-size: 16px;">Enregistrer les modifications</button>
									<button type="submit" class="genric-btn danger e-large" style="font-size: 16px;" name="cancel">Annuler</button>
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
							$reseau = 'twitch$'.$_POST['twitch'].'§'.'twitter$'.$_POST['twitter'].'§'.'youtube$'.$_POST['youtube'].'§'.'startgg$'.$_POST['startgg'].'§'.'steam$'.$_POST['steam'];

							$mains = $formers_mains = $secondarys = "";

							foreach ($_POST['type'] as $key => $value) {
								if($value == 1)
								{
									$mains .= $key."$";
								}
								if($value == 2)
								{
									$formers_mains .= $key."$";
								}
								if($value == 3)
								{
									$secondarys .= $key."$";
								}
							}

							echo $_POST['title'];
							if(!empty($_POST['title']))
							{
								$update_user = $bdd->prepare('UPDATE users SET links=?, description=?, mains=?, formers_mains=?, secondarys=?, title_selected=? WHERE id = ?');
								$update_user->execute(array($reseau, nl2br($_POST['description']), $mains, $formers_mains, $secondarys, $_POST['title'], $account['id']));
							}
							else
							{
								$update_user = $bdd->prepare('UPDATE users SET links=?, description=?, mains=?, formers_mains=?, secondarys=? WHERE id = ?');
								$update_user->execute(array($reseau, nl2br($_POST['description']), $mains, $formers_mains, $secondarys, $account['id']));
							}

							echo '<script type="text/javascript">
								window.location = "profil.php";
							</script>';
						}
						if(isset($_POST['cancel']))
						{
							echo '<script type="text/javascript">
								window.location = "profil.php";
							</script>';
						}
						?>
						<div class="section-top-border">
							<center>
								<form method="POST" action="#">
									<div class="row">
										<div class="col-md-7" style="display: flex; align-items: center;"><?php echo $message; ?></div>
										<div class="col-md-2">
											<button type="submit" class="genric-btn success e-large" style="font-size: 16px;" name="submit">Enregistrer</button>
										</div>
										<div class="col-md-2">
											<button type="submit" class="genric-btn danger e-large" style="font-size: 16px;" name="cancel">Annuler</button>
										</div>
										<div class="col-md-1"></div>
									</div>
									<div class="mt-10" style="margin-bottom: 20px;">
										<h4>Description de l'utilisateur:</h4>
										<textarea placeholder="Entrez une description" class="form-control" name="description" rows="5" style="resize: none;"><?php echo str_replace("<br />", "&#13;", $account['description']); ?></textarea>
									</div>
									<?php
									if(!empty($account['titles']))
									{
									?>
									<div class="mt-10" style="margin-bottom: 20px;">
										<h4>Quel titre voulez-vous afficher ?</h4>
										<select name="title">
											<option <?php if(empty($account['title_selected'])){ echo 'selected'; } ?> value="0">Ne pas afficher de titre.</option>
											<?php
											$titles = explode('$', $account['titles']);

											foreach ($titles as $key => $value) {
												echo "e";
												$get_title = $bdd->prepare('SELECT * FROM titles WHERE id = ?');
												$get_title->execute(array($value));
												$get_title = $get_title->fetch();

												if(!empty($account['title_selected']) && $account['title_selected'] == $get_title['id'])
												{
													echo '<option selected="" value="'.$get_title['id'].'">'.$get_title['nom'].'</option>';
												}
												else
												{
													echo '<option  value="'.$get_title['id'].'">'.$get_title['nom'].'</option>';
												}
											}
											?>
										</select>
									</div>
									<?php
									}
									?>
									<div class="mt-10" style="margin-bottom: 20px;">
										<h4>Vos réseaux sociaux:</h4>
										<?php
										$links = explode("§", $account['links']);
										?>
										<table class="table table-hover">
											<tbody>
												<tr>
													<th scope="row" style="vertical-align: middle; width: 15%;">
														<svg width="40" height="40" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M18 12L12 24V72H27V81H39L48 72H60L78 54V12H18ZM24 18H72V51L63 60H45L36 69V60H24V18ZM39 27V48H45V27H39ZM51 27V48H57V27H51Z" fill="black"/>
														</svg>
														Twitch
													</th>
													<td style="vertical-align: middle;">
														<input type="text" name="twitch" placeholder="Identifiant (Example: mathis150)"
														onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
														value="<?php $l = explode("$", $links[0]); if(!empty($l[1])){echo $l[1];} ?>" class="single-input">
														(De: https://www.twitch.tv/<b>mathis150</b>)
													</td>
												</tr>
												<tr>
													<th scope="row" style="vertical-align: middle;">
														<svg width="40" height="40" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M84 20.8125C81.1289 22.0859 78.0469 22.9453 74.8086 23.332C78.1133 21.3516 80.6484 18.2148 81.8438 14.4766C78.7539 16.3125 75.3281 17.6445 71.6797 18.3633C68.7617 15.2539 64.6016 13.3086 60 13.3086C51.1602 13.3086 43.9961 20.4766 43.9961 29.3086C43.9961 30.5625 44.1406 31.7891 44.4102 32.9531C31.1133 32.2891 19.3242 25.918 11.4258 16.2344C10.0547 18.5977 9.26562 21.3438 9.26562 24.2812C9.26562 29.832 12.0859 34.7305 16.3789 37.5977C13.7578 37.5156 11.2891 36.7969 9.13281 35.5977C9.13281 35.668 9.13281 35.7305 9.13281 35.8008C9.13281 43.5547 14.6445 50.0234 21.9688 51.4883C20.6289 51.8555 19.2109 52.0508 17.75 52.0508C16.7227 52.0508 15.7187 51.9492 14.7422 51.7656C16.7773 58.1211 22.6875 62.75 29.6914 62.8789C24.2148 67.1719 17.3164 69.7305 9.81641 69.7305C8.52734 69.7305 7.25 69.6563 5.99609 69.5078C13.0781 74.0469 21.4883 76.6953 30.5273 76.6953C59.9648 76.6953 76.0547 52.3125 76.0547 31.1641C76.0547 30.4727 76.0391 29.7812 76.0117 29.0938C79.1406 26.8359 81.8555 24.0195 84 20.8125Z" fill="black"/>
														</svg>
														Twitter
													</th>
													<td style="vertical-align: middle;">
														<input type="text" name="twitter" placeholder="Identifiant (Example: mathis150_user)"
														onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
														value="<?php $l = explode("$", $links[1]); if(!empty($l[1])){echo $l[1];} ?>" class="single-input">
														(De: https://twitter.com/<b>mathis150_user</b>)
													</td>
												</tr>
												<tr>
													<th scope="row" style="vertical-align: middle;">
														<svg width="40" height="40" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M45 12C32.442 12 16.1426 15.1465 16.1426 15.1465L16.1016 15.1934C10.382 16.1081 6 21.0229 6 27V45V45.0059V63V63.0059C6.00558 65.8605 7.02861 68.6196 8.88539 70.7878C10.7422 72.956 13.3111 74.3913 16.1309 74.8359L16.1426 74.8535C16.1426 74.8535 32.442 78.0059 45 78.0059C57.558 78.0059 73.8574 74.8535 73.8574 74.8535L73.8633 74.8477C76.6861 74.404 79.258 72.9675 81.1162 70.7968C82.9744 68.626 83.997 65.8633 84 63.0059V63V45.0059V45V27C83.9958 24.1444 82.9734 21.3839 81.1165 19.2144C79.2596 17.045 76.6899 15.6089 73.8691 15.1641L73.8574 15.1465C73.8574 15.1465 57.558 12 45 12ZM36 31.1953L60 45L36 58.8047V31.1953Z" fill="black"/>
														</svg>
														YouTube
													</th>
													<td style="vertical-align: middle;">
														<input type="text" name="youtube" placeholder="Code d'identification (Example: UCxLFIYeNiTb2A7Tj3fKkiaA)"
														onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
														value="<?php $l = explode("$", $links[2]); if(!empty($l[1])){echo $l[1];} ?>" class="single-input">
														(De: https://www.youtube.com/channel/<b>UCxLFIYeNiTb2A7Tj3fKkiaA</b>)
													</td>
												</tr>
												<tr>
													<th scope="row" style="vertical-align: middle;">
														<svg width="40" height="40" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M14.82 45.12H26.86C27.96 45.12 28.86 44.22 28.86 43.12V31.08C28.86 29.98 29.76 29.08 30.86 29.08H75.0201C76.1201 29.08 77.0201 28.18 77.0201 27.08V15C77.0201 13.9 76.1201 13 75.0201 13H28.86C20 13 12.8 20.18 12.8 29.06V43.1C12.8 44.22 13.7 45.12 14.82 45.12Z" fill="black"/>
															<path d="M75.0199 45.1199H62.9799C61.8799 45.1199 60.9799 46.0199 60.9799 47.1199V59.1599C60.9799 60.2599 60.0799 61.1599 58.9799 61.1599H14.8199C13.7199 61.1599 12.8199 62.0599 12.8199 63.1599V75.1999C12.8199 76.2999 13.7199 77.1999 14.8199 77.1999H60.9799C69.8399 77.1999 77.0399 70.0199 77.0399 61.1399V47.0999C77.0399 46.0199 76.1399 45.1199 75.0199 45.1199Z" fill="black"/>
														</svg>
														Start.GG
													</th>
													<td style="vertical-align: middle;">
														<input type="text" name="startgg" placeholder="Code d'identification (Example: dfad90f2)"
														onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
														value="<?php $l = explode("$", $links[3]); if(!empty($l[1])){echo $l[1];} ?>" class="single-input">
														(De: https://www.start.gg/user/<b>dfad90f2</b>)
													</td>
												</tr>
												<tr>
													<th scope="row" style="vertical-align: middle;">
														<svg width="40" height="40" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
															<path d="M18 12C14.685 12 12 14.685 12 18V51.9785L19.6055 54.0527C21.3905 50.9657 24.5027 48.7426 28.1777 48.1816L36.1992 38.5547C36.0822 37.7177 36 36.87 36 36C36 26.058 44.058 18 54 18C63.942 18 72 26.058 72 36C72 45.942 63.942 54 54 54C53.13 54 52.2823 53.9178 51.4453 53.8008L41.8184 61.8223C40.9364 67.5793 36.003 72 30 72C23.373 72 18 66.627 18 60C18 59.946 18.0176 59.8958 18.0176 59.8418L12 58.2012V72C12 75.315 14.685 78 18 78H72C75.315 78 78 75.315 78 72V18C78 14.685 75.315 12 72 12H18ZM54 24C47.4081 24 42 29.4081 42 36C42 42.5919 47.4081 48 54 48C60.5919 48 66 42.5919 66 36C66 29.4081 60.5919 24 54 24ZM54 30C57.3492 30 60 32.6508 60 36C60 39.3492 57.3492 42 54 42C50.6508 42 48 39.3492 48 36C48 32.6508 50.6508 30 54 30ZM30 52.5C27.645 52.5 25.5674 53.6056 24.1934 55.3066L30.791 57.1055C32.39 57.5435 33.3354 59.192 32.9004 60.791C32.5314 62.123 31.32 63 30 63C29.739 63 29.476 62.9665 29.209 62.8945L22.6055 61.0957C23.1425 64.7137 26.232 67.5 30 67.5C34.143 67.5 37.5 64.143 37.5 60C37.5 55.857 34.143 52.5 30 52.5Z" fill="black"/>
														</svg>
														Steam
													</th>
													<td style="vertical-align: middle;">
														<input type="text" name="steam" placeholder="Code utilisateur (Example: 76561198286876109)"
														onfocus="this.placeholder = ''" onblur="this.placeholder = ''"
														value="<?php $l = explode("$", $links[4]); if(!empty($l[1])){echo $l[1];} ?>" class="single-input">
														(De: https://steamcommunity.com/profiles/<b>76561198286876109</b>)
													</td>
												</tr>
											</tbody>
										</table>
									</div>
									<div class="mt-10" style="margin-bottom: 20px;">
										<h4>Sélectionner un personnage:</h4>
										<table class="table table-hover">
											<tbody>
												<?php
												$get_characters = $bdd->query('SELECT * FROM characters');

												$mains = explode('$', $account['mains']);
												$formers_mains = explode('$', $account['formers_mains']);
												$secondarys = explode('$', $account['secondarys']);

												while ($gc = $get_characters->fetch()) {
												?>
													<tr>
														<td style="width: 80px;">
															<img class="card-img-top" src="img/characters/<?php echo $gc['icon']; ?>" style="width: 64px;">
														</td>
														<th scope="row" style="vertical-align: middle;">
															<?php
																echo $gc['name'];

																if($gc['dlc'] == 1)
																{
																	echo " <img src='img/system/dlc.png' title='Personnage DLC' width='20px'>";
																}
															?>
														</th>
														<td style="vertical-align: middle;">
															<div class="form-select" id="citys">
																<select name="type[<?php echo $gc['id']; ?>]">
																	<?php
																	if(!in_array($gc['id'],$mains) and !in_array($gc['id'],$formers_mains) and !in_array($gc['id'],$secondarys))
																	{
																		echo '<option value="0" selected>Non utilisé</option>';
																	}
																	else
																	{
																		echo '<option value="0">Non utilisé</option>';
																	}

																	if(in_array($gc['id'],$mains))
																	{
																		echo '<option value="1" selected>Main</option>';
																	}
																	else
																	{
																		echo '<option value="1">Main</option>';
																	}

																	if(in_array($gc['id'],$formers_mains))
																	{
																		echo '<option value="2" selected>Former Main</option>';
																	}
																	else
																	{
																		echo '<option value="2">Former Main</option>';
																	}

																	if(in_array($gc['id'],$secondarys))
																	{
																		echo '<option value="3" selected>Secondaire</option>';
																	}
																	else
																	{
																		echo '<option value="3">Secondaire</option>';
																	}
																	?>
																</select>
															</div>
														</td>
													</tr>
												<?php
												}
												?>
											</tbody>
										</table>
									</div>
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
					elseif($_GET['option'] == 4)
					{
						$message = "";
						if(isset($_POST['submit']))
						{
							var_dump($_POST);
							$mail_check = (!empty($_POST['mail'])) ? 1 : 0;
							$phone_check = (!empty($_POST['phone_number']) && !empty($_POST['phone'])) ? 1 : 0;
							$discord_check = (!empty($_POST['discord_id']) && !empty($_POST['discord'])) ? 1 : 0;
							$get_data_check = (!empty($_POST['get_data'])) ? 1 : 0;
							$use_image_check = (!empty($_POST['use_image'])) ? 1 : 0;
							$tournaments_register_check = (!empty($_POST['tournaments_register'])) ? 1 : 0;
							$tournaments_played_check = (!empty($_POST['tournaments_played'])) ? 1 : 0;

							$phone_number = (!empty($_POST['phone_number']) && !empty($_POST['phone'])) ? $_POST['phone_number'] : '';
							$discord_id = (!empty($_POST['discord_id']) && !empty($_POST['discord'])) ? $_POST['discord_id'] : '';

							$update_information = $bdd->prepare('UPDATE users SET contact_mail = ?, phone_number = ?, contact_phone = ?, discord_user = ?, contact_discord = ?, get_data = ?, use_image = ?, tournaments_register = ?, tournaments_played = ? WHERE id = ?');
							$update_information->execute(array($mail_check, $phone_number, $phone_check, $discord_id, $discord_check, $get_data_check, $use_image_check, $tournaments_register_check, $tournaments_played_check, $account['id']));

							echo '<script type="text/javascript">
								window.location = "profil.php";
							</script>';
						}

						if(isset($_POST['cancel']))
						{
							echo '<script type="text/javascript">
								window.location = "profil.php";
							</script>';
						}
						?>
							<div class="section-top-border">
								<center>
									<form method="POST" action="#">
										<div class="row">
											<div class="col-md-7" style="display: flex; align-items: center;"><?php echo $message; ?></div>
											<div class="col-md-2">
												<button type="submit" class="genric-btn success e-large" style="font-size: 16px;" name="submit">Enregistrer</button>
											</div>
											<div class="col-md-2">
												<button type="submit" class="genric-btn danger e-large" style="font-size: 16px;" name="cancel">Annuler</button>
											</div>
											<div class="col-md-1"></div>
										</div>
										<table class="table table-hover" style="margin-top: 30px; width: 100%;">
											<tbody>
												<tr>
													<th scope="row">1.</th>
													<td colspan="2">
														Acceptez-vous de mettre en avant votre adresse e-mail au près de la communauté du Site Web ?<br>
														<cite>Cela permettrais aux différentes personnes souhaitant vous contacter de le faire par se moyen.</cite>
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="mail" style="width:100%" <?php if($account['contact_mail']){ echo 'checked=""'; }?>>
													</td>
												</tr>
												<tr>
													<th scope="row">2.</th>
													<td>
														Acceptez-vous de mettre en avant votre numéro de téléphone au près de la communauté du Site Web ?<br>
														<cite>Cela permettrais aux différentes personnes souhaitant vous contacter de le faire par se moyen.</cite>
													</td>
													<td width="400px">
														<input type="text" name="phone_number" placeholder="Numéro de téléphone de contact" class="single-input" value="<?php echo $account['phone_number']; ?>">
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="phone" style="width:100%" <?php if($account['contact_phone']){ echo 'checked=""'; }?>>
													</td>
												</tr>
												<tr>
													<th scope="row">3.</th>
													<td>
														Acceptez-vous de mettre en avant votre nom d'utilisateur discord au près de la communauté du Site Web ?<br>
														<cite>Cela permettrais aux différentes personnes souhaitant vous contacter de le faire par se moyen.</cite>
													</td>
													<td width="400px">
														<input type="text" name="discord_id" placeholder="example#0000" class="single-input" value="<?php echo $account['discord_user']; ?>">
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="discord" style="width:100%" <?php if($account['contact_discord']){ echo 'checked=""'; }?>>
													</td>
												</tr>
												<tr>
													<th scope="row">4.</th>
													<td colspan="2">
														Acceptez-vous que nous récoltions les données que vous entré sur ce site et sur smash.gg pour vous proposez des services personnalisés ?<br>
														<cite>Nous entendons par services personnalisés, information sur de futur tournois, résultat de tournois, replay de tournois, etc.</cite><br>
														<b>/!\ Ce service n'est encore que en ALPHA.</b>
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="get_data" style="width:100%;" <?php if($account['get_data']){ echo 'checked=""'; }?>>
													</td>
												</tr>
												<tr>
													<th scope="row">5.</th>
													<td colspan="2">
														Nous autorisez-vous à utiliser votre image à des buts de communications ?<br>
														<cite>Mise en avant de l'ASR seulement, par vos victoire, votre classement etc.<br>
														Votre image ne sera jamais utiliser à des fins commercial.</cite>
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="use_image" style="width:100%;" <?php if($account['use_image']){ echo 'checked=""'; }?>>
													</td>
												</tr>
												<tr>
													<th scope="row">6.</th>
													<td colspan="2">
														Souhaitez-vous affichez les tournois où vous vous êtes inscrits ?<br>
														<cite>Mise en avant de l'ASR seulement, par vos victoire, votre classement etc.<br>
														Votre image ne sera jamais utiliser à des fins commercial.</cite>
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="tournaments_register" style="width:100%;" <?php if($account['tournaments_register']){ echo 'checked=""'; }?>>
													</td>
												</tr>
												<tr>
													<th scope="row">7.</th>
													<td colspan="2">
														Souhaitez-vous affichez les tournois ou vous avez participés ?<br>
														<cite>Mise en avant de l'ASR seulement, par vos victoire, votre classement etc.<br>
														Votre image ne sera jamais utiliser à des fins commercial.</cite>
													</td>
													<td>
														<input type="checkbox" id="default-switch" name="tournaments_played" style="width:100%;" <?php if($account['tournaments_played']){ echo 'checked=""'; }?>>
													</td>
												</tr>
											</tbody>
										</table>
									</form>
								</center>
							</div>
						<?php
					}
					elseif($_GET['option'] == 5)
					{
						$message = "";
						if(isset($_POST['submit']))
						{
							if(!empty($_POST['amdp1']) and !empty($_POST['nmdp1']) and !empty($_POST['nmdp2']))
							{
								$verif_password = $bdd->prepare('SELECT id FROM users WHERE mail = ? AND password = ?');
								$verif_password->execute(array($account['mail'], sha1($_POST['amdp1'])));
								$verif_password = $verif_password->rowCount();

								if($verif_password == 1)
								{
									if($_POST['nmdp1'] == $_POST['nmdp2'])
									{
										$update_password = $bdd->prepare('UPDATE users SET password = ? WHERE password = ? AND mail = ?');
										$update_password->execute(array(sha1($_POST['nmdp1']),sha1($_POST['amdp1']),$account['mail']));
										echo '<script type="text/javascript">
											window.location = "profil.php";
										</script>';
									}
									else
									{
										$message = "<h5 style='color: red'>Les champs du nouveaux mot de passe sont différent.</h5>";
									}
								}
								else
								{
									$message = "<h5 style='color: red'>Votre mot de pass est incorrect.</h5>";
								}
							}
							else
							{
								$message = "<h5 style='color: red'>Merci de remplir les champs.</h5>";
							}
						}

						if(isset($_POST['cancel']))
						{
							echo '<script type="text/javascript">
								window.location = "profil.php";
							</script>';
						}
						?>
							<div class="section-top-border">
								<center>
									<form method="POST" action="#">
										<div class="row">
											<div class="col-md-7" style="display: flex; align-items: center;"><?php echo $message; ?></div>
											<div class="col-md-2">
												<button type="submit" class="genric-btn success e-large" style="font-size: 16px;" name="submit">Enregistrer</button>
											</div>
											<div class="col-md-2">
												<button type="submit" class="genric-btn danger e-large" style="font-size: 16px;" name="cancel">Annuler</button>
											</div>
											<div class="col-md-1"></div>
										</div>

										<div class="mt-10" style="margin-bottom: 20px;">
											<h4>Mot de passe actuelle:</h4>
											<input type="password" name="amdp1" placeholder="..." class="single-input">
										</div>

										<div class="mt-10" style="margin-bottom: 20px;">
											<h4>Nouveau mot de passe:</h4>
											<input type="password" name="nmdp1" placeholder="..." class="single-input">
										</div>

										<div class="mt-10" style="margin-bottom: 20px;">
											<h4>Répétez le:</h4>
											<input type="password" name="nmdp2" placeholder="..." class="single-input">
										</div>
									</form>
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