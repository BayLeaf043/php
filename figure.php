<?php

// Абстрактний клас
abstract class Figure { 

    // координати центру
    protected $x; 
    protected $y; 

    public function __construct($x, $y) {
        $this->x = $x;
        $this->y = $y;
    }
    
    // Абстрактний метод
    abstract public function area();

    //Звичайний метод для виводу координат
    public function showCenter() {
        echo "Координати центру: (X: $this->x, Y: $this->y)<br>";
    }

}  

// Клас Коло
class Circle extends Figure { 
    
    private $radius;

    public function __construct($x, $y, $radius) {
        parent::__construct($x, $y);
        $this->radius = $radius;
    }
    
    public function area() {
        $area = pi() * pow($this->radius, 2);
        echo "Площа кола: " . round($area, 2) . "<br>";
    }
} 

// Клас Прямокутник
class Rectangle extends Figure {  

    private $width;
    private $height;

    public function __construct($x, $y, $width, $height) {
        parent::__construct($x, $y);
        $this->width = $width;
        $this->height = $height;
    }
    
    public function area() {
        $area = $this->width * $this->height;
        echo "Площа прямокутника: $area<br>";
    }
}  

// Демонстрація роботи з класами

$circle = new Circle(5, 10, 4);
$circle->showCenter();
$circle->area();

echo "<hr>";

$rectangle = new Rectangle(0, 0, 6, 3);
$rectangle->showCenter();
$rectangle->area();

?>