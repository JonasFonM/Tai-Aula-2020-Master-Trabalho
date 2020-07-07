<?php

include_once 'Model.php';

class MultaModel extends Model {

    public function __construct()
    {
        Model::setTable("multa");
    }
}