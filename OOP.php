<?php

class Person {
  public $name;
  protected $age;
  public static $country = "Viet Nam";

  function __construct($name, $age) {
    $this->name = $name;
    $this->age = $age;
  }

  function greeting() {
    echo "Hello, I'm {$this->name}, I'm {$this->age} years old, and I'm from " . self::$country;
  }
}

$person_1 = new Person("Teo", 10);
print_r($person_1);
echo "<br>";
$person_1->greeting();
echo "<br>", $person_1->name;
// echo "<br>", $person_1->age; //error
echo "<br>", Person::$country;

class Student extends Person {
  public $class;
  function __construct($name, $age, $class) {
    parent::__construct($name, $age);
    $this->class = $class;
  }
}

$student_1 = new Student("Ty", 12, "8A");
echo "<br>";
$student_1->greeting();



// strategy pattern
interface FlyBehavior {
  function fly();
}

class NoFlyBehavior implements FlyBehavior {
  function fly() {
    echo "Tôi không biết bay";
  }
}

class HightFlyBehavior implements FlyBehavior {
  function fly() {
    echo "Tôi bay rất cao";
  }
}

interface SwimBehavior {
  function swim();
}

class NoSwimBehavior implements SwimBehavior {
  function swim() {
    echo "Tôi không biết bơi";
  }
}

class GoodSwimBehavior implements SwimBehavior {
  function swim() {
    echo "Tôi bơi rất giỏi";
  }
}

abstract class Duck {
  public $name;
  public $fly_behavior;
  public $swim_behavior;

  function __construct($name) {
    $this->name = $name;
  }

  abstract function greeting();

  function set_fly_behavior($fly_behavior) {
    $this->fly_behavior = $fly_behavior;
  }

  function set_swim_behavior($swim_behavior) {
    $this->swim_behavior = $swim_behavior;
  }

  function fly() {
    $this->fly_behavior->fly();
  }

  function swim() {
    $this->swim_behavior->swim();
  }
}

class VitCo extends Duck {
  public function greeting() {
    echo "Hello, tôi tên là {$this->name}, tôi là vị cỏ";
  }
}
class VitTroi extends Duck {
  public function greeting() {
    echo "Hello, tôi tên là {$this->name}, tôi là vị trời";
  }
}

echo "<br>";
$duck_1 = new VitCo("Ty");
$duck_1->greeting();
$duck_1->set_fly_behavior(new NoFlyBehavior());
$duck_1->set_swim_behavior(new GoodSwimBehavior());
$duck_1->fly();
$duck_1->swim();

echo "<br>";

$duck_2 = new VitTroi("Teo");
$duck_2->greeting();
$duck_2->set_fly_behavior(new HightFlyBehavior());
$duck_2->set_swim_behavior(new NoSwimBehavior());
$duck_2->fly();
$duck_2->swim();