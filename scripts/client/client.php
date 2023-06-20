<?php
class client extends connect
{
    private $queryPost = 'INSERT INTO tb_client(identificacion,full_name,email,address,phone) VALUES(:cc,:name,:email,:direction,:cellphone)';
    private $queryGetAll = 'SELECT identificacion AS "cc", full_name AS "name", email AS "email", address AS "direction" ,phone AS "cellphone" FROM tb_client';
    private $queryUpdate = 'UPDATE tb_client SET full_name = :name, email = :email, address = :direction, phone = :cellphone WHERE identificacion = :cc';
    private $queryDelete = 'DELETE FROM tb_client WHERE identificacion = :cc';
    private $message;
    use getInstance;
    function __construct(private $identificacion, public $full_name, public $email, private $address, private $phone)
    {
        parent::__construct();
    }
    public function postClient()
    {
        try {
            $res = $this->conx->prepare($this->queryPost);
            $res->bindValue("email", $this->email);
            $res->bindValue("cc", $this->identificacion);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("direction", $this->address);
            $res->bindValue("cellphone", $this->phone);
            $res->execute();
            $this->message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function getAllClient()
    {
        try {
            $res = $this->conx->prepare($this->queryGetAll);
            $res->execute();
            $this->message = ["Code" => 200, "Message" => $res->fetchAll(PDO::FETCH_BOUND)];
        } catch (\PDOException $e) {
            $this->message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            print_r($this->message);
        }
    }
    public function putClient()
    {

        try {
            $res = $this->conx->prepare($this->queryUpdate);
            $res->bindValue("cc", $this->identificacion);
            $res->bindValue("name", $this->full_name);
            $res->bindValue("email", $this->email);
            $res->bindValue("direction", $this->address);
            $res->bindValue("cellphone", $this->phone);
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
    public function deleteClient()
    {
        try {
            $res = $this->conx->prepare($this->queryDelete);
            $res->bindValue("cc", $this->identificacion);
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