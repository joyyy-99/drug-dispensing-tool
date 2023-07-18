<?php
$fruits = array ('apple','orange','banana','Mango');
print_r($fruits);
echo '<br>';
echo "I like ".$fruits[0]." and " .$fruits[2];
echo '<br>';
echo count($fruits);
echo '<br>';
$arrlength = count($fruits);
//Using a for loop
for ($x = 0; $x < $arrlength; $x++){
    echo $fruits[$x]."<br>";
}
echo "This is the end of my for loop";
    echo '<br>';
//Using a foreach loop
foreach($fruits as $fruit){
    echo $fruit . '<br>';
}
?>
