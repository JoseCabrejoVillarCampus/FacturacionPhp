<?php
class seller extends connect{
    private $queryPost = 'INSERT INTO tb_seller(id_seller, seller) VALUES(:idven,:vend)';
    private $queryGetAll = 'SELECT * FROM tb_seller';
    private $queryUpdate = 'UPDATE tb_seller SET id_seller = :idven, seller = :vend WHERE id_seller = :idven';
    private $queryDelete = 'DELETE FROM tb_seller WHERE id_seller = :idven';
    private $message;
    use getInstance;
    function __construct(private $id_seller = 1 ,public $seller =1){parent::__construct();}
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
            $this->message = ["Code"=> 200, "Message"=> $res->fetchAll(PDO::FETCH_ASSOC)];
        } catch(\PDOException $e) {
            $this->message = ["Code"=> $e->getCode(), "Message"=> $res->errorInfo()[2]];
        }finally{
            print_r($this->message);
        }
    }
    public function putSeller()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("idven", $this->id_seller);
            $res->bindValue("vend", $this->seller);
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
    public function deleteSeller()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("idven", $this->id_seller);
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