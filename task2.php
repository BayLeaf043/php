<?php
// Клас - Машина
class Car {
    private $brand;        
    private $cylinders;     
    private $power;        

    // Статичне поле – лічильник створених об’єктів
    protected static $count = 0;

    // Конструктор
    public function __construct($brand = "", $cylinders = 0, $power = 0) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        self::$count++;   // збільшення лічильника при створенні нового об’єкта
    }

    // Деструктор
    public function __destruct() {
        echo "{$this->brand} видалено<br>";
    }
   
    // Метод виведення інформації
    public function show() {
        echo "Марка: {$this->brand}<br>";
        echo "Кількість циліндрів: {$this->cylinders}<br>";
        echo "Потужність: {$this->power} к.с.<br>";
    }

    // Статичний метод для отримання кількості створених об'єктів
    public static function getCount() {
        return self::$count;
    }
}

// Похідний клас – Вантажівка
class Truck extends Car {
    private $capacity;  

    public function __construct($brand, $cylinders, $power, $capacity) {
        parent::__construct($brand, $cylinders, $power);
        $this->capacity = $capacity;
    }

    // Перевизначений метод виведення інформації
    public function show() {
        parent::show();
        echo "Вантажопідйомність кузова: {$this->capacity} кг<br>";
    }
}

// Створення об'єктів та демонстрація роботи
$car = new Car("Toyota", 4, 150);
echo "<h3>Інформація про машину:</h3>";
$car->show(); 

echo "<hr>";

$truck = new Truck("Volvo", 8, 400, 12000);
echo "<h3>Інформація про вантажівку:</h3>";
$truck->show();

echo "<hr>";

// Виклик статичного методу
echo "<h3>Кількість створених транспортних засобів: " . Car::getCount() . "</h3>";

echo "<hr>";



?>


