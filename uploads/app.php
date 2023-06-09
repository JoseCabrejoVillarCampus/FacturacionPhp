<?php

trait getInstance
{
    public static $instance;
    public static function getInstance()
    {
        $arg = func_get_args();
        $arg = array_pop($arg);
        return (!(self::$instance instanceof self) || !empty($arg)) ? self::$instance = new static(...(array) $arg) : self::$instance;
    }

    function __set($name,$value){
        $this->$name = $value;
    }
    function __get($name){
        $this->$name;
    }
}
function autoload($class)
{ //?el autoload es unico y exclusivo de clases y la clase se tiene que llamar igual que el archivo, si no  no funciona
    //? Directorios donde buscar archivos de clases, busca el archivo y el dominio al que pertenece
    $directories = [
        dirname(__DIR__) . '/scripts/bill/',
        dirname(__DIR__) . '/scripts/client/',
        dirname(__DIR__) . '/scripts/products/',
        dirname(__DIR__) . '/scripts/seller/',
        dirname(__DIR__) . '/scripts/db/'
         //?dirname: captura la carpeta principa, o dominio de nuestro sitio, //?__DIR__: siempre busca la carpeta donde esta guardado ese archivo
    ];
    // ?Convertir el nombre de la clase en un nombre de archivo relativo
    $classFile = str_replace('\\', '/', $class) . '.php'; //?agarra la clase y agrega el .php, para que la clase no sesa igual que el archivo
    // ?Recorrer los directorios y buscar el archivo de la clase
    foreach ($directories as $directory) {
        $file = $directory . $classFile;
        // ?Verificar si el archivo existe y cargarlo
        if (file_exists($file)) {
            require $file;
            return; //!se dispone return, porque el break puede fallar ya que no podemos manejar la condicion, siendo una iteración. Como no estamos devolviendo nada estamos finalizando la función.
        }
    }
}

spl_autoload_register('autoload'); //? esta pendiente cuando se active un instancia, la toma de referencia y pasa de forma automatica la clase

class apiSuperPerrona{
    use getInstance;
    public function __construct(private $_METHOD, public $_HEADER, private $_DATA){
        switch ($_METHOD) {
            case 'POST':
                info::getInstance($_DATA['info']);
                break;
        }
    }

}

$data = [
    "_METHOD"=>$_SERVER['REQUEST_METHOD'],
    "_HEADER"=> apache_request_headers(),
    "_DATA" => json_decode(file_get_contents("php://input"),true)
];


apiSuperPerrona::getInstance($data);


// print_r(tb_user::getInstance()->getUserId(["n_bill" => 1]));
// print_r(tb_user::getInstance()->getAllUser());
// print_r(tb_user::getInstance()->deleteUser(["n_bill" => 1]));






// $data ='{
//     "n_bill": 1,
//     "bill_date": "1998-01-01",
//     "seller": "a",
//     "identification": 1,
//     "full_name": "a",
//     "email": "a@gmail.com",
//     "address": "a",
//     "pone": 1
// }';
// print_r(tb_user::getInstance()->putUser(json_decode($data,true)));






// $data ='{
//     "n_bill": 1,
//     "bill_date": "2023-03-09",
//     "seller": "Campus",
//     "identification": 106465,
//     "full_name": "Miguel Angel Catsro Escamilla",
//     "email": "ma@gmail.com",
//     "address": "Calle 11",
//     "pone": "30455154845"
// }';
// print_r(tb_user::getInstance()->postUser(json_decode($data, true)));

?>