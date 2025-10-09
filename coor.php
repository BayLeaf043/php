<?php

// Абстрактний клас
abstract class Coor{  

    private $firstName = "";   
    private $lastName = ""; 
    
    public function setName( $firstName, $lastName ) {
        $this->firstName = $firstName; 
        $this->lastName = $lastName; 
    }    
    
    public function getName() {
        return "$this->firstName $this->lastName"; 
    } 
    
    // Абстрактний метод
    abstract public function showWelcomeMessage();
} 

// Клас Гість
class Visitor extends Coor{ 
    
    // Реалізація абстрактного методу
    public function showWelcomeMessage() {
        echo "Hi " . $this->getName() . ", 
        welcome to our shop!To buy something, please, register!<br>"; 
    }    
    
    public function newMessage( $subject ) {     
        echo "Creating new message $subject<br>"; 
    } 
}    

// Клас Покупець
class Shopper extends Coor { 
    
    // Реалізація абстрактного методу
    public function showWelcomeMessage() {
        echo "Hi " . $this->getName() . ", welcome to our online store!<br>"; 
    }    
    
    public function addToCart( $item ) {     
        echo "Adding $item to cart<br>"; 
    } 
}

// Демонстрація роботи з класами
$visitor = new Visitor();
$visitor->setName("Anna", "Smith");
$visitor->showWelcomeMessage();   // виведе привітання для гостя
$visitor->newMessage("Need help with registration");  // демонстрація методу newMessage()

echo "<hr>";

$shopper = new Shopper();
$shopper->setName("John", "Brown");
$shopper->showWelcomeMessage();  // виведе привітання для покупця
$shopper->addToCart("Laptop");   // демонстрація методу addToCart()

?>
