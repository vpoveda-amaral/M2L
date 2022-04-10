<!DOCTYPE html>
<html> 
<head>
	<link rel="stylesheet" type="text/css" href="css/prestation.css">
	<title>Prestation</title>
	<meta charset="utf-8">
</head>
<body>
	<nav>
		<a href="../index.php">Accueil</a>
		<a href="../ligue/ligue.php">Ligue</a>
		<a href="prestation.php">Prestation</a>
		<a href="../facture/facture.php">Facture</a>
		<div class="animation prestation"></div>
	</nav>
	<div id="tab">
		<h1>Liste des prestations</h1>
		<table class="aff2">
			<tr>
				<td>Code Préstation</td>
				<td>Référence</td>
				<td>Désignation</td>
				<td>PU HT</td>
				<td ></td>
				<td ></td>
			</tr>
		</table>
		<?php 
//Inclusion du fichier contenant la connexion à la base h
		include_once('../connexion.php');

//La requête SQL 
		$sql = "SELECT * FROM prestation";

//Recherche des données 
		$sth = $dbh->query($sql); 

// On voudrait les résultats sous la forme d’un tableau associatif 
		$result = $sth->fetchAll(PDO::FETCH_ASSOC); 

//Affichage des résultats 
		foreach ($result as $row){?>
			<table class="aff">
				<tr>
					<td>
						<?php echo $row['CodePrestation'];?>
					</td>
					<td>
						<?php echo $row['Reference'];?>
					</td>
					<td>
						<?php echo $row['Designation']; ?>
					</td>
					<td>
						<?php echo $row['PUHT']; ?>
					</td>
					<td>
						<?php  
						echo "<a href='suppression-prestation.php?id=" .$row['CodePrestation']."'>Supprimer</a>";
						?>
					</td>
					<td>
						<?php  
						echo "<a href='modifier-prestation.php?id=" .$row['CodePrestation']."'>Modifier</a>";
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
					echo "<a href='ajouter-prestation.html'>Ajouter une prestation</a>";
					?>

				</td>

			</tr>
		</table>
	</div>
</body>
</html>