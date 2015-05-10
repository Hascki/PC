<style type="text/css"> 
iframe{
 background-color: transparent;
    border: 0px none transparent;
    padding: 0px;
    overflow: hidden;
   
}
</style>
<style type="text/css">
#pos{position: fixed;
    top: 20px;
   
	left:30px;
	}
</style>
<?php function get_options()
{
include("conexiune.php");
$sql = "SELECT MakeId,Producator FROM marci where Auto=1";
$result = mysql_query($sql);
$options='';
while ($row = mysql_fetch_array($result)) {
	$options.='<option value="'.$row['MakeId'].'">'.$row['Producator'].'</option>';
}
return $options;
}
?>
<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form name="autoturisme" action="autodrdwnmodel.php" method="post" >
<div id="pos">
<select name="marci" onchange="this.form.submit();">
<option>Alegeti marca</option>
<?php  echo get_options();?>
</select>
</div>
</form>



<!iframe name="frame"><!/iframe>

</body>
</html>