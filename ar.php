<?php
//Peter is the key, 35 is the value
$age = array("Peter"=>"35","Ben"=>"37","Joe"=>"43");
print_r($age);
echo '<br>';
//This is a foreach loop
foreach($age as $key => $value){
    echo "My name is: " .$key. " and my age is: ".$value;
    echo '<br>';
}
$keys=array_keys($age);
print_r($keys);
echo '<br>';
$array_size = count($age);
print_r($array_size);
echo '<br>';
//This is a for loop
for ($y = 0; $y<$array_size; ++$y){
    echo $keys[$y] . ' is ' . $age[$keys[$y]] ;
    echo '<br>';
}
?>