<?php
// Інтерфейс фабрики
interface Factory1 {
    public function getProduct($brand, $cylinders, $power, $mileage);
}

// Інтерфейс продукту
interface Product1 {
    public function show();
    public function get();
}

// Клас Car реалізує інтерфейс Product
class Car1 implements Product1 {
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

// Конкретна фабрика для створення автомобілів
class CarFactory1 implements Factory1 {
    public function getProduct($brand, $cylinders, $power, $mileage) {
        return new Car1($brand, $cylinders, $power, $mileage);
    }
}

// Демонстрація роботи
echo "<h3>Демонстрація роботи патерну Factory Method</h3>";

// Створюємо фабрику
$factory = new CarFactory1();

// Створюємо об’єкти через фабрику
$car1 = $factory->getProduct("BMW", 6, 250, 120000);
$car2 = $factory->getProduct("Toyota", 4, 150, 90000);
$car3 = $factory->getProduct("Mercedes", 8, 400, 50000);

// Виклик show()
echo "Створення об'єктів через фабрику. Виклик show():<br>";
$car1->show();
$car2->show();
$car3->show();
echo "<br>";

// Масив об’єктів, створених через фабрику
$cars = [
    $factory->getProduct("Audi", 4, 180, 70000),
    $factory->getProduct("Honda", 4, 130, 60000),
    $factory->getProduct("Ford", 6, 200, 85000),
    $factory->getProduct("Lexus", 6, 300, 40000),
    $factory->getProduct("Mazda", 4, 160, 50000)
];

echo "Виведення масиву об'єктів через фабрику:<br>";
Car1::show_objects($cars);
?>
