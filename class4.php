<?php  class Coor{
    
    private $name;
    private $login;
    private $password;  
    
    function __construct($name, $login, $password)   
    {  
        $this->name=$name; 
        $this->login=$login;
        $this->password=$password;
    }   
    
    function Getname()
    {  
        echo "<p>Name: ".$this->name." ";   
    } 
    function showInfo() {  
        echo "Name: {$this->name}, Login: {$this->login}, Password: {$this->password}<br>";   
    }

    function __destruct()
    {  
        echo "<br>Destructor is called! Object {$this->name} is deleted.<br>";   
    }
} 

$object1 = new Coor("Nick", "nick123", "pass1");
$object2 = new Coor("Anna", "anna2025", "pass2");
$object3 = new Coor("John", "john007", "pass3");

$object1->showInfo();
$object2->showInfo();
$object3->showInfo();
?>