<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/prestation.css">
	<title>Modifier prestation</title>
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
		<h1>Modifier la ligue</h1>
		<?php
//Pafe d'affichage formulaire pour modifier une ligue

//Inclusion du fichier contenant la connexion à la base
		include_once('../connexion.php');

//Recupération de l'id de la ligue
		$id  = $_GET["id"];

//Requete SQL pour selectionner toutes les données de la ligue concernée
		$sql = "SELECT * FROM prestation WHERE CodePrestation=".$id;

//Recherche des données 
		$sth = $dbh->query($sql);

// On voudrait les résultats sous la forme d’un tableau associatif 
		$result = $sth->fetchAll(PDO::FETCH_ASSOC);

//exécution de la requête:
		$dbh->exec($sql);
		$dbh=NULL;

//Affichage du formulaire de modif

//La variable row permet de naviguer dans result (donc dans le tableau contenant toutes les données de la ligue concernée)

// Hidden (ligne31) permet de ne pas perdre la variable id lorque l'on envoie la page "execution-modif-ligue.php"

		foreach ($result as $row){?>
			<form method="post" id="modification" name="modification" action="execution-modif-prestation.php">
				<input type="hidden" name="id" value="<?php echo($id) ;?>">
				<table class="autre">
					<tr>
						<td>Code Préstation</td>
						<td>
							<?php 
							echo "<input type='text' id='CodePrestation' name='CodePrestation' value='".$row['CodePrestation']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Référence</td>
						<td>
							<?php 
							echo "<input type='text' id='Reference' name='Reference' value='".$row['Reference']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Designation</td>
						<td>
							<?php 
							echo "<input type='text' id='Designation' name='Designation' value='".$row['Designation']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>PU HT</td>
						<td>
							<?php 
							echo "<input type='text' id='PUHT' name='PUHT' value='".$row['PUHT']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td></td>
						<td>
							<input type="submit" id="modifier" name="modifier" value="Modifier">
						</td>
					</tr>
				</table>
			</form>
			<?php
		}
		?>
	</div>
</body>
</html>
