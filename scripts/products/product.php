<?php
class product extends connect{
    private $queryPost = 'INSERT INTO tb_product(id_product,name_product,amount,value_prodcut) VALUES(:productos,:nameproduct,:cant,:valpro)';
    private $queryGetAll = 'SELECT * FROM tb_product';
    private $queryUpdate = 'UPDATE tb_product SET id_product = :productos, name_product = :nameproduct, amount = :cant, value_prodcut = :valpro WHERE id_product = :productos';
    private $queryDelete = 'DELETE FROM tb_product WHERE id_product = :productos';
    private $message;
    use getInstance;
    function __construct(private $id_product=1, public $name_product=1, public $amount=1, private $value_prodcut=1){parent::__construct();}
    public function postProduct(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("productos", $this->id_product);
            $res->bindValue("nameproduct", $this->name_product);
            $res->bindValue("cant", $this->amount);
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
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function putProduct()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("productos", $this->id_product);
            $res->bindValue("nameproduct", $this->name_product);
            $res->bindValue("cant", $this->amount);
            $res->bindValue("valpro", $this->value_prodcut);
            $res->execute();

            if ($res->rowCount() > 0) {
                $this->message = ["Code" => 200, "Message" => "Data updated"];
            } else {
                $this->message = ["Code" => 404, "Message" => "No matching record found"];
            }
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function deleteProduct()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("productos", $this->id_product);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => "Data delete"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
}
?>