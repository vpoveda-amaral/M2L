<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/ligue.css">
	<title>Ligue</title>
	<meta charset="utf-8">
</head>
<body>
	<nav>
		<a href="../index.php">Accueil</a>
		<a href="ligue.php">Ligue</a>
		<a href="../prestation/prestation.php">Prestation</a>
		<a href="../facture/facture.php">Facture</a>
		<div class="animation ligue"></div>
	</nav>
	<div id="tab">
		<h1>Liste des ligues</h1>
		<table class="aff2">
				<tr>
					<td>Code Ligue</td>
					<td>Nom Ligue</td>
					<td>Adresse</td>
					<td>Ville</td>
					<td>Code Postal</td>
					<td>Sport</td>
					<td>Tresorier</td>
					<td ></td>
					<td ></td>
				</tr>
			</table>
		<?php 
//Inclusion du fichier contenant la connexion à la base h
		include_once('../connexion.php');

//La requête SQL 
		$sql = "SELECT * FROM `ligue` LIMIT 0 , 10";

//Recherche des données 
		$sth = $dbh->query($sql); 

// On voudrait les résultats sous la forme d’un tableau associatif 
		$result = $sth->fetchAll(PDO::FETCH_ASSOC); 

//Affichage des résultats 
		foreach ($result as $row){?>
			<table class="aff">
				<tr>
					<td>
						<?php echo $row['CodeLigue'];?>
					</td>
					<td>
						<?php echo $row['NomLigue']; ?>
					</td>
					<td>
						<?php echo $row['Adresse']; ?>
					</td>
					<td>
						<?php echo $row['Ville']; ?>
					</td>
					<td>
						<?php echo $row['CP']; ?>
					</td>
					<td>
						<?php echo $row['Sport']; ?>
					</td>
					<td>
						<?php echo $row['Tresorier']; ?>
					</td>
					<td>
						<?php  
						echo "<a href='suppression-ligue.php?id=" .$row['CodeLigue']."'>Supprimer</a>";
						?>
					</td>
					<td>
						<?php  
						echo "<a href='modifier-ligue.php?id=" .$row['CodeLigue']."'>Modifier</a>";
						?>
					</td>
				</tr>
			</table>
		<?php }
		$dbh=NULL; 
		?>
		<table class="aff">
			<tr>
				<td>
					<?php  
				echo "<a href='ajoute-ligue.html'>Ajouter une ligue</a>";
				?></td>

			</tr>
		</table>
</div>
</body>
</html>
		

