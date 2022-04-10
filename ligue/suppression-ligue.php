<?php
//Inclusion du fichier contenant la connexion à la base 
include_once('../connexion.php'); 

//Recupération de l'id de la ligue
$id  = $_GET["id"] ;

  //requête SQL:
$sql = "DELETE FROM ligue WHERE CodeLigue = " .$id ;

 //exécution de la requête:
$dbh->exec($sql); 
$dbh=NULL;

//Lien vers une page selon le bon fonctionnement ou non de la requete
if ($sql) {
	header('Location:reussi-supp-ligue.php');
	exit();
}	
else{
	echo "Une erreur s'est produite, la ligue n'a pas été supprimée";
}
?>