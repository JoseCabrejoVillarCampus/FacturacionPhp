<?php
class bill extends connect
{
    private $queryPost = 'INSERT INTO tb_bill(n_bill,bill_date,identificacion_fk,id_seller_fk,id_product_fk) VALUES(:billete,:fecha,:idfk,:idsefk,:idprofk)';
    private $queryGetAll = 'SELECT * FROM tb_bill';
    private $queryUpdate = 'UPDATE tb_bill SET n_bill = :billete, bill_date = :fecha, identificacion_fk = :idfk, id_seller_fk = :idsefk, id_product_fk = :idprofk  WHERE n_bill = :billete';
    private $queryDelete = 'DELETE FROM tb_bill WHERE n_bill = :billete';
    private $message;
    use getInstance;
    function __construct(public $n_bill=1, public $bill_date=1, private $identificacion_fk=1, private $id_seller_fk=1, private $id_product_fk=1)
    {
        parent::__construct();
    }
    public function postBill()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("billete", $this->n_bill);
            $res->bindValue("fecha", $this->bill_date);
            $res->bindValue("idfk", $this->identificacion_fk);
            $res->bindValue("idsefk", $this->id_seller_fk);
            $res->bindValue("idprofk", $this->id_product_fk);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllBill()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $res->bindColumn("billete", 3);
            $res->bindColumn("fecha", 1);
            $res->bindValue("idfk", 1);
            $res->bindValue("idsefk", 1);
            $res->bindValue("idprofk", 1);
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putBill()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("billete", $this->n_bill);
            $res->bindValue("fecha", $this->bill_date);
            $res->bindValue("idfk", $this->identificacion_fk);
            $res->bindValue("idsefk", $this->id_seller_fk);
            $res->bindValue("idprofk", $this->id_product_fk);
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
    public function deleteBill()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("billete", $this->n_bill);
            $res->bindValue("fecha", $this->fecha);
            $res->bindValue("idfk", $this->identificacion_fk);
            $res->bindValue("idsefk", $this->id_seller_fk);
            $res->bindValue("idprofk", $this->id_product_fk);
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