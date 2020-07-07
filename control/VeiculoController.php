<?php
include '../../model/VeiculoModel.php';

class VeiculoController
{

    private $model;

    public function __construct()
    {
        $this->model = new VeiculoModel();
    }

    public function index()
    {
        $objeto = $this->model::selectAll();

        return $objeto;
    }

    public function create($dados)
    {

        if (
            !empty($dados['cliente_id']) && !empty($dados['placa']) &&
            !empty($dados['tipo_veiculo']) &&  !empty($dados['fabricante']) &&
            !empty($dados['modelo'])
        ) {
            
            $this->model::insert($dados);

            echo "<script>alert('Registro inserido com sucesso!')</script>";
            echo "<script>window.location='listarVeiculoView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function update($dados)
    {
        if (
            !empty($dados['cliente_id']) && !empty($dados['placa']) &&
            !empty($dados['tipo_veiculo']) &&  !empty($dados['fabricante']) &&
            !empty($dados['modelo'])
        ) {
            $this->model::update($dados);
            echo "<script>alert('Registro alterado com sucesso!')</script>";
            echo "<script>window.location='VeiculoListarView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function remove($id)
    {
        $objModel = $this->model::find($id);
        if (empty($objModel)) {
            echo "<script>alert('O ID informado não exite!')</script>";
            echo "<script>window.location='VeiculoListarView.php'</script>";
        } else {
            $this->model::deletar($id);
            echo "<script>alert('Registro removido com sucesso!')</script>";
            echo "<script>window.location='VeiculoListarView.php'</script>";
        }
    }
    public function search($dados)
    {
        $result = $this->model::search($dados);

        return $result;
    }
}
