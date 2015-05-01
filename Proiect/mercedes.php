<?php
include("conexiune.php");

$sql=mysql_query("SELECT * FROM produse WHERE tip='mercedes'");

echo "<table>";
while ($row=mysql_fetch_row($sql)) {
echo "<tr><td rowspan=2 width=225 height=217><img src='$row[1]' width=225 height=200 ></td><td width=780><font size=4><b>$row[2]</b></font></td>
<td width=281>
  <form action=tel.php method=POST>

  <input type=hidden name=one_data value='$row[0]' />
   <input type=submit name=submit_one value=Cumpara />
  </form>
</td></tr>
<tr><td><dl>$row[3]</dl></td><td width=429><dl>$row[4]</dl></td><td width=90><b>Pret:<br>$row[6] euro</b></td></tr>";
}
echo "</table>";

mysql_close($conexiune);
?> 