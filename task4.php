<?php
// Клас-прототип 
class CarPrototype {
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

    // Метод клонування 
    public function __clone() {
        $this->mileage = 0;
    }
}

// Використання шаблону Prototype 

// Створюємо прототип
$prototypeCar = new CarPrototype("BMW", 6, 250, 120000);

// Клонуємо кілька копій із невеликими змінами
$car1 = clone $prototypeCar;
$car1->set("BMW", 6, 250, 10000);

$car2 = clone $prototypeCar;
$car2->set("BMW", 6, 250, 5000);

$car3 = clone $prototypeCar;
$car3->set("BMW", 6, 250, 20000);

// Виводимо результати
echo "<b>Демонстрація шаблону Prototype</b><br>";
$prototypeCar->show();
$car1->show();
$car2->show();
$car3->show();

// Масив з нових авто (створених через клонування)
$cars = [];
for ($i = 0; $i < 5; $i++) {
    $newCar = clone $prototypeCar;
    $newCar->set("BMW", 6, 250, rand(1000, 20000)); // різний пробіг
    $cars[] = $newCar;
}

echo "<br><b>Масив автомобілів, створених через Prototype:</b><br>";
CarPrototype::show_objects($cars);
?>