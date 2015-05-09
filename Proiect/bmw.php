<?php
include("conexiune.php");

$sql=mysql_query("SELECT * FROM `produse` WHERE 1");
$result = mysql_query($sql);

echo "<table>"; // start a table tag in the HTML

while($row = mysql_fetch_array($result)){   //Creates a loop to loop through results
echo "<tr><td>" . $row['idAnunt'] . "</td><td>" . $row['Pret'] . "</td></tr>";  //$row['index'] the index here is a field name
}

echo "</table>"; //Close the table in HTML

mysql_close(); //Make sure to close out the database connection


mysql_close($conexiune);
?> 