<?php

	$host = "localhost";
	$db = "kamq6688_asr";
	$user = "kamq6688_usr_asr";
	$mdp = "F*LCA&kI#8ZZ";


	try {
		$bdd = new PDO('mysql:host='.$host.';dbname='.$db, $user, $mdp);
		$bdd->exec('SET NAMES utf8');
	} catch (PDOException $e) {
		echo "Raté!!! " . $e->getMessage() . "<br>" ;
		die();
	}

?>
