<?php
include("conexiune.php");
session_start();
function get_combustibil($field)
{
$r='';
if($field=="1")
{
$r="Benzina";
}
elseif($field=="2")
{
$r="Diesel";
}
elseif($field=="3")
{
$r="Hibrid";
}
return $r;
}

function get_distributie($field)
{
$r='';
if($field=="1")
{
$r="Manuala";
}
elseif($field=="2")
{
$r="Secventiala";
}
elseif($field=="3")
{
$r="Automata";
}
return $r;
}

function get_climatizare($field)
{
$r='';
if($field=="0")
{
$r="Nu are";
}
elseif($field=="1")
{
$r="Manual";
}
elseif($field=="2")
{
$r="Automat";
}
return $r;
}

function get_bit_fields($field)
{
$r='';
if($field=="0")
{
$r="NU";
}
elseif($field=="1")
{
$r="DA";
}
return $r;
}

$_SESSION['modele']=$_POST['modele'];
$sql=mysql_query("SELECT Producator,ModelName,Poza,Kilometraj,DataFabricatie,Pret,CaiPutere,Capacitate,ClasaEuro,Culoare,Combustibil,Distributie,Climatizare,SIA,IC,RV,SIE,GE,Nav,SP,Servo,TD,JA,Carlig,ABS,ESP,Integrala,Xenon FROM marci,pozeanunturi,produse,modele WHERE produse.ModelId=modele.ModelId and produse.MakeId=marci.MakeId and produse.MakeId='".$_SESSION['marci']."' and produse.ModelId='".$_SESSION['modele']."' and pozeanunturi.IdAnunt=produse.IdAnunt and Categorie=1 ORDER by Promovare ASC");

echo "<table>";
while ($row=mysql_fetch_array($sql)) {
//echo get_bit_fields($row); ".get_climatizare($row)." ".get_bit_fields($row["ABS"])."
echo "<tr><td rowspan=2 width=225 height=204>".'<img src="data:image/jpeg;base64,'.base64_encode($row['Poza']).'" width=225 height=200>'."</td><td width=54><font size=4><b>$row[Producator]</b></font></td><td ><font size=3><b>$row[ModelName]</b></font></td>
<td width=429>
  <form action=tel.php method=POST>
<input type=hidden name=one_data value='$row[Capacitate]' />
   <input type=submit name=submit_one value=Cumpara />
  </form>
</td></tr>
<tr><td ><dl>$row[Culoare]</dl></td><td width=429><dl>$row[4]</dl></td><td width=176><b>Pret:<br>euro</b></td></tr>";
}
echo "</table>";

mysql_close($conexiune);
?> 