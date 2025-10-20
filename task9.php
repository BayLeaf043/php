<?php
// Інтерфейс фабрики
interface Factory
{
    public function getProduct();
}

// Інтерфейс продукту
interface Product
{
    public function getName();
}

// Перша фабрика
class FirstFactory implements Factory
{
    public function getProduct()
    {
        return new FirstProduct();
    }
}

// Друга фабрика
class SecondFactory implements Factory
{
    public function getProduct()
    {
        return new SecondProduct();
    }
}

// Перший продукт
class FirstProduct implements Product
{
    public function getName()
    {
        return 'The first product';
    }
}

// Другий продукт
class SecondProduct implements Product
{
    public function getName()
    {
        return 'Second product';
    }
}

// Демонстрація роботи
$factory = new FirstFactory();
$firstProduct = $factory->getProduct();

$factory = new SecondFactory();
$secondProduct = $factory->getProduct();

echo $firstProduct->getName() . "<br>";  // The first product
echo $secondProduct->getName();          // Second product
?>