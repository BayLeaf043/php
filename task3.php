<?php
// клас Car (без змін)
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
        echo "Марка: {$this->brand}, Циліндрів: {$this->cylinders}, Потужність: {$this->power} к.с., Пробіг: {$this->get()['mileage']} км<br>";
    }

    public function search($brand) { return $this->brand === $brand; }

    private function secretMessage() { return "Цей метод приватний!"; }

    public function showSecret() { echo $this->secretMessage() . "<br>"; }

    public static function show_objects($cars) { foreach ($cars as $car) { $car->show(); } }
}

// Chain of Responsibility для фільтрації авто
abstract class CarHandler {
    protected ?CarHandler $next = null;

    public function setNext(CarHandler $next): CarHandler {
        $this->next = $next;
        return $next;
    }

    public function handle(Car $car, array $criteria): bool {
        // Поточний критерій пройдено?
        if (!$this->process($car, $criteria)) {
            return false; // не підходить — зупиняємось
        }
        // Якщо наступного немає — успіх
        if ($this->next === null) {
            return true;
        }
        // Інакше — передаємо далі
        return $this->next->handle($car, $criteria);
    }

    abstract protected function process(Car $car, array $criteria): bool;
}

// 1) Перевірка бренду
class BrandHandler extends CarHandler {
    protected function process(Car $car, array $criteria): bool {
        if (!isset($criteria['brand']) || $criteria['brand'] === '') {
            return true; // критерій не задано — пропускаємо
        }
        if ($car->brand === $criteria['brand']) {
            return true;
        }
        return false;
    }
}

// 2) Мінімальна кількість циліндрів
class CylindersMinHandler extends CarHandler {
    protected function process(Car $car, array $criteria): bool {
        if (!isset($criteria['min_cylinders'])) return true;
        return $car->cylinders >= (int)$criteria['min_cylinders'];
    }
}

// 3) Мінімальна потужність
class PowerMinHandler extends CarHandler {
    protected function process(Car $car, array $criteria): bool {
        if (!isset($criteria['min_power'])) return true;
        return $car->power >= (int)$criteria['min_power'];
    }
}

// 4) Максимальний пробіг
class MileageMaxHandler extends CarHandler {
    protected function process(Car $car, array $criteria): bool {
        if (!isset($criteria['max_mileage'])) return true;
        $mileage = $car->get()['mileage']; // пробіг приватний — беремо через get()
        return $mileage <= (int)$criteria['max_mileage'];
    }
}


$car1 = new Car("BMW",      6, 250, 120000);
$car2 = new Car("Toyota",   4, 150,  90000);
$car3 = new Car("Mercedes", 8, 400,  50000);

$cars = [
    new Car("Audi",    4, 180,  70000),
    new Car("Honda",   4, 130,  60000),
    new Car("Ford",    6, 200,  85000),
    new Car("Lexus",   6, 300,  40000),
    new Car("Mazda",   4, 160,  50000),
    $car1, $car2, $car3
];

// ланцюг: бренд → циліндри → потужність → пробіг ======
$brand     = new BrandHandler();
$cylinders = new CylindersMinHandler();
$power     = new PowerMinHandler();
$mileage   = new MileageMaxHandler();

$brand->setNext($cylinders)->setNext($power)->setNext($mileage);

// Критерії пошуку
$criteria = [
    // 'brand' => 'Lexus',    // закоментовано — бренд не фільтрується
    'min_cylinders' => 4,
    'min_power'     => 180,
    'max_mileage'   => 80000,
];

echo "<b>Результати фільтрації:</b><br>";
foreach ($cars as $car) {
    if ($brand->handle($car, $criteria)) {
        echo "✅ Підходить: ";
        $car->show();
    } else {
        echo "❌ Не підходить: ";
        $car->show();
    }
}