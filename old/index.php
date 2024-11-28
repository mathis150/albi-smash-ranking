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
    <div class="body_bg">
        <?php head($options,$account); ?>

        <!-- banner part start-->
        <section class="banner_part">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6 col-md-8">
                        <div class="banner_text">
                            <div class="banner_text_iner">
                                <h1>Albi Smash Ranking</h1>
                                <p>Le site de la communaut&#xE9; Smash Bros d'Albi vous permettant de savoir tout les &#xE9;v&#xE8;nement pr&#xE9;sent dans la ville !</p>
                                <a href="#" class="btn_1">Calendrier</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- banner part start-->

        <!--::client logo part end::-->
        <section class="client_logo">
            <h2 style="text-align: center;">Partenaires</h2>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="client_logo_slider owl-carousel d-flex justify-content-between">
                            <div class="single_client_logo">
                                <img src="img/client_logo/mathis-lenoir-fr.png" alt="Mathis-Lenoir.fr - D&#xE9;veloppement du site">
                            </div>
                            <div class="single_client_logo">
                                <img src="img/client_logo/albi-smash-story.png" alt="Albi Smash Story">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::client logo part end::-->

        <!-- about_us part start-->
        <section class="about_us section_padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-5 col-lg-6 col-xl-6">
                        <div class="learning_img">
                            <img src="img/about_img.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6 col-xl-5">
                        <div class="about_us_text">
                            <h2>Prennez connaissance du classement !</h2>
                            <p>Observez vos progr&#xE9;s dans le classement ou donnez vous un objectif en fonction de celui-ci !
                                <br><br>
                                Le classement est mise &#xE0; jour en fonction des r&#xE9;sultats en tournois et des joueurs vaincus.
                            </p>
                            <a href="#" class="btn_1">Ranking Albi</a>
                            <a href="#" class="btn_1">Ranking G&#xE9;n&#xE9;ral</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about_us part end-->

        <!--::about_us part start::-->
        <section class="live_stareams padding_bottom">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-between">
                    <div class="col-md-2 offset-lg-2 offset-sm-1">
                        <h2>Tournois <br> en cours</h2>
                        <div class="btn_1">Voir les tournois</div>
                    </div>
                    <div class="col-md-7 offset-sm-1">
                        <div class="live_stareams_slide owl-carousel">
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_1.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_2.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_1.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_2.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_1.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_2.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_1.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                            <div class="live_stareams_slide_img">
                                <img src="img/live_streams_2.png" alt="">
                                <div class="extends_video">
                                    <a id="play-video_1" class="video-play-button popup-youtube"
                                        href="https://www.youtube.com/watch?v=pBFQdxA-apI">
                                        <span class="fas fa-play"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--::about_us part end::-->

        <!-- use sasu part end-->
        <section class="Latest_War">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section_tittle text-center">
                            <h2>Le plus gros tournois en cours &#xE0; Albi</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-12">
                        <div class="Latest_War_text">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-lg-6">
                                    <div class="single_war_text text-center">
                                        <img src="img/favicon.png" style="width: 70px" alt="">
                                        <h4>Nom du tournois</h4>
                                        <p>Lundi 01 Juin 2022, 20h00</p>
                                        <a href="#">Acc&#xE9;der &#xE0; la fiche du tournois</a>
                                        <div class="war_text_item d-flex justify-content-around align-items-center">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/6/60/Logo_Solary.png" style="width: 122px" alt="">
                                            <h2>Glutonny<br><span>vs</span><br>MkLeo</h2>
                                            <img src="https://upload.wikimedia.org/wikipedia/fr/thumb/f/f9/T1_logo.svg/1200px-T1_logo.svg.png" style="width: 122px" alt="">
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn_2">Acc&#xE9;der &#xE0; la fiche du tournois</a>
                        </div>
                    </div>
                    <div class="row justify-content-center" style="margin-top: 20px;">
                        <div class="col-lg-8">
                            <div class="section_tittle text-center">
                                <h2>Les derniers tournois effectu&#xE9;s &#xE0; Albi</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="latest_war_list">
                            <div class="single_war_text">
                                <div class="war_text_item d-flex justify-content-around align-items-center">
                                    <img src="img/war_logo_1.png" alt="">
                                    <h2>190<span>vs</span>189</h2>
                                    <img src="img/war_logo_2.png" alt="">
                                    <div class="war_date">
                                        <a href="#">27 june 2020</a>
                                        <p>Open War chalange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single_war_text">
                                <div class="war_text_item d-flex justify-content-around align-items-center">
                                    <img src="img/war_logo_1.png" alt="">
                                    <h2>190<span>vs</span>189</h2>
                                    <img src="img/war_logo_2.png" alt="">
                                    <div class="war_date">
                                        <a href="#">27 june 2020</a>
                                        <p>Open War chalange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single_war_text">
                                <div class="war_text_item d-flex justify-content-around align-items-center">
                                    <img src="img/war_logo_1.png" alt="">
                                    <h2>190<span>vs</span>189</h2>
                                    <img src="img/war_logo_2.png" alt="">
                                    <div class="war_date">
                                        <a href="#">27 june 2020</a>
                                        <p>Open War chalange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single_war_text">
                                <div class="war_text_item d-flex justify-content-around align-items-center">
                                    <img src="img/war_logo_1.png" alt="">
                                    <h2>190<span>vs</span>189</h2>
                                    <img src="img/war_logo_2.png" alt="">
                                    <div class="war_date">
                                        <a href="#">27 june 2020</a>
                                        <p>Open War chalange</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="Latest_War_text Latest_War_bg_1">
                            <div class="row justify-content-center align-items-center h-100">
                                <div class="col-lg-6">
                                    <div class="single_war_text text-center">
                                        <img src="img/favicon.png" style="width: 70px" alt="">
                                        <h4>Open War chalange</h4>
                                        <p>27 june , 2020</p>
                                        <a href="#">view fight</a>
                                        <div class="war_text_item d-flex justify-content-around align-items-center">
                                            <img src="img/war_logo_1.png" alt="">
                                            <h2>190<span>vs</span>189</h2>
                                            <img src="img/war_logo_2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn_2">Voir le dernier tournois qui a eu lieu</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- use sasu part end-->

        <!-- use sasu part end-->
        <!--<section class="upcomming_war">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section_tittle text-center">
                            <h2>Actualité Smash Bros</h2>
                        </div>
                    </div>
                </div>
                <div class="upcomming_war_iner">
                    <div class="row justify-content-center align-items-center h-100">
                        <div class="col-10 col-sm-5 col-lg-3">
                            <div class="upcomming_war_counter text-center">
                                <h2>Prochain gros tournois: name</h2>
                                <div id="timer" class="d-flex justify-content-between">
                                    <div id="days">99</div>
                                    <div id="hours">12</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->
        <!-- use sasu part end-->

        <!-- pricing part start-->
        <section class="pricing_part padding_top">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section_tittle text-center">
                            <h2>Nous soutenir</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <h3>Il n'y a encore aucun contenue qui à était mis en ligne...</h3>
                    <!--
                        <div class="col-lg-3 col-sm-6">
                            <div class="single_pricing_part">
                                <p>Silver Package</p>
                                <h3>$50.00</h3>
                                <ul>
                                    <li>2GB Bandwidth</li>
                                    <li>Two Account</li>
                                    <li>15GB Storage</li>
                                </ul>
                                <a href="#" class="btn_2">Choose Plane</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="single_pricing_part">
                                <p>Silver Package</p>
                                <h3>$60.00</h3>
                                <ul>
                                    <li>2GB Bandwidth</li>
                                    <li>Two Account</li>
                                    <li>15GB Storage</li>
                                </ul>
                                <a href="#" class="btn_2">Choose Plane</a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="single_pricing_part">
                                <p>Silver Package</p>
                                <h3>$80.00</h3>
                                <ul>
                                    <li>2GB Bandwidth</li>
                                    <li>Two Account</li>
                                    <li>15GB Storage</li>
                                </ul>
                                <a href="#" class="btn_2">Choose Plane</a>
                            </div>
                        </div>
                    -->
                </div>
            </div>
        </section>
        <!-- pricing part end-->

        <?php foot(); ?>
    </div>


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
