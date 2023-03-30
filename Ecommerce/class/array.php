<?php

$myarray = array(

   array("Chanel","Louboutins","Gucci") ,
    
   array("Nike","Adidas","Skechers")
    
);

echo "<pre>";

print_r($myarray[0][1]);

echo "</pre>";

$people = [
    'Levi'=> ['Charismatic','Heart-throb','Suave'],
    'Ophelia'=> ['Shy','Lovable','Loves Levi']
];

echo "<pre>";
print_r($people);
echo "</pre>";

echo '<h2>Here are their characteristics';
foreach($people as $name => $chars){
   echo "<h2>$name</h2>";
   foreach($chars as $char){
    echo "<p>$char</p>";
   }
}
?>