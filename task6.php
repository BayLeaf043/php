<?php
// Клас Product — Car
class Car {
    public $brand;
    public $cylinders;
    public $power;
    private $mileage;

    public function __construct($brand = "", $cylinders = 0, $power = 0, $mileage = 0) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        $this->mileage = $mileage;
    }

    public function set($brand, $cylinders, $power, $mileage) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        $this->mileage = $mileage;
    }

    public function get() {
        return [
            "brand" => $this->brand,
            "cylinders" => $this->cylinders,
            "power" => $this->power,
            "mileage" => $this->mileage
        ];
    }

    public function show() {
        echo "Марка: {$this->brand}, Циліндрів: {$this->cylinders}, Потужність: {$this->power} к.с., Пробіг: {$this->mileage} км<br>";
    }

    public function search($brand) {
        return $this->brand === $brand;
    }

    private function secretMessage() {
        return "Цей метод приватний!";
    }

    public function showSecret() {
        echo $this->secretMessage() . "<br>";
    }

    public static function show_objects($cars) {
        foreach ($cars as $car) {
            $car->show();
        }
    }
}

// Клас Factory (створює екземпляри класу Car)
class CarFactory {
    public static function create($brand, $cylinders, $power, $mileage) {
        return new Car($brand, $cylinders, $power, $mileage);
    }
}

// Створення об'єктів через Factory
echo ("Створення 3 об'єктів через Factory<br>");
$car1 = CarFactory::create("BMW", 6, 250, 120000);
$car2 = CarFactory::create("Toyota", 4, 150, 90000);
$car3 = CarFactory::create("Mercedes", 8, 400, 50000);

$car1->show();
$car2->show();
$car3->show();
echo "<br>";

// Використання search()
echo ("Використання search()<br>");
echo ($car2->search("Toyota") ? "Знайдено Toyota<br>" : "Не знайдено<br>");
echo "<br>";

// Виклик приватного методу через публічний
echo ("Виклик приватного методу через публічний<br>");
$car1->showSecret();
echo "<br>";

// Масив об'єктів, створених через Factory
$cars = [
    CarFactory::create("Audi", 4, 180, 70000),
    CarFactory::create("Honda", 4, 130, 60000),
    CarFactory::create("Ford", 6, 200, 85000),
    CarFactory::create("Lexus", 6, 300, 40000),
    CarFactory::create("Mazda", 4, 160, 50000)
];

// Виведення масиву об'єктів
echo ("Виведення масиву об'єктів<br>");
Car::show_objects($cars);
?>