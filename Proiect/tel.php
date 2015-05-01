<?php

$data = $_POST['one_data'];

echo '<form action="trimite.php" method="POST">
Nume:   <input type="text" name="nume"><br><br>
Prenume:<input type="text" name="prenume"><br><br>
Telefon:<input type="text" name="telefon"><br><br>
Email:  <input type="text" name="email"><br><br>
Adresa: <input type="text" name="adresa"><br><br>
<input type="hidden" name="produs" value="'.$data.'" />
Nr. bucati: <select name="nr_buc">
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
</select>
    	<input type="submit" value="Trimite">
</form>';

  ?> 