<?php 

trait my_first_trait { 

    // перша функція привітання
    public function traitFunction() { 
        echo "Hello world"; 
    }

    // Друга функція привітання (залежно від часу)
    public function timeGreeting() {
        $hour = date("H"); // Поточна година (00–23)

        if ($hour >= 6 && $hour < 12) {
            echo "Good morning!";
        } elseif ($hour >= 12 && $hour < 18) {
            echo "Good day!";
        } elseif ($hour >= 18 && $hour < 23) {
            echo "Good evening!";
        } else {
            echo "Good night!";
        }
    }
} 

class helloWorld { 
    
    use my_first_trait;  
} 

// Створення об’єкта класу
$objTest = new helloWorld();

// Виклик функцій із трейту
$objTest->traitFunction();
echo "<br>";
$objTest->timeGreeting();

?> 