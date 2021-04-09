<?php


class Bike
{
    public $price;
    public $max_speed;
    public $miles;

    public function __construct($price, $max_speed)
    {
        $this->price = $price;
        $this->max_speed = $max_speed;
        $this->miles = 0;
    }



    public function display_info() {
        echo $this->price . '<br>';
        echo $this->max_speed . '<br>';
        echo $this->miles . '<br>';
    }

    public function drive() {
        echo "Driving <br>";
        $this->miles += 10;
        return $this;
    }

    public function reverse() {
        echo "Reversing  <br>";
        if($this->miles < 1) {
            $this->miles = 0;
        } else {
            $this->miles -= 5;
        }
        return $this;
    }
}

$driver1 = new Bike(100000, 135);
$driver1->drive()->drive()->drive()->reverse()->display_info();
// $driver1->drive();
// $driver1->drive();
// $driver1->drive();
// $driver1->reverse();
// $driver1->display_info();

$driver2 = new Bike(95000, 100);
$driver2->drive()->reverse()->reverse()->display_info();
// $driver2->drive();
// $driver2->reverse();
// $driver2->reverse();
// $driver2->display_info();

$driver3 = new Bike(150000, 155);
$driver3->reverse()->reverse()->reverse()->display_info();
// $driver3->reverse();
// $driver3->reverse();
// $driver3->display_info();
