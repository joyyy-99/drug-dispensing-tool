<?php
$myarray = array(
    array('Ankit','Ram','Shyam'),
    array('Unnao','Trichy','Kanpur')
);
#Accessing a multidimensional array using dimensions
//First is the row then the column
print_r($myarray[1][2]);
echo '<br>';
//Accessing the array using a foreach loop
foreach($myarray as $array){
    foreach($array as $value){
        echo $value . '  ';
    }
    echo '<br>';
}
?>