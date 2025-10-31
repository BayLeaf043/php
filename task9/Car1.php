<?php
// Інтерфейс, який визначає стандарт взаємодії 
interface CarInterface {
    public function show();
    public function get();
    public function set($brand, $power, $extra);
}

// Клас звичайного автомобіля 
class Car1 implements CarInterface {
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

    public function set($brand, $power, $extra) {
        $this->brand = $brand;
        $this->power = $power;
        $this->cylinders = $extra; // extra — це кількість циліндрів
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
}

// Новий клас ElectricCar
class ElectricCar {
    private $model;
    private $batteryCapacity; // кВт·год
    private $power; // к.с.

    public function __construct($model, $batteryCapacity, $power) {
        $this->model = $model;
        $this->batteryCapacity = $batteryCapacity;
        $this->power = $power;
    }

    public function chargeBattery() {
        echo "Акумулятор моделі {$this->model} заряджено (ємність {$this->batteryCapacity} кВт·год)<br>";
    }

    public function showInfo() {
        echo "Електромобіль {$this->model}, потужність {$this->power} к.с., батарея {$this->batteryCapacity} кВт·год<br>";
    }

    public function getElectricSpecs() {
        return [
            "model" => $this->model,
            "batteryCapacity" => $this->batteryCapacity,
            "power" => $this->power
        ];
    }
}

// АДАПТЕР, який дозволяє ElectricCar поводитись як звичайний Car 
class ElectricCarAdapter implements CarInterface {
    private $electricCar;

    public function __construct(ElectricCar $electricCar) {
        $this->electricCar = $electricCar;
    }

    public function show() {
        $this->electricCar->showInfo();
    }

    public function get() {
        return $this->electricCar->getElectricSpecs();
    }

    public function set($brand, $power, $extra) {
        // extra тут — ємність батареї
        $this->electricCar = new ElectricCar($brand, $extra, $power);
    }
}

// Тестування 
echo "<h3>Звичайні автомобілі</h3>";
$car1 = new Car1("BMW", 6, 250, 120000);
$car2 = new Car1("Toyota", 4, 150, 90000);
$car1->show();
$car2->show();

echo "<h3>Електромобілі через адаптер</h3>";
$tesla = new ElectricCar("Tesla Model S", 100, 670);
$adapter = new ElectricCarAdapter($tesla);
$adapter->show(); // Виклик через адаптер

// Новий електромобіль через єдиний інтерфейс CarInterface
$newAdapter = new ElectricCarAdapter(new ElectricCar("", 0, 0));
$newAdapter->set("Nissan Leaf", 150, 40);
$newAdapter->show();

?>