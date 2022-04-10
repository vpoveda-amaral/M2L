<?php
//Inclusion du fichier contenant la connexion à la base
include_once('../connexion.php');

//Recupération de la variable id grace au hidden
$id = $_POST["id"] ;

//Recupération des données entrer dans le formulaire de "modifier-ligue.html"
$CodeLigue = $_POST['CodeLigue'];
$NomLigue = $_POST['NomLigue'];
$Tresorier = $_POST['Tresorier'];
$Adresse = $_POST['adresse'];
$Ville = $_POST['ville'];
$CP = $_POST['cp'];
$Sport = $_POST['sport'];

//Requete SQL pour mettre a jour dans la ligue concernée
$sql ="UPDATE ligue SET CodeLigue = '$CodeLigue', NomLigue = '$NomLigue', Ville = '$Ville', CP = '$CP', Adresse = '$Adresse', Sport = '$Sport', Tresorier = '$Tresorier' WHERE CodeLigue=".$id;

//exécution de la requête SQL:
$dbh->exec($sql); 

//Lien vers une page selon le bon fonctionnement ou non de la requete
if ($sql) {
	header('Location:reussi-modif-ligue.php');
	exit();
}	
else{
	echo "Une erreur s'est produite, la ligue n'a pas été modifié";
}
?>