<?php  class A { 

  public static function test() { 
    echo 1; 
  } 
  
  public static function get() { 
    static::test();  // змінено self:: на static::
  } 

}  

class B extends A { 

  public static function test() { 
    echo 2; 
  } 

} 
A::get();
echo "<br>";
B::get();  

?> 