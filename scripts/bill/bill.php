<?php
class bill extends connect{
    private $queryPost = 'INSERT INTO tb_bill(n_bill,bill_date) VALUES(:billete,:fecha)';
    private $queryGetAll = 'SELECT * FROM tb_bill';
    private $message;
    use getInstance;
    function __construct(public $n_bill,public $bill_date){parent::__construct();}
    public function postBill(){
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("billete", $this->n_bill);
            $res->bindValue("fecha", $this->bill_date);
            $res->execute();
            $this->message = ["Code"=> 200+$res->rowCount(), "Message"=> "inserted data"];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function getAllBill(){
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindColumn("billete", 3);
            $res->bindColumn("fecha", 1);
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_BOUND)];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
}
?>  
