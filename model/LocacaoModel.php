<?php

include_once 'Model.php';

class LocacaoModel extends Model {

    public function __construct()
    {
        Model::setTable("locacao");
    }
}