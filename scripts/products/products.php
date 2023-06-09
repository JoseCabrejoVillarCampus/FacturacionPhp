<?php
class products{
    use getInstance;
    function __construct(public $id_product,public $name_product, public $amount, public $value_product){}
}
?>