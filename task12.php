<?php

// Конфігураційні дані
$config = [
    'factory' => 'ua', // 'ua' — вітчизняна, 'foreign' — зарубіжна
    'carNum' => 10,
    'truckNum' => 2,
    'busNum' => 4
];


// Абстрактні продукти
interface Car4 {
    public function getInfo(): string;
}

interface Truck {
    public function getInfo(): string;
}

interface Bus {
    public function getInfo(): string;
}


// Абстрактна фабрика
abstract class AbstractVehicleFactory {
    abstract public function createCar(): Car4;
    abstract public function createTruck(): Truck;
    abstract public function createBus(): Bus;
}


// Вітчизняна фабрика
class UkrainianFactory extends AbstractVehicleFactory {
    public function createCar(): Car4 {
        return new ZAZ();
    }
    public function createTruck(): Truck {
        return new KrAZ();
    }
    public function createBus(): Bus {
        return new Bogdan();
    }
}


// Зарубіжна фабрика
class ForeignFactory extends AbstractVehicleFactory {
    public function createCar(): Car4 {
        return new BMW();
    }
    public function createTruck(): Truck {
        return new Volvo();
    }
    public function createBus(): Bus {
        return new MercedesBus();
    }
}


// Конкретні продукти
class ZAZ implements Car4 {
    public function getInfo(): string {
        return "Легковий автомобіль ЗАЗ";
    }
}

class KrAZ implements Truck {
    public function getInfo(): string {
        return "Вантажівка КрАЗ";
    }
}

class Bogdan implements Bus {
    public function getInfo(): string {
        return "Автобус Богдан";
    }
}

class BMW implements Car4 {
    public function getInfo(): string {
        return "Легковий автомобіль BMW";
    }
}

class Volvo implements Truck {
    public function getInfo(): string {
        return "Вантажівка Volvo";
    }
}

class MercedesBus implements Bus {
    public function getInfo(): string {
        return "Автобус Mercedes-Benz";
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

// Вибір фабрики на основі конфігурації
$factory = null;

if ($config['factory'] === 'ua') {
    $factory = new UkrainianFactory();
    echo "<b>Створюємо парк із вітчизняних автомобілів:</b><br>";
} else {
    $factory = new ForeignFactory();
    echo "<b>Створюємо парк із зарубіжних автомобілів:</b><br>";
}

// Створюємо парк
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

// Виводимо результати
$park->showPark();

// Демонстрація з іншою фабрикою
echo "<hr><b>Тепер створюємо парк із зарубіжних автомобілів:</b><br>";
$config['factory'] = 'foreign';

$factory = new ForeignFactory();
$park2 = new VehiclePark();

for ($i = 0; $i < 3; $i++) {
    $park2->addVehicle($factory->createCar());
}
for ($i = 0; $i < 1; $i++) {
    $park2->addVehicle($factory->createTruck());
}
for ($i = 0; $i < 2; $i++) {
    $park2->addVehicle($factory->createBus());
}

$park2->showPark();
?>