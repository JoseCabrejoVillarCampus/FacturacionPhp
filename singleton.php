<?php

trait getInstance{
    static $instance;
    static function getInstance(){//? ESte codigo es singleton
        $arg = func_get_args();
        $arg = array_pop($arg);
        if(self::$instance == null){//!self llama el nombre de la clase dentron de la misma clase, se llama nullo pq no estaba instanciada
            self::$instance = new self(...(array) $arg);//*destructuramos el array con ...()
            return self::$instance;
        };
    }
}
Class Humano{
    //?esto es de la version nueva y no necesitamos declarar antes, sino directamente
    function __construct(public $name,private $age){}//!tiene que haber un metodo estatico y un atributo, una sobrecarga al constructor si o si
    use getInstance;
    public function getName(){
        return $this->name;
    }
}
    
class Animal{
    function __construct(private $name){}
    use getInstance;
    public function getName(){
        return $this->name;
    }
}
    /* static function ropa(){//?uso de la estatica
        return "Camisa Blanca";
    } */


?>