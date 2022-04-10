<?php
//Inclusion du fichier contenant la connexion à la base
	include_once('../connexion.php');
$reference = $_POST['reference'];
$designation = $_POST['designation'];
$puht = $_POST['puht'];
//Nouvelle ligue
$sql = "INSERT INTO prestation (CodePrestation,Reference,Designation,PUHT) VALUES ('$codeprestation','$reference', '$designation', '$puht')"; 
//Exécution de la requête 
$dbh->exec($sql); 
$dbh=NULL;
if ($sql) {
	header('Location:reussi-ajout-prestation.php');
	exit();
}	
else{
	echo "Une erreur s'est produite, veuillez réessayer.";
}	
?>