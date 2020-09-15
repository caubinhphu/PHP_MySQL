<?php

echo "Hello World";

// basic
// array
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
print_r($a);
echo "<br>";
print_r(selection_sort($a));


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
print_r($a);
echo "<br>";
print_r(insert_sort($a));


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
print_r($a);
echo "<br>";
print_r(bubble_sort($a));

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
print_r($a);
echo "<br>";
quick_sort($a, 0, count($a) - 1);
print_r($a);

// array method
echo "<br><br><strong>Array method</strong>";
echo "<br>sort: ";
$arr1 = array(4, -3, 1, 2, 4);
// sort method
sort($arr1);
print_r($arr1);

echo "<br>asort: ";
$arr2 = array("Teo" => 12, "Ty" => 11);
// sort by value
asort($arr2);
print_r($arr2);

echo "<br>usort: ";
$arr3 = array("Teo" => 12, "Ty" => 11, "Nam" => 9, "Tet" => 10);
// sort by function callback
usort($arr3, function($a, $b) {
  return $a - $b;
});
print_r($arr3);
// object
class Person {
  public $name;
  public $age;
  function __construct($name, $age) {
    $this->name = $name;
    $this->age = $age;
  }
}
echo "<br>";
$arrObj = [new Person("Ty", 12), new Person("Teo", 14)];
array_push($arrObj, new Person("Tet", 10), new Person($name = "Tom", $age = 11));
print_r($arrObj);
// sort array obj
usort($arrObj, function($a, $b) {
  return $a->age - $b->age;
});
echo "<br>";
print_r($arrObj);

echo "<br>map: ";
// map method
print_r(array_map(function($x) {
  return $x ** 2;
}, [1, 2, 3, 4]));

echo "<br>filter: ";
// filter method
print_r(array_filter([1, 2, 3, 4, 5], function($x) {
  return $x % 2;
}));
echo "<br>list: ";
// list method == Destructuring (js)
list($a, $b, $c) = array(4, 1, 6);
echo "<br>", $a, "<br>", $b, "<br>", $c;
// vâng vâng và mây mây
// ..................



// string
echo "<br><br><strong>String</strong>";
echo "<br>string: ";
$str = 'Hello World';
$name = 'Hai';
// concat str, template string
echo $str . ". Hello $name";

// string method
echo "<br>explode: ";
// explode method == split method (js) => (str => array str)
$xx = array_map("trim", explode(",", "Hello     ,      World"));
print_r($xx);
var_dump($xx[0] === "Hello");
echo "<br>join: ";
// join method (array str => str)
echo join(" ", ['Hello','World!','Beautiful','Day!']);
// parse_str: Parse a query string into variables
echo "<br>parse_str: ";
parse_str("name=Peter&age=43");
echo $name."<br>";
echo $age;
// replace
echo "<br>replace: ";
echo str_replace("world","Peter","Hello world!");
// substr
echo "<br>replace: ";
echo substr("Hello world",2, 3);
// str_split
echo "<br>str_split: ";
print_r(str_split("Hello", 2));
// vâng vâng và mây mây 
// ..................

// loop
// foreach
echo "<br><br><strong>Foreach</strong>";
$ages = array("Ty"=>"12", "Teo"=>"13", "Tet"=>"10");

echo "<br>";
foreach($ages as $x => $val) {
  echo "age of $x is $val<br>";
}
foreach($ages as $age) {
  print_r($age);
}
echo "<br>";
$arr_num = array(3, 5, 3, 1, -1, 4);
foreach($arr_num as $index => $value) {
  echo "[$index] = $value" . "<br>";
}
// spread operator
print_r([...$arr_num]);

// function: rest parameters
function sum(...$nums) {
  // nums[0] = [1, 4, 5, 3, 4, 3]
  
  // return (array_sum($nums[0]));
  return array_reduce($nums[0], function($acc, $cur) {
    return $acc + $cur;
  }, 0);
}
echo "<br>";
echo sum([1, 4, 5, 3, 4, 3]);