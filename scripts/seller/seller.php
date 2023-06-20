<?php
class seller extends connect{
    private $queryPost = 'INSERT INTO tb_seller(id_seller, seller) VALUES(:idven,:vend)';
    private $queryGetAll = 'SELECT * FROM tb_seller';
    private $message;
    use getInstance;
    function __construct(private $id_seller ,public $seller){parent::__construct();}
    public function postSeller(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("idven", $this->id_seller);
            $res->bindValue("vend", $this->seller);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function getAllSeller(){
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