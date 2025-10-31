<?php

// Конфігураційні дані
$config = [
    'factory' => 'ua', // 'ua' — вітчизняна, 'foreign' — зарубіжна
    'carNum' => 10,
    'truckNum' => 2,
    'busNum' => 4
];

// Абстрактні продукти 
interface Car {
    public function getInfo(): string;
}
interface Truck {
    public function getInfo(): string;
}
interface Bus {
    public function getInfo(): string;
}

// Конкретні продукти 
class ZAZ implements Car {
    public function getInfo(): string { return "Легковий автомобіль ЗАЗ"; }
}
class KrAZ implements Truck {
    public function getInfo(): string { return "Вантажівка КрАЗ"; }
}
class Bogdan implements Bus {
    public function getInfo(): string { return "Автобус Богдан"; }
}

class BMW implements Car {
    public function getInfo(): string { return "Легковий автомобіль BMW"; }
}
class Volvo implements Truck {
    public function getInfo(): string { return "Вантажівка Volvo"; }
}
class MercedesBus implements Bus {
    public function getInfo(): string { return "Автобус Mercedes-Benz"; }
}

// Prototype Factory 
class VehiclePrototypeFactory {
    private Car $carPrototype;
    private Truck $truckPrototype;
    private Bus $busPrototype;

    public function __construct(Car $car, Truck $truck, Bus $bus) {
        $this->carPrototype = $car;
        $this->truckPrototype = $truck;
        $this->busPrototype = $bus;
    }

    public function createCar(): Car {
        return clone $this->carPrototype;
    }

    public function createTruck(): Truck {
        return clone $this->truckPrototype;
    }

    public function createBus(): Bus {
        return clone $this->busPrototype;
    }
}

// Клас автопарку 
class VehiclePark {
    private array $vehicles = [];

    public function addVehicle($vehicle) {
        $this->vehicles[] = $vehicle;
    }

    public function showPark() {
        foreach ($this->vehicles as $vehicle) {
            echo $vehicle->getInfo() . "<br>";
        }
    }
}

// Основна логіка 
if ($config['factory'] === 'ua') {
    echo "<b>Створюємо парк із вітчизняних автомобілів:</b><br>";
    $factory = new VehiclePrototypeFactory(
        new ZAZ(),
        new KrAZ(),
        new Bogdan()
    );
} else {
    echo "<b>Створюємо парк із зарубіжних автомобілів:</b><br>";
    $factory = new VehiclePrototypeFactory(
        new BMW(),
        new Volvo(),
        new MercedesBus()
    );
}

// Створення парку
$park = new VehiclePark();

// Додаємо легкові авто
for ($i = 0; $i < $config['carNum']; $i++) {
    $park->addVehicle($factory->createCar());
}

// Додаємо вантажівки
for ($i = 0; $i < $config['truckNum']; $i++) {
    $park->addVehicle($factory->createTruck());
}

// Додаємо автобуси
for ($i = 0; $i < $config['busNum']; $i++) {
    $park->addVehicle($factory->createBus());
}

$park->showPark();

// Демонстрація іншої фабрики 
echo "<hr><b>Тепер створюємо парк із зарубіжних автомобілів:</b><br>";

$foreignFactory = new VehiclePrototypeFactory(
    new BMW(),
    new Volvo(),
    new MercedesBus()
);

$park2 = new VehiclePark();

for ($i = 0; $i < 3; $i++) {
    $park2->addVehicle($foreignFactory->createCar());
}
for ($i = 0; $i < 1; $i++) {
    $park2->addVehicle($foreignFactory->createTruck());
}
for ($i = 0; $i < 2; $i++) {
    $park2->addVehicle($foreignFactory->createBus());
}

$park2->showPark();
?>