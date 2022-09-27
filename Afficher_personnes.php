<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>liste des personnes</title>
  <link rel="stylesheet" href="style.css">
 </head>
<body>
	<h1> Liste des personnes </h1>
	<table>
		<tr> 
			<th>N° personne</th><th>nom</th>
			<th>prénom</th><th>ville</th>		
		</tr>
	<?php
	/*
		Nom du script: Afficher_personnes.php
		Description  : 	script qui se connecte au SGBD MySQL sur le poste local
						puis envoie une requete SQL pour obtenir les données sur 
						les personnes. 
						Ensuite récupère les informations et les affiches dans un
						tableau HTML.
		Date		 : 01/02/2022
		version 	 : 1.0
		Auteur		 : Prof
	*/
	// paramètres de connexion
	$serveur 	= 'localhost';
	$user 		= 'root';
	$password   = '';
	$NomBD		= 'biblio';
	
	// connexion au SQBD MySQL
	if($bdd = mysqli_connect($serveur, $user,$password, $NomBD))
	{
		// on s'assure que le résultat sera en utf8
		mysqli_set_charset( $bdd, 'utf8');
		
	   // connexion ok on envoie une requete pour interroger la table livre
	   $requete = "SELECT * FROM personne";
	   if($resultat = mysqli_query($bdd, $requete))
	   {
		 // requete ok, on extrait les données ligne par ligne
		 while($ligne = mysqli_fetch_assoc($resultat))
		{
			// extraire les champs 
			$leNumPersonne 	 = $ligne['numpersonne'];
			$leNom  		 = $ligne['nom'];
			$lePrenom  		 = $ligne['prenom'];
			$laVille  		 = $ligne['ville'];
			
			
			// on affiche
			echo "<tr>
			        <td>$leNumPersonne</td><td>$leNom</td> 
					<td>$lePrenom</td><td>$laVille</td> 
			</tr>";
		}
		mysqli_free_result($resultat);
		
	   }
	   else
	   {
		    // erreur de requête
			die("erreur de requete SQL");
	   }
	}
	else{
		// echec de connexion
		die("erreur de connexion au SGBD ");
	}
	
	
	?> 
	 </table>
	 <a href="index.html"><img src="back.ico"></a>
</body>
</html>