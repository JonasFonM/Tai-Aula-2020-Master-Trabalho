<?php

include_once 'Model.php';

class ClienteModel extends Model {

    public function __construct()
    {
        Model::setTable("cliente");
    }
}