<?php
$row = 1;
 if (($handle = fopen("14_Programas.csv", "r")) !== FALSE) {
     while (($data = fgetcsv($handle, 8192, ";" , "\"")) !== FALSE) {
         $num = count($data);
         echo "<p> $num campos na linha $row: <br /></p>\n";
         $row++;
         for ($c=0; $c < $num; $c++) {
             echo $data[$c] . "<br />\n";
         }
     }
    fclose ($handle);
 }
?>

