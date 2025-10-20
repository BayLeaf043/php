<?php
// Клас Product
class Automobile 
{     
    private $vehicleMake; 
    private $vehicleModel; 

    // Конструктор 
    public function __construct($make, $model)  
    { 
        $this->vehicleMake = $make; 
        $this->vehicleModel = $model; 
    } 

    // Метод для отримання інформації про авто
    public function getMakeAndModel()  
    { 
        return $this->vehicleMake . ' ' . $this->vehicleModel; 
    } 
}  

// Клас Factory (створює об’єкти Automobile)
class AutomobileFactory  
{     
    public static function create($make, $model)  
    { 
        // Повертає новий екземпляр класу Automobile
        return new Automobile($make, $model); 
    } 
}  

// Створюємо кілька автомобілів через фабрику
$veyron = AutomobileFactory::create('Bugatti', 'Veyron'); 
$mustang = AutomobileFactory::create('Ford', 'Mustang');
$tesla = AutomobileFactory::create('Tesla', 'Model S');

// Виводимо результати
echo $veyron->getMakeAndModel() . "<br>";
echo $mustang->getMakeAndModel() . "<br>";
echo $tesla->getMakeAndModel() . "<br>";
?>