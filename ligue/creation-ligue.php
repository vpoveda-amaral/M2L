<?php
//Inclusion du fichier contenant la connexion à la base
include_once('../connexion.php');

//Recupération des données entrer dans le formulaire de "ajouter-ligue.html"

$NomLigue = $_POST['NomLigue'];
$Tresorier = $_POST['Tresorier'];
$Adresse = $_POST['adresse'];
$Ville = $_POST['ville'];
$CP = $_POST['cp'];
$Sport = $_POST['sport'];

//Requete SQL pour insérer une nouvelle ligue
$sql = "INSERT INTO ligue (NomLigue, Ville, CP, Adresse, Sport, Tresorier) VALUES ('$NomLigue', '$Ville', '$CP', '$Adresse', '$Sport', '$Tresorier')"; 

//Exécution de la requête 
$dbh->exec($sql); 
$dbh=NULL;

//Lien vers la page "reussi-ajout-ligue.php" (si la requete a bien été executer) & vers la page "echec-ajout-ligue.php" (en cas d'echec de la requete)
if ($sql) {
	header('Location:reussi-ajout-ligue.php');
	exit();
}	
else{
	echo "Une erreur s'est produite, veuillez réessayer.";
}
?>