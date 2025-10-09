<?php

// Інтерфейс ILoger 
interface ILoger {
    public function log($message);
}

// Клас FileLoger, який реалізує інтерфейс ILoger
class FileLoger implements ILoger { 

    private $file;      // ресурс відкритого файлу
    private $logFile;   // назва файлу

    public function __construct($filename, $mode = 'a') { 
        $this->logFile = $filename;     
        $this->file = fopen($filename, $mode) or die('Could not open the log file'); // відкриває файл
    }     

    // Реалізація методу з інтерфейсу
    public function log($message) {
        // додаємо дату і час перед повідомленням
        $message = date("Y-m-d H:i:s") . " - " . $message . "\n"; 
        fwrite($this->file, $message); // запис у файл
    } 

    // Закриття файлу при знищенні об’єкта
    public function __destruct() {     
        if ($this->file) { 
            fclose($this->file); 
        } 
    } 
}

// Демонстрація роботи
$FLog = new FileLoger('./log.txt', 'w'); 
$FLog->log('First log message');
$FLog->log('Another log message');

echo "Лог-файл успішно створено і заповнено!<br>";

?>