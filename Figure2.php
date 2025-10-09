<?php

// Інтерфейс Figure
interface Figure2 {
    public function draw();  
    public function erase();  
    public function move($x, $y);  
    public function getColor();  
    public function setColor($color);  
}

// Клас Circle
class Circle implements Figure2 {

    private $color;
    private $x;
    private $y;

    public function __construct($x = 0, $y = 0, $color = "чорний") {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }

    public function draw() {
        echo "Малюємо коло<br>";
        echo "Колір: " . $this->color . "<br>";
        echo "Координати центру: ($this->x, $this->y)<br>";
    }

    public function erase() {
        echo "Стираємо коло<br>";
    }

    public function move($x, $y) {
        $this->x = $x;
        $this->y = $y;
        echo "Коло переміщено. Координати центру ($x, $y)<br>";
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
        echo "Колір кола встановлено `$color`<br>";
    }
}


// Клас Square
class Square implements Figure2 {

    private $color;
    private $x;
    private $y;

    public function __construct($x = 0, $y = 0, $color = "чорний") {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }
    public function draw() {
        echo "Малюємо квадрат<br>";
        echo "Колір: " . $this->color . "<br>";
        echo "Координати центру: ($this->x, $this->y)<br>";
    }

    public function erase() {
        echo "Стираємо квадрат<br>";
    }

    public function move($x, $y) {
        $this->x = $x;
        $this->y = $y;
        echo "Квадрат переміщено. Координати центру ($x, $y)<br>";
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
        echo "Колір квадрата встановлено `$color`<br>";
    }
}

// Клас Triangle
class Triangle implements Figure2 {

    private $color;
    private $x;
    private $y;

    public function __construct($x = 0, $y = 0, $color = "чорний") {
        $this->x = $x;
        $this->y = $y;
        $this->color = $color;
    }

    public function draw() {
        echo "Малюємо трикутник<br>";
        echo "Колір: " . $this->color . "<br>";
        echo "Координати центру: ($this->x, $this->y)<br>";
    }

    public function erase() {
        echo "Стираємо трикутник<br>";
    }

    public function move($x, $y) {
        $this->x = $x;
        $this->y = $y;
        echo "Трикутник переміщено. Координати центру ($x, $y)<br>";
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
        echo "Колір трикутника встановлено `$color`<br>";
    }
}

// Демонстрація роботи
$circle = new Circle();
$circle->draw();
$circle->setColor("червоний");
$circle->move(5, 10);
$circle->erase();

echo "<hr>";

$square = new Square();
$square->draw();
$square->setColor("синій");
$square->move(2, 4);
$square->erase();

echo "<hr>";

$triangle = new Triangle();
$triangle->draw();
$triangle->setColor("зелений");
$triangle->move(1, 8);
$triangle->erase();

?>