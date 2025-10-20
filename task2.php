<?php
// Трейт Singleton 
trait Singleton {
    protected static $instance;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        echo "Створено екземпляр класу за допомогою трейту Singleton<br>";
    }

    // Заборона клонування
    private function __clone() {}

    // Заборона десеріалізації
    private function __wakeup() {}
}

class MyClass {
    use Singleton;

    public function sayHello() {
        echo "Привіт із класу MyClass!<br>";
    }
}

// Демонстрація роботи
$object1 = MyClass::getInstance();
$object1->sayHello();

$object2 = MyClass::getInstance();

if ($object1 === $object2) {
    echo "Це той самий екземпляр класу Singleton.<br>";
} else {
    echo "Створено різні екземпляри!<br>";
}
?>