<?php

include_once 'Model.php';

class MunicipioModel extends Model {

    public function __construct()
    {
        Model::setTable("municipio");
    }
}