<?php 
class MyClass {
    const CONST_VALUE = 'A constant value';
}

$classname = 'MyClass';
//echo $classname::CONST_VALUE; // As of PHP 5.3.0

//echo MyClass::CONST_VALUE;
class OtherClass extends MyClass
{
    public static $my_static = 'static var';

    public static function doubleColon() {
        echo parent::CONST_VALUE . "</br>";
        echo self::$my_static . "</br>";
    }
    public function random() {
	return  (float)rand()/(float)getrandmax();
	}
}

$classname = 'OtherClass';
$classname::doubleColon(); // As of PHP 5.3.0
echo $classname::random();
//OtherClass::doubleColon();
?>