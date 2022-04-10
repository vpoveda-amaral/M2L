<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/ligue.css">
	<title>Modifier ligue</title>
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
		<h1>Modifier la ligue</h1>
		<?php
//Pafe d'affichage formulaire pour modifier une ligue

//Inclusion du fichier contenant la connexion à la base
		include_once('../connexion.php');

//Recupération de l'id de la ligue
		$id  = $_GET["id"] ;

//Requete SQL pour selectionner toutes les données de la ligue concernée
		$sql = "SELECT * FROM ligue WHERE CodeLigue=".$id;

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
			<form method="post" id="modification" name="modification" action="execution-modif-ligue.php">
				<input type="hidden" name="id" value="<?php echo($id) ;?>">
				<table class="autre">
					<tr>
						<td>Code Ligue</td>
						<td>
							<?php 
							echo "<input type='text' id='CodeLigue' name='CodeLigue' value='".$row['CodeLigue']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Nom de Ligue</td>
						<td>
							<?php 
							echo "<input type='text' id='NomLigue' name='NomLigue' value='".$row['NomLigue']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Ville</td>
						<td>
							<?php 
							echo "<input type='text' id='ville' name='ville' value='".$row['Ville']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Code Postal</td>
						<td>
							<?php 
							echo "<input type='text' id='cp' name='cp' value='".$row['CP']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Adresse</td>
						<td>
							<?php 
							echo "<input type='text' id='adresse' name='adresse' value='".$row['Adresse']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Sport</td>
						<td>
							<?php 
							echo "<input type='text' id='sport' name='sport' value='".$row['Sport']."'>";
							?>
						</td>
					</tr>
					<tr>
						<td>Nom du tresorier</td>
						<td>
							<?php 
							echo "<input type='text' id='Tresorier' name='Tresorier' value='".$row['Tresorier']."'>";
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
