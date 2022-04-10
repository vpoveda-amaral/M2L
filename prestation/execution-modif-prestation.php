<?php
//Inclusion du fichier contenant la connexion à la base
include_once('../connexion.php');

//Recupération de la variable id grace au hidden
$id = $_POST["id"] ;

//Recupération des données entrer dans le formulaire de "modifier-ligue.html"
$CodePrestation = $_POST['CodePrestation'];
$Reference = $_POST['Reference'];
$Designation = $_POST['Designation'];
$PUHT = $_POST['PUHT'];

//Requete SQL pour mettre a jour dans la ligue concernée
$sql ="UPDATE prestation SET CodePrestation = '$CodePrestation', Reference = '$Reference', Designation = '$Designation', PUHT = '$PUHT' WHERE CodePrestation=".$id;

//exécution de la requête SQL:
$dbh->exec($sql); 

//Lien vers une page selon le bon fonctionnement ou non de la requete
if ($sql) {
	header('Location:reussi-modif-prestation.php');
	exit();
}	
else{
	echo "Une erreur s'est produite, la ligue n'a pas été modifié";
}
?>