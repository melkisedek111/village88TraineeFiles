<?php


class Car {
    public $price;
    public $speed;
    public $fuel;
    public $mileage;
    public $tax;

    public function __construct($price, $speed, $fuel, $mileage)
    {
        $this->price = $price;
        $this->speed = $speed;
        $this->fuel = $fuel;
        $this->mileage = $mileage;
        $this->tax = $price >= 10000 ? .15 : .12;
        $this->display_all();
    }

    public function display_all() {
        echo "
            Price: {$this->price} <br>
            Speed: {$this->speed} <br>
            Fuel: {$this->fuel} <br>
            Mileage: {$this->mileage} <br>
            Tax: {$this->tax} <br><br>
        ";
    }
}
$car1 = new Car(10000, "100mph", "Full", "25mpg");
$car2 = new Car(8500, "70mph", "Not Full", "33mpg");
$car3 = new Car(7500, "85mph", "Not Full", "85mpg");
$car4 = new Car(9800, "95mph", "Full", "45mpg");
$car5 = new Car(120000, "120mph", "Full", "15mpg");
$car6 = new Car(13000, "105mph", "Full", "52mpg");