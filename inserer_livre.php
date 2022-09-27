<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Ajouter un livre</title>
  <link rel="stylesheet" href="style.css">
  </head>
<body>
	<?php
	/*******************************************************************************
		Nom du script : inserrer_livre.php
		Description   : script qui reçoit les données "postées" par le formulaire,
						les filtres avant de les placer dans des variables
						locales.
						Ensuite se connecte au SGBD sur le poste local,
						puis envoie une requête SQL pour inserer les données
						dans la table livre.
		Date	      : 4/03/2022
		Version		  : 1.0
		Auteur		  : Prof
	
	*******************************************************************************/
	// le formulaire à été complété et envoyé, netoyer les données
	// avant de les utiliser
		
		$leTitre = nettoyer($_POST["titre"]);
		$lAuteur = nettoyer($_POST["auteur"]);
		$leGenre = nettoyer($_POST["genre"]);
		$lePrix  = nettoyer($_POST["prix"]);
	
	// on prépare la requete à envoyer
		$requete = "INSERT INTO livre(titre,auteur,genre,prix)
	            VALUES('$leTitre','$lAuteur','$leGenre',$lePrix)";
	
	// on se connecte au serveur pour enoyer la requête
	// paramêtres de connexion
	$serveur      = "localhost";
	$utilisateur  = "user";
	$motDePasse	  = "Azerty77";
	$BD			  = "biblio";
	
	// tentative de connexion au SGBD MySQL
	if($bdd = mysqli_connect($serveur, $utilisateur, $motDePasse, $BD))
	{
		// on s'assure que le résultat sera en utf8
		mysqli_set_charset( $bdd, 'utf8');
		// on envoie la requête
		if($resultat = mysqli_query($bdd,$requete))
		{
			echo "insertion ok";
		}
		else{
			echo "erreur de requête";
		}
	}
	else
	{
		echo "erreur de connexion";
	}
	
	
	
			function nettoyer($chaine)
			{
				//Supprime les antislashs d'une chaîne
				$chaine= stripslashes($chaine);
		
				//Supprime les balises HTML et PHP d'une chaîne
				$chaine = strip_tags($chaine);
		
				// Convertit tous les caractères éligibles en entités HTML
				$chaine  = htmlentities($chaine);
		
				// on retourne la chaine "filtrée"
			return $chaine;
	}
	
	?>

</body>