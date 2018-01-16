<?php
// views/loop.php
$myArray = [42, 1];
$myArray[] = 123;
$myArray[] = 2;

for ($i = 0; $i < count($myArray); $i++) {
  echo $i.'<br />';
  echo $myArray[$i].'<br />';
}

// boucle while qui émule une boucle for
$i = 0;
while ($i < count($myArray)) {
  echo $i.'<br />';
  echo $myArray[$i].'<br />';
  $i++;
}

// array_push() // ajoute un élément, équivalent de $myArray[] = ...
// array_pop() // retire le dernier élément ajouté
// array_shift() // retire le premier élément ajouté
// array_unshift() // insère un élément en début de liste
// array_splice() // supprime / remplace un ou plusieurs élément à tout endroit de la liste

// boucle while qui consomme un tableau
while ($row = array_shift($myArray)) {
  echo $row.'<br />';
}

$product = [
  'name' => 'Foo',
  'description' => 'lorem ipsum',
  'price' => 3.14,
  'stock' => 2,
  'highlight' => true,
];

// boucle foreach avec clés et données
foreach ($product as $key => $value) {
  echo $key.' : '.$value.'<br />';
}
