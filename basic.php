<?php

echo "Hello World";


// selection sort
function selection_sort($arr) {
  for ($i = 0; $i < count($arr) - 1; $i++) {
    $index_min = $i;
    for ($j = $i + 1; $j < count($arr); $j++) {
      if ($arr[$j] < $arr[$index_min]) {
        $index_min = $j;
      }
    }
    if ($index_min !== $i) {
      [$arr[$i], $arr[$index_min]] = [$arr[$index_min], $arr[$i]];
    }
  }
  return $arr;
}

echo "<br><strong>Selection sort</strong>";
$a = array(3, -1, 3, 5, 4);
echo "<br>";
var_dump($a);
echo "<br>";
var_dump(selection_sort($a));


// insert sort
function insert_sort($arr) {
  for ($i = 1; $i < count($arr); $i++) {
    $t = $arr[$i];
    $j = $i - 1;
    while ($j >= 0 && $arr[$j] > $t) {
      $arr[$j + 1] = $arr[$j];
      $j--;
    }
    $arr[$j + 1] = $t;
  }
  return $arr;
}

echo "<br><strong>Insert sort</strong>";
echo "<br>";
var_dump($a);
echo "<br>";
var_dump(insert_sort($a));


// bubble sort
function bubble_sort($arr) {
  for ($i = count($arr) - 1; $i > 0; $i--) {
    for ($j = 0; $j < $i; $j++) {
      if ($arr[$j] > $arr[$j + 1]) {
        [$arr[$j], $arr[$j + 1]] = [$arr[$j + 1], $arr[$j]];
      }
    }
  }
  return $arr;
}

echo "<br><strong>Bubble sort</strong>";
echo "<br>";
var_dump($a);
echo "<br>";
var_dump(bubble_sort($a));

// quick sort
function partition(&$arr, $left, $right) {
  $i = $left;
  for ($j = $left; $j < $right; $j++) {
    if ($arr[$j] <= $arr[$right]) {
      [$arr[$i], $arr[$j]] = [$arr[$j], $arr[$i]];
      $i++;
    }
  }
  [$arr[$i], $arr[$right]] = [$arr[$right], $arr[$i]];
  return $i;
}

function quick_sort(&$arr, $left, $right) {
  if($left < $right) {
    $t = partition($arr, $left, $right);
    quick_sort($arr, $left, $t - 1);
    quick_sort($arr, $t + 1, $right);
  }
}

echo "<br><strong>Quick sort</strong>";
echo "<br>";
var_dump($a);
echo "<br>";
quick_sort($a, 0, count($a) - 1);
var_dump($a);