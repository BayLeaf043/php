<?php
// Клас конфігурації — визначає, яку фабрику використовувати
class Config
{
    public static $factory = 1;
}

// Інтерфейс продукту
interface Product2
{
    public function getName();
}

// Абстрактна фабрика
abstract class AbstractFactory
{
    // Вибір фабрики на основі конфігурації
    public static function getFactory()
    {
        switch (Config::$factory) {
            case 1:
                return new FirstFactory2();
            case 2:
                return new SecondFactory2();
            default:
                throw new Exception('Bad config');
        }
    }

    // Абстрактний метод створення продукту
    abstract public function getProduct();
}

// Перша фабрика
class FirstFactory2 extends AbstractFactory
{
    public function getProduct()
    {
        return new FirstProduct2();
    }
}

// Перший продукт
class FirstProduct2 implements Product2
{
    public function getName()
    {
        return 'The product from the first factory';
    }
}

// Друга фабрика
class SecondFactory2 extends AbstractFactory
{
    public function getProduct()
    {
        return new SecondProduct2();
    }
}

// Другий продукт
class SecondProduct2 implements Product2
{
    public function getName()
    {
        return 'The product from the second factory';
    }
}

// Демонстрація роботи

// Використання першої фабрики
$firstProduct = AbstractFactory::getFactory()->getProduct();

// Змінюємо конфігурацію
Config::$factory = 2;

// Використання другої фабрики
$secondProduct = AbstractFactory::getFactory()->getProduct();

echo $firstProduct->getName() . "<br>";   
echo $secondProduct->getName();            
?>