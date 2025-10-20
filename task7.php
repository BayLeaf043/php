<?php
// Базовий клас Транспортний засіб
abstract class Vehicle {
    protected $country;       
    protected $brand;         
    protected $year;          

    public function __construct($country, $brand, $year) {
        $this->country = $country;
        $this->brand = $brand;
        $this->year = $year;
    }

    // метод для відображення інформації
    public function showInfo() {
        echo "Країна: {$this->country}, Марка: {$this->brand}, Рік: {$this->year}";
    }
}

// Підклас Автомобіль
class Car extends Vehicle {
    private $engine;
    private $power;
    private $color;

    public function __construct($country, $brand, $year, $engine, $power, $color) {
        parent::__construct($country, $brand, $year);
        $this->engine = $engine;
        $this->power = $power;
        $this->color = $color;
    }

    public function showInfo() {
        parent::showInfo();
        echo ", Двигун: {$this->engine}, Потужність: {$this->power} к.с., Колір: {$this->color}<br>";
    }
}

// Підклас Велосипед
class Bike extends Vehicle {
    private $weight;
    private $type;
    private $wheelDiameter;

    public function __construct($country, $brand, $year, $weight, $type, $wheelDiameter) {
        parent::__construct($country, $brand, $year);
        $this->weight = $weight;
        $this->type = $type;
        $this->wheelDiameter = $wheelDiameter;
    }

    public function showInfo() {
        parent::showInfo();
        echo ", Вага: {$this->weight} кг, Тип: {$this->type}, Діаметр колеса: {$this->wheelDiameter} дюймів<br>";
    }
}

// Підклас Мотоцикл
class Motorcycle extends Vehicle {
    private $engine;
    private $color;
    private $type;

    public function __construct($country, $brand, $year, $engine, $color, $type) {
        parent::__construct($country, $brand, $year);
        $this->engine = $engine;
        $this->color = $color;
        $this->type = $type;
    }

    public function showInfo() {
        parent::showInfo();
        echo ", Двигун: {$this->engine}, Колір: {$this->color}, Тип: {$this->type}<br>";
    }
}

// Фабрика для створення транспортних засобів
class VehicleFactory {
    public static function create($type, ...$params) {
        switch (strtolower($type)) {
            case "car":
                return new Car(...$params);
            case "bike":
                return new Bike(...$params);
            case "motorcycle":
                return new Motorcycle(...$params);
            default:
                echo "Помилка: фабрика не може створити транспортний засіб типу '{$type}'!<br>";
                return null;
        }
    }
}

// Демонстрація роботи
echo "<h3>Демонстрація шаблону Factory</h3>";

// Створення об'єктів за допомогою фабрики
$car = VehicleFactory::create("car", "Німеччина", "BMW", 2022, "Бензиновий", 250, "Чорний");
$bike = VehicleFactory::create("bike", "Італія", "Bianchi", 2021, 12, "Гірський", 28);
$motorcycle = VehicleFactory::create("motorcycle", "Японія", "Yamaha", 2023, "Бензиновий", "Синій", "Спортивний");

// Невідомий тип — помилка
$bus = VehicleFactory::create("bus", "Україна", "Богдан", 2020, "Дизель", 150, "Білий");

echo "<br><strong>Інформація про транспортні засоби:</strong><br>";

echo "<br> Машина: ";
$car->showInfo();
echo "<br> Велосипед: ";
$bike->showInfo();
echo "<br> Мотоцикл: ";
$motorcycle->showInfo();
?>