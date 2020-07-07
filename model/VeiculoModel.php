<?php

include_once 'Model.php';

class VeiculoModel extends Model {

    public function __construct()
    {
        Model::setTable("veiculo");
    }
}