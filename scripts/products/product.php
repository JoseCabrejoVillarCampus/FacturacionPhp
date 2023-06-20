<?php
class product extends connect{
    private $queryPost = 'INSERT INTO tb_product(id_product,name_product,amount,value_prodcut) VALUES(:productos,:nameproduct,:amount,:valpro)';
    private $queryGetAll = 'SELECT * FROM tb_product';
    private $message;
    use getInstance;
    function __construct(private $id_product, public $name_product, public $amount, private $value_prodcut){parent::__construct();}
    public function postProduct(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("productos", $this->id_product);
            $res->bindValue("nameproduct", $this->name_product);
            $res->bindValue("amount", $this->amount);
            $res->bindValue("valpro", $this->value_prodcut);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function getAllProducts(){
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_BOUND)];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>