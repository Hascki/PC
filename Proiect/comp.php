<?php
include("conexiune.php");

$mic=$_POST['mic'];
$mare=$_POST['mare'];
$tip=$_POST['tip'];
if ($mic>=$mare) {

echo '<script language="javascript">';
echo 'alert("Numerele introduse nu corespund!(in a doua casuta trebuie introdus un numar mai mare decat in prima!!)")';
echo '</script>';

}
else{
$pret=mysql_query("SELECT * FROM produse WHERE (pret BETWEEN '$mic.' AND '$mare.') AND (tip='$tip') ORDER BY pret");
 if (mysql_num_rows($pret)==0)
{
 echo '<script language="javascript">';
echo 'alert("Nu avem produse cu acest pret !!")';
echo '</script>';
}
 else if ($tip=='bmw'){
echo "<table>";
while ($row=mysql_fetch_row($pret)) {
echo "<tr><td rowspan=2 width=225 height=204><img src='$row[1]' width=225 height=200 ></td><td width=541><font size=4><b>$row[2]</b></font></td>
<td width=429>
  <form action=tel.php method=POST>

  <input type=hidden name=one_data value='$row[0]' />
   <input type=submit name=submit_one value=Cumpara />
  </form>
</td></tr>
<tr><td><dl>$row[3]</dl></td><td width=429><dl>$row[4]</dl></td><td width=176><b>Pret:<br>$row[6] euro</b></td></tr>";
}
echo "</table>";
}
else if ($tip=='audi'){
echo "<table>";
while ($row=mysql_fetch_row($pret)) {
echo "<tr><td rowspan=2 width=225 height=204><img src='$row[1]' width=225 height=200 ></td><td width=703><font size=4><b>$row[2]</b></font></td>
<td width=364>
  <form action=tel.php method=POST>

  <input type=hidden name=one_data value='$row[0]' />
   <input type=submit name=submit_one value=Cumpara />
  </form>
</td></tr>
<tr><td><dl>$row[3]</dl></td><td width=429><dl>$row[4]</dl></td><td width=104><b>Pret:<br>$row[6] euro</b></td></tr>";
}
echo "</table>";
}
else{
echo "<table>";
while ($row=mysql_fetch_row($pret)) {
echo "<tr><td rowspan=2 width=225 height=217><img src='$row[1]' width=225 height=200 ></td><td width=780><font size=4><b>$row[2]</b></font></td>
<td width=281>
  <form action=tel.php method=POST>

  <input type=hidden name=one_data value='$row[0]' />
   <input type=submit name=submit_one value=Cumpara />
  </form>
</td></tr>
<tr><td><dl>$row[3]</dl></td><td width=429><dl>$row[4]</dl></td><td width=90><b>Pret:<br>$row[6] lei</b></td></tr>";
}
echo "</table>";
}
}
mysql_close($conexiune);
?> 