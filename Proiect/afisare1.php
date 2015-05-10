<?php
include("conexiune.php");
session_start();
$_SESSION['modele']=$_POST['modele'];
$sql=mysql_query("SELECT Poza,Kilometraj,DataFabricatie,Pret,CaiPutere,Capacitate,ClasaEuro,Culoare,Combustibil,Distributie,Climatizare FROM pozeanunturi,produse WHERE MakeId='".$_SESSION['marci']."' and ModelId='".$_SESSION['modele']."' and pozeanunturi.IdAnunt=produse.IdAnunt and Categorie=1");

echo "<table>";
while ($row=mysql_fetch_array($sql)) {
echo "<tr><td rowspan=2 width=225 height=204>".'<img src="data:image/jpeg;base64,'.base64_encode($row['Poza']).'" width=225 height=200 >'."</td><td width=541><font size=4><b>$row[Kilometraj]</b></font></td>
<td width=429>
  <form action=tel.php method=POST>
<input type=hidden name=one_data value='$row[Capacitate]' />
   <input type=submit name=submit_one value=Cumpara />
  </form>
</td></tr>
<tr><td><dl>$row[Culoare]</dl></td><td width=429><dl>$row[4]</dl></td><td width=176><b>Pret:<br>$row[Pret] euro</b></td></tr>";
}
echo "</table>";

mysql_close($conexiune);
?> 