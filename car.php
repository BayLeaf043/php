<?php

// Абстрактний клас
abstract class Car {

    private $brand;
    private $cylinders;
    private $power;
    private $mileage;

    public function __construct($brand = "", $cylinders = 0, $power = 0, $mileage = 0) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        $this->mileage = $mileage;
    }

    // Абстрактний метод 
    abstract public function show();

    public function info() {
        echo "Марка: {$this->brand}, Циліндрів: {$this->cylinders}, Потужність: {$this->power} к.с., Пробіг: {$this->mileage} км<br>";
    }
}

// Перший трейт — для роботи з паливом
trait FuelTrait {
    public function fuelType($type) {
        echo "Тип палива: {$type}<br>";
    }
}

// Другий трейт — для інформації про водія
trait DriverTrait {
    public function driverInfo($name, $experience) {
        echo "Водій: {$name}, досвід: {$experience} років<br>";
    }
}

// Клас легкового автомобіля
class PassengerCar extends Car {

    use FuelTrait, DriverTrait; // Використовуємо обидва трейти

    private $seats;

    public function __construct($brand, $cylinders, $power, $mileage, $seats) {
        parent::__construct($brand, $cylinders, $power, $mileage);
        $this->seats = $seats;
    }

    // Реалізація абстрактного методу
    public function show() {
        echo "Тип: Легковий автомобіль, кількість місць: {$this->seats}<br>";
        $this->info();
    }
}

// Клас вантажного автомобіля
class Truck extends Car {

    use FuelTrait, DriverTrait; // Також використовуємо два трейти

    private $capacity;

    public function __construct($brand, $cylinders, $power, $mileage, $capacity) {
        parent::__construct($brand, $cylinders, $power, $mileage);
        $this->capacity = $capacity;
    }

    // Реалізація абстрактного методу
    public function show() {
        echo "Тип: Вантажний автомобіль, вантажопідйомність: {$this->capacity} т<br>";
        $this->info();
    }
}

// Демонстрація роботи з класами

$car1 = new PassengerCar("Toyota", 4, 120, 85000, 5);
$car2 = new Truck("Volvo", 6, 400, 220000, 15);

$car1->show();
$car1->fuelType("Бензин");
$car1->driverInfo("Олександр", 5);
echo "<hr>";
$car2->show();
$car2->fuelType("Дизель");
$car2->driverInfo("Іван", 10);

?>
