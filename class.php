<?php
class Car {
    // Публічні поля 
    public $brand;        
    public $cylinders;     
    public $power;        

    // Приватне поле 
    private $mileage;

    // Конструктор
    public function __construct($brand = "", $cylinders = 0, $power = 0, $mileage = 0) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        $this->mileage = $mileage;
    }

    // Метод set() 
    public function set($brand, $cylinders, $power, $mileage) {
        $this->brand = $brand;
        $this->cylinders = $cylinders;
        $this->power = $power;
        $this->mileage = $mileage;
    }

    // Метод get() 
    public function get() {
        return [
            "brand" => $this->brand,
            "cylinders" => $this->cylinders,
            "power" => $this->power,
            "mileage" => $this->mileage
        ];
    }

    // Метод show() 
    public function show() {
        echo "Марка: {$this->brand}, Циліндрів: {$this->cylinders}, Потужність: {$this->power} к.с., Пробіг: {$this->mileage} км<br>";
    }

    // Метод search() 
    public function search($brand) {
        return $this->brand === $brand;
    }

    // Приватний метод (доступний тільки зсередини класу)
    private function secretMessage() {
        return "Цей метод приватний!";
    }

    // Метод для демонстрації виклику приватного методу
    public function showSecret() {
        echo $this->secretMessage() . "<br>";
    }

    // Статичний метод для показу масиву об'єктів
    public static function show_objects($cars) {
        foreach ($cars as $car) {
            $car->show();
        }
    }
}



// 1. Створення 3 об'єктів
$car1 = new Car("BMW", 6, 250, 120000);
$car2 = new Car("Toyota", 4, 150, 90000);
$car3 = new Car("Mercedes", 8, 400, 50000);

// 2. Виклик show()
echo ("Створення 3 об'єктів. Виклик show()<br>");
$car1->show();
$car2->show();
$car3->show();
echo "<br>";

// 3. Використання search()
echo ("Використання search()<br>");
echo ($car2->search("Toyota") ? "Знайдено Toyota<br>" : "Не знайдено<br>");
echo "<br>";


// 4. Виклик приватного методу через публічний
echo ("Виклик приватного методу через публічний<br>");
$car1->showSecret();
echo "<br>";

// 5. Масив з 5 об'єктів
$cars = [
    new Car("Audi", 4, 180, 70000),
    new Car("Honda", 4, 130, 60000),
    new Car("Ford", 6, 200, 85000),
    new Car("Lexus", 6, 300, 40000),
    new Car("Mazda", 4, 160, 50000)
];

// 6. Виведення масиву об'єктів
echo ("Виведення масиву об'єктів<br>");
Car::show_objects($cars);
?>