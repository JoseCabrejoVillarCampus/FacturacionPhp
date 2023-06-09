<?php
class client{
    use getInstance;
    function __construct(public $Identification,public $Full_Name, public $Email, public $Address, public $Phone){}
}
?>