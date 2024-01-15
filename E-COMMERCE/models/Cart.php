<?php

require "../connection/DbManager.php";
class Cart
{

    private $id;
    private $product_id;
    private $quantita;


    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId()
    {
        return $this->id;
    }
    public function getProductId()
    {
        return $this->product_id;
    }


    public function setProductId($product_id)
    {
        $this->product_id = $product_id;
    }


    public function getQuantita()
    {
        return $this->quantita;
    }


    public function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }



    public static function add($current_user)
    {
        $pdo = self::connect();
        $stmt = $pdo->query("INSERT INTO ecommerce.carts DEFAULT VALUES");

        if ($stmt) {
            $id = self::last_record();

            // Utilizzare il metodo UpdateCart_ID per aggiornare il campo cart_id nel database
            $current_user->UpdateCart_ID($id);

            return $id;
        } else {
            throw new PDOException("Errore");
        }
    }



    public static function Find($cart_id) {
        $pdo = self::connect();
        $stmt = $pdo->prepare("select * from ecommerce.carts where id=:id");
        $stmt->bindParam(":id", $cart_id);
        $stmt->execute();
        return $stmt->fetchObject('Cart');
    }
    public static function last_record()
    {
        $pdo = self::connect();
        $stm = $pdo->prepare("SELECT id FROM ecommerce.carts ORDER BY id DESC LIMIT 1");

        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_ASSOC);
            return $result['id'];
        } else {
            throw new PDOException("Errore nel last_record");
        }
    }


    public static function Find_by_product($product_id) {
        $pdo = self::connect();
        $stmt = $pdo->prepare("select cart_id from ecommerce.cart_products where product_id =:product_id");
        $stmt->bindParam(":product_id", $product_id);
        $stmt->execute();
        return $stmt->fetchObject('Cart');
    }

    public static function fetchAll($current_user)
    {

    }

    public static function Connect()
    {
        return DbManager::Connect("ecommerce");
    }
}