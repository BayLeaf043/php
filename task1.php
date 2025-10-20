<?php
class someClass {

    // Статичне поле для зберігання єдиного екземпляра
    protected static $_instance;

    // Приватний конструктор забороняє створювати нові об’єкти через new
    private function __construct() {
        echo "Створено екземпляр класу<br>";
    }

    // Метод повертає єдиний екземпляр класу
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }

    // Заборона клонування
    private function __clone() {}

    // Заборона десеріалізації
    private function __wakeup() {}
}


// Отримуємо перший екземпляр
$object1 = someClass::getInstance();

// Отримуємо другий екземпляр
$object2 = someClass::getInstance();

// Перевіряємо, чи це один і той самий об’єкт
if ($object1 === $object2) {
    echo "Це один і той самий екземпляр класу Singleton.<br>";
} else {
    echo "Створено різні екземпляри!<br>";
}

// спроба створити об’єкт напряму 
try {
    $newObject = new someClass();
} catch (Error $e) {
    echo "Помилка: неможливо створити новий екземпляр напряму.<br>";
    echo $e->getMessage();
}
?>