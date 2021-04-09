<?php

class Animal
{
    public $name;
    public $health;
    
    public function __construct($name)
    {
        $this->name = $name;
        $this->health = 100;
    }

    public function walk()
    {
        $this->health -= 1;
    }

    public function run()
    {
        $this->health -= 5;
    }

    public function displayHealth()
    {
        echo "Name: $this->name <br>";
        echo "Health: $this->health <br>";
    }
}


class Dog extends Animal {
    public function __construct($name) {
        parent::__construct($name);
        $this->health = 150;
    }
    public function pet() {
        $this->health += 5;
    }
}

class Dragon extends Animal {

    public function __construct($name) {
        parent::__construct($name);
        $this->health = 170;
    }
    public function fly() {
        $this->health -= 10;
    }

    public function displayHealth()
    {
        echo "This is a Dragon <br>";
        parent::displayHealth();
    }
}

$John = new Animal("John");
$John->walk();
$John->walk();
$John->walk();
$John->run();
$John->run();
$John->displayHealth();


$Bruno = new Dog("Bruno");
$Bruno->walk();
$Bruno->walk();
$Bruno->walk();
$Bruno->run();
$Bruno->run();
$Bruno->pet();
$Bruno->displayHealth();

$Toothless = new Dragon('Toothless');
$Toothless->walk();
$Toothless->walk();
$Toothless->walk();
$Toothless->run();
$Toothless->run();
$Toothless->fly();
$Toothless->fly();
$Toothless->displayHealth();