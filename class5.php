<?php header("Content-Type: text/html; charset=utf-8"); 

class WorkWithFile { 

    public $buff; 
    public $filename; 

    function __construct($filename) { 
        $uploaddir = './'; 
        $this->filename = $uploaddir .$filename; 
        
        if(!file_exists($this->filename)) exit("File does not exist"); 
        $fd = fopen($this->filename, "r"); 
        if(!$fd) exit("File open error"); 
        $this->buff = fread($fd,filesize($this->filename)); 
        fclose($fd) ; 
    } 
    
    function getContent() { 
        return $this->buff; 
    } 

    function getsize() { 
        return filesize($this->filename); 
    } 

    function getCount() { 

        if(!empty($this->filename)) { 

            $arr = file($this->filename); 
            return count($arr); 
        } 
    } 

    function writeToLineFile($newFile) {
        // Зчитуємо всі числа в масив
        $arr = file($this->filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // Об'єднуємо в один рядок
        $line = implode(" ", $arr);

        // Записуємо у новий файл
        file_put_contents($newFile, $line);

        echo "Дані записані у файл $newFile<br>";
    }

} 

$first = new WorkWithFile("count.txt"); 
echo "Вміст файлу:<br>{$first->getContent()}<br>"; 
echo "Розмір: {$first->getsize()} байт<br>"; 
echo "Кількість рядків: {$first->getCount()}<br>"; 

// Виклик нового методу
$first->writeToLineFile("result.txt");

?>  
