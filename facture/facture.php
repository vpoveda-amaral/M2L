<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../prestation/css/prestation.css">
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
<div id="tab">
	<table class="aff" >
		<thead>
			<tr>
				<td class="border primary">Référence</td>
				<td class="border primary">Quantité</td>
				<td class='border primary'>Nom de la ligue</td>
			</tr>	
		</thead>
		<tbody>
			<form id="creation-prestation" name="creation-prestation" method="POST" action='creation-facture.php'>
				<?php
				//on vas chercher tout les nom des nom de prestation existante
				//Inclusion du fichier contenant la connexion à la base h
		include_once('../connexion.php');

		
					try{
					$sql="SELECT CodePrestation from prestation";
					$presta =$dbh->query($sql);
					$presta = $presta->fetchAll(PDO::FETCH_ASSOC);
					}catch(PDOEXEPTION $e){
					die($e);
					}
				for ($i=1; $i < 11 ; $i++) { 
					echo"<tr><td class='border '><SELECT name='code".$i."'><OPTION></option>";
					foreach ($presta as $row) {
						echo "<OPTION>".$row['CodePrestation']."</option>";
					}
					echo "</SELECT></td>
					<td class='border '><input type='number' name='quanti".$i."' value='0'></td>";
							if($i==1){
								//on vas chercher tout les intituler de ligue existante
							try{
							$sql="SELECT NomLigue from ligue";
								$result =$dbh->query($sql);
								$result = $result->fetchAll(PDO::FETCH_ASSOC);
							}catch(PDOEXEPTION $e){
							die($e);
							}
							echo "<td class='border'><SELECT name='codecli'>";
							foreach ($result as $row) {
								echo "<OPTION>".$row['NomLigue']."</option>";
							}
								echo "</SELECT></td>";
							}else if($i==2){
								echo"<td class='border'><button class='btn btn-outline-primary' name='modi'>Valider le choix</button></td>";	
							}					 
					}
					echo "</tr>";
				?>
			</from>
		</tbody>
	</table>
	</div>
</body>
</html>
