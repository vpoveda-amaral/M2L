<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/facture.css">
	<title>Facture</title>
	<meta charset="utf-8">
</head>
<body>
	<nav>
		<a href="../index.php">Accueil</a>
		<a href="../ligue/ligue.php">Ligue</a>
		<a href="../prestation/prestation.php">Prestation</a>
		<a href="facture.php">Facture</a>
		<div class="animation facture"></div>
	</nav>
	<h1>Facture</h1>
	<?php
//Pafe d'affichage formulaire pour modifier une ligue

//Inclusion du fichier contenant la connexion à la base
		include_once('../connexion.php');

//Requete SQL pour selectionner toutes les données de la ligue concernée
		$sql = "SELECT * FROM ligue ";

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
				<table class="autre">
					<tr>
						<select >
							
								<?php
								
							echo "<option value='".$row['CodeLigue']."'>".$row['NomLigue']."</option>";
							?>
							
							</section>
													
					</tr>
				</table>
			</form>
			<?php
		}
		?>
	</div>
</body>
</html>