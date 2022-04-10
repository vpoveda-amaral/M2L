
<?php
//on vas utiliser composer pour pouvoir télécharger la 
//blibliotéque html2pdf
include_once('../connexion.php');

use Spipu\Html2Pdf\Html2Pdf;
//on démare la récolte d'info
ob_start()
?>
<!-- style de la facture-->
<style type="text/css">
	table{border-collapse: collapse; margin: auto;}
	td{border: 10px solid black ;border: none;}
	td.empty {background-color: royalblue;border: 1px solid black ;border : rgba(0,5);padding: 10px;}
	td.border {border: 1px solid black ;border : rgba(0,5);padding: 10px;}
	td.raf{border-right: 1px solid black;border-left : rgba(0,5);padding: 10px;}
</style>
<!-- la facture elle même-->
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm">
	<page_footer>
		<hr/>
			<h4><?php echo "CROSL" ?></h4>
			
	</page_footer>		
	<!-- le haut de la page-->
	<table>
		<tr>
			<td style="width: 100%;">
			<br/><br/>
			<?php
				$sql="SELECT * FROM ligue where NomLigue='".$_POST['codecli']."'";
				$info=$dbh->query($sql);
				$info = $info->fetchAll(PDO::FETCH_ASSOC);
				foreach ($info as $row) {
					echo $row['NomLigue']."<br/>";
					echo $row['Tresorier']."<br/>";
					echo "Maison Régionale des Sports de Lorraine<br/>";
					echo $row['Adresse']."<br/>";
					echo $row['CP']."<br/>";
					$inti=$row['NomLigue'];
					$tres=$row['Tresorier'];
					$rue=$row['Adresse'];
					$codepo=$row['CP'];
					$ville=$row['Ville'];
					$verif=$row['verif'];
					$codecli=$row['CodeLigue'];
				}
			?>
			<br/>
			</td>
		</tr>
	</table>
	<!-- la desiéme ligne de la page-->
	<table>
		<tr>
			<td style="width: 60%;">
			<?php echo "Siret : 31740105700029";?><br/>
			<?php echo "Tél : 03.83.18.87.02"; ?><br/>
			<?php echo "Fax : 03.83.18.87.03"; ?><br/>	
			</td>
			<?php 
			foreach ($info as $row) {
			if ($row['verif']==0) {
				echo"<td style='width: 40%;'>";
				echo "<br/><br/>";
				echo "M2L<br/>";
				echo "Maison Régionale des Sports de Loraine<br/>";
				echo "13 Rue Jean Moulin<br/>";
				echo "54510<br/>";
			}else{
			 echo"<td style='width: 40%;'>";
			echo "<br/><br/>";
					echo $row['CodeLigue']."<br/>";
					echo "a l'attention de ".$row['Tresorier']."<br/>";
					echo "Maison Régionale des Sports de Lorraine <br/> ";
					echo $row['Adresse']."<br/>";
					echo $row['CP']."<br/>";
				}
			}
			 ?>
			</td>
		</tr>
	</table>
	<!-- la mot en gras-->
	<table>
		<tr>
			<td style="width: 20%;"><?php echo "<h1>Facture</h1>";?><br/></td>
		</tr>
	</table>
	<!-- le tableaux -->
	<table>
		<tr>
			<td style="width: 30%;" class="empty"><?php echo "date" ?></td>
			<td style="width: 30%;" class="empty"><?php echo "Numero" ?></td><!-- chercher dans la BD la bonne donnée-->
			<td style="width: 20%;" class="empty"><?php echo "Code Client" ?></td>
			<td style="width: 20%;" class="empty"><?php echo "échéance" ?></td><!-- à calculer-->
		</tr>
		<tr>
			<td style="width: 20%;" class="border"><?php $j= date("j"); $n=date("n");$Y=date("Y"); $datej= $j."/".$n."/".$Y; echo $datej; $datej=$Y."-".$n."-".$j; ?></td>
			<td style="width: 20%;" class="border"><?php 
			$sql="SELECT Num_facture FROM facture ORDER by Num_facture Desc LIMIT 0,1";
			$sth=$dbh->query($sql);
			$resultat=$sth->fetchall(PDO::FETCH_ASSOC);
			foreach ($resultat as $row) {
				$code= $row['Num_facture'];
			}
			$codeC = substr($code, 0,3);
			$codeCh = substr($code, 3,6);
			$codeCh =$codeCh +1;
			$code = $codeC.$codeCh;
			echo $code;
			 ?></td><!-- chercher dans la BD la bonne donnée-->
			<td style="width: 20%;" class="border"><?php echo $codecli; ?></td><!-- chercher dans la BD la bonne donnée-->
			<td style="width: 20%;" class="border"><?php 
			if ($n==2) {
				if($Y%4==0 && $Y%100 <>0 || $Y%400 == 0){
					$j=29;
				}else{
					$j=28;
				}
			}else if ($n%2 ==0) {
				$j=30;
			}else{
				$j=31;
			}
			$dateE= $j."/".$n."/".$Y;
			echo $dateE ;
			$dateE= $Y."-".$n."-".$j;?></td>
		</tr>
	</table>
	<br><br>
	<table>
		<tr>
			<td style="width: 20%;" class="empty"><?php echo "Référence" ?></td>
			<td style="width: 20%;" class="empty"><?php echo "QTé" ?></td>
			<td style="width: 20%;" class="empty"><?php echo "Désignation" ?></td><!-- chercher dans la BD la bonne donnée-->

			<td style="width: 20%;" class="empty"><?php echo "PU HT" ?></td><!-- à calculer-->
			<td style="width: 20%;" class="empty"><?php echo "Montant TTC" ?></td>
		</tr>
		<!-- faire un foreache pour afficher tout les valeurs envoyer par la page facture présédente-->

	<?php
			$ttc=0;
			$sql="INSERT INTO facture VALUES('$code',$codecli,'$datej','$dateE','$inti','$tres','$rue','$codepo','$ville',$verif,$ttc)";
			$dbh->exec($sql);
			$sql="SELECT Num_facture FROM facture ORDER by Num_facture Desc LIMIT 0,1";
			$sth=$dbh->query($sql);
			$resultat=$sth->fetchall(PDO::FETCH_ASSOC);
			foreach ($resultat as $row) {
				$code= $row['Num_facture'];
			}
			$cpt=0;
			for ($i=1; $i < 11 ; $i++) { 
					if (isset($_POST['code'.$i]) && $_POST['code'.$i]=="") {
					}else{
						$codei=$_POST['code'.$i];
						$quantii=$_POST['quanti'.$i];
						//a faire marcher (envoie as la bd les informations de la facture)
     					//affiche le tableaux
					echo"<tr><td style='width: 20%;' class='border'>".$codei."</td>";
					echo "<td style='width: 20%;' class='border'>".$quantii."</td>";
						$sql="SELECT Reference,PUHT FROM prestation where CodePrestation='$codei'";
						$recherche=$dbh->query($sql);
						$recherche = $recherche->fetchall(PDO::FETCH_ASSOC);
						foreach ($recherche as $row) {
						try{
							$sql="INSERT INTO Ligne_Facture VALUES('$code','$codei','".$row['Reference']."',$quantii,".$row['PUHT'].")";
							$dbh->exec($sql);
	    				}catch(PDOException $e){
							print "Erreur! :".$e->getMessage()."</br>";
							die();
     					}
						echo"<td style='width: 20%;' class='border'>".$row['Reference']."</td>";
						echo"<td style='width: 20%;' class='border'>".$row['PUHT']."</td>";
						echo "<td style='width: 20%;' class='border'>".($row['PUHT']*$quantii)."</td>";
						$ttc=$ttc+($row['PUHT']*$quantii);
						}
					 echo "</tr>";
					 $cpt=$cpt+1;
				}}
				$sql="UPDATE facture set TTC=$ttc where Num_facture='$code'";
				$dbh->exec($sql);
							echo "<tr>
			<td style='width: 20%;'></td>
			<td style='width: 20%;'></td>
			<td style='width: 20%;' class='raf'></td>
			<td style='width: 20%;' class='empty'> TTC TOTAL :</td>
			<td style='width: 20%;' class='border'>".$ttc."</td>
		</tr>";
		?>

	</table>



	<table>
		<tr>
			<td style="width: 100%;"><?php echo "date de réglage :" ?><br/><br/></td>
			<br/>
		</tr>
		<tr>
			<td style="width: 100%;"><?php echo "facture a réglée :" ?><br/></td>
		</tr>
		<tr>
			<td style="width: 50%;"><?php echo "- Par chèque à l’ordre de ( préciser)" ?><br/></td>
		</tr>
		<tr>
			<td style="width: 50%;"><?php echo "- Par virement sur le compte" ?><br/><br/><br/><br/></td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="width: 20%;"><?php echo "nom et qualité :" ?><br/><br/></td>
		</tr>
		<tr>
			<td style="width: 20%;"><?php echo "Signature et cachet :" ?></td>
		</tr>
	</table>
</page>
