<?php

// ТРЕЙТ зі спільними методами
trait CarTrait {
    public function show() {
        echo "Марка: {$this->brand}, Циліндрів: {$this->cylinders}, Потужність: {$this->power} к.с., Пробіг: {$this->mileage} км<br>";
    }

    public function search($brand) {
        return $this->brand === $brand;
    }

    public static function show_objects($cars) {
        foreach ($cars as $car) {
            $car->show();
        }
    }
}

// ІНТЕРФЕЙС продукту
interface ICar {
    public function get(): array;
}

// БАЗОВИЙ клас Car
abstract class Car6 implements ICar {
    use CarTrait; // підключаємо трейти

    public $brand;
    public $cylinders;
    public $power;
    protected $mileage;

    public function __construct($brand = "", $cylinders = 0, $power = 0, $mileage = 0) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        $this->mileage = $mileage;
    }

    public function get(): array {
        return [
            "brand" => $this->brand,
            "cylinders" => $this->cylinders,
            "power" => $this->power,
            "mileage" => $this->mileage
        ];
    }
}

// КОНКРЕТНІ класи автомобілів
class UACar extends Car6 {
    public function __construct() {
        parent::__construct("ЗАЗ", 4, 95, 80000);
    }
}

class ForeignCar extends Car6 {
    public function __construct() {
        parent::__construct("BMW", 6, 250, 60000);
    }
}

// АБСТРАКТНА ФАБРИКА
abstract class AbstractCarFactory {
    abstract public function createCar(): Car6;
}

// ВІТЧИЗНЯНА фабрика
class UkrainianCarFactory extends AbstractCarFactory {
    public function createCar(): Car6 {
        return new UACar();
    }
}

// ЗАРУБІЖНА фабрика
class ForeignCarFactory extends AbstractCarFactory {
    public function createCar(): Car6 {
        return new ForeignCar();
    }
}

// КЛАС автопарку
class CarPark {
    private $cars = [];

    public function addCar(Car6 $car) {
        $this->cars[] = $car;
    }

    public function showAll() {
        echo "<b>Склад автопарку:</b><br>";
        Car6::show_objects($this->cars);
        echo "<br>";
    }
}

// ІМІТАЦІЯ конфігураційного файлу
$config = [
    "factory" => "ua",   // ua або foreign
    "carNum" => 3
];

// ОСНОВНА ЛОГІКА
echo "<b>=== Демонстрація роботи з патерном Abstract Factory ===</b><br><br>";

if ($config['factory'] === 'ua') {
    $factory = new UkrainianCarFactory();
    echo "Створюємо парк вітчизняних автомобілів:<br>";
} else {
    $factory = new ForeignCarFactory();
    echo "Створюємо парк зарубіжних автомобілів:<br>";
}

$park = new CarPark();

// Створюємо задану кількість автомобілів
for ($i = 0; $i < $config['carNum']; $i++) {
    $park->addCar($factory->createCar());
}

// Виводимо всі автомобілі
$park->showAll();

// Зміна фабрики 
echo "<hr>";
echo "Тепер змінюємо фабрику на зарубіжну:<br>";

$foreignFactory = new ForeignCarFactory();
$foreignPark = new CarPark();

for ($i = 0; $i < 2; $i++) {
    $foreignPark->addCar($foreignFactory->createCar());
}

$foreignPark->showAll();
?>