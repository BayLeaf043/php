<?php
header("Content-Type: text/html; charset=utf-8");

class CarCSV {
    private $_csv_file = null;

    // Конструктор
    public function __construct($csv_file) {
        if (file_exists($csv_file)) {
            $this->_csv_file = $csv_file;
        } else {
            throw new Exception("Файл не знайдено");
        }
    }

    // Метод для додавання даних про машину
    public function addCar($brand, $cylinders, $power, $mileage) {
        $handle = fopen($this->_csv_file, "a");
        fputcsv($handle, [$brand, $cylinders, $power, $mileage], ";");
        fclose($handle);
        echo "Запис додано: Марка: $brand, Циліндрів: $cylinders, Потужність: $power к.с., Пробіг: $mileage км<br>";
    }

    // Метод для отримання всіх записів
    public function getCars() {
        $handle = fopen($this->_csv_file, "r");
        $cars = [];
        while (($line = fgetcsv($handle, 0, ";")) !== FALSE) {
            $cars[] = $line;
        }
        fclose($handle);
        return $cars;
    }

    // Метод для виведення вмісту на екран
    public function showCars() {
        $cars = $this->getCars();
        foreach ($cars as $car) {
            echo "Марка: {$car[0]}<br>";
            echo "Циліндрів: {$car[1]}<br>";
            echo "Потужність: {$car[2]} к.с.<br>";
            echo "Пробіг: {$car[3]} км<br>";
            echo "----------------------<br>";
        }
    }
}

try {
    // Робота з файлом file.csv
    $cars = new CarCSV("file.csv");

    echo "<h3>Вміст файлу:</h3>";
    $cars->showCars();

    echo "<h3>Додаємо новий запис:</h3>";
    $cars->addCar("BMW", 6, 250, 120000);

    echo "<h3>Оновлений вміст файлу:</h3>";
    $cars->showCars();

} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage();
}
?>