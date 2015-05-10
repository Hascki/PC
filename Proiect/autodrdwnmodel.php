
<style type="text/css">
#grey{position: fixed;
    top: 60px;
   
	left:25px;
	}
	
	
</style>
<?php
session_start();
function get_options()
{

require_once("conexiune.php");

$_SESSION['marci']=$_POST['marci'];
if ($_SESSION['marci']=='Alegeti marca') {

echo '<script language="javascript">';
echo 'alert("Trebuie sa alegeti o marca de masini pentru a continua!")';
echo '</script>';

}
else{
$sql = "SELECT ModelId,ModelName FROM modele where MakeId='".$_SESSION['marci']."'";
$result = mysql_query($sql);
$options='';
while ($row = mysql_fetch_array($result)) {
	$options.='<option value="'.$row['ModelId'].'">'.$row['ModelName'].'</option>';
}
return $options;
}
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>

<form name="autoturisme" action="afisare1.php" method="post" onsubmit="proceed()">
<div id="grey">
<select name="modele" onchange="this.form.submit();">
<option>Alegeti modelul</option>
<?php echo get_options(); ?>
</select>
</div>
</form>

</body>
</html>
<?php
/*$sql = "SELECT ModelName FROM modele where MakeId='".$_SESSION['marci']."'";
$result = mysql_query($sql);
$options='';
echo "<select name='year'>";
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['ModelName'] . "'>" . $row['ModelName'] . "</option>";
	
}
*/

/*mysql_connect('host', 'user', 'pass');
mysql_select_db ("database");

$sql = "SELECT year FROM data";
$result = mysql_query($sql);

echo "<select name='year'>";
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['year'] . "'>" . $row['year'] . "</option>";
}
echo "</select>";
*/
?>