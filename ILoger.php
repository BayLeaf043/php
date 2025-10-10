<?php

// Інтерфейс ILoger 
interface ILoger {
    public function log($message);
}

// Трейт для отримання поточної дати і часу
trait DateTimeTrait {
    public function getCurrentDateTime() {
        return date("Y-m-d H:i:s");
    }
}

// Трейт для запису повідомлення у файл
trait FileWriteTrait {
    public function writeToFile($file, $message) {
        fwrite($file, $message . "\n");
    }
}

// Клас FileLoger, який реалізує інтерфейс ILoger
class FileLoger implements ILoger { 

    use DateTimeTrait, FileWriteTrait; // Використовуємо трейти
    private $file;   

    public function __construct($filename, $mode = 'a') {
        $this->file = fopen($filename, $mode) or die('Could not open the log file');
    }  

    // Реалізація методу з інтерфейсу
    public function log($message) {
        $dateTime = $this->getCurrentDateTime(); // з трейту DateTimeTrait
        $logMessage = "$dateTime - $message";
        $this->writeToFile($this->file, $logMessage); // з трейту FileWriteTrait
    }

    // Закриття файлу при знищенні об’єкта
    public function __destruct() {
        if ($this->file) {
            fclose($this->file);
        }
    }
}

// Демонстрація роботи
$logger = new FileLoger('log.txt', 'a');

// Імітуємо введення користувача через форму
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $msg = $_POST['message'];
    $logger->log($msg);
    echo "Повідомлення додано у log.txt!";
}
?>

<!-- Форма для введення повідомлення -->
<form method="POST">
    <label>Введіть повідомлення:</label><br>
    <input type="text" name="message" required>
    <button type="submit">Надіслати</button>
</form>

