<?php
// Інтерфейс для технічної інформації
interface ITechnical {
    public function showInfo();       // метод виведення інформації
}

// Інтерфейс для обслуговування
interface IService {
    public function startEngine();    // запустити двигун
    public function stopEngine();     // зупинити двигун
}

// Клас Car реалізує обидва інтерфейси
class Car2 implements ITechnical, IService {

    protected $brand;
    protected $cylinders;
    protected $power;

    public function __construct($brand, $cylinders, $power) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
    }

    public function __destruct() {
        echo "Об’єкт {$this->brand} знищено.<br>";
    }

    // Реалізація з ITechnical
    public function showInfo() {
        echo "Марка: {$this->brand}, Циліндрів: {$this->cylinders}, Потужність: {$this->power} к.с.<br>";
    }

    // Реалізація з IService
    public function startEngine() {
        echo "Двигун {$this->brand} запущено.<br>";
    }

    public function stopEngine() {
        echo "Двигун {$this->brand} зупинено.<br>";
    }
}

// Похідний клас Truck (вантажівка)
class Truck extends Car2 {
    
    private $capacity;

    public function __construct($brand, $cylinders, $power, $capacity) {
        parent::__construct($brand, $cylinders, $power);
        $this->capacity = $capacity;
    }

    // Перевизначаємо showInfo() для розширеної інформації
    public function showInfo() {
        parent::showInfo();
        echo "Вантажопідйомність: {$this->capacity} т<br>";
    }
}

// Демонстрація роботи
$car = new Car2("Toyota", 4, 150);
$car->showInfo();
$car->startEngine();
$car->stopEngine();

echo "<hr>";

$truck = new Truck("Volvo", 6, 400, 10);
$truck->showInfo();
$truck->startEngine();
$truck->stopEngine();

echo "<hr>";
?>