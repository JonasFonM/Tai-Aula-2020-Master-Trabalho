<?php
include '../../model/MultaModel.php';

class MultaController
{

    private $model;

    public function __construct()
    {
        $this->model = new MultaModel();
    }

    public function index()
    {
        $objeto = $this->model::selectAll();

        return $objeto;
    }

    public function create($dados)
    {

        if (
            !empty($dados['cliente_id']) && !empty($dados['veiculo_id']) &&
            !empty($dados['locacao_id']) &&  !empty($dados['valor']) &&
            !empty($dados['data_hora_multa'])
        ) {
            
            $this->model::insert($dados);

            echo "<script>alert('Registro inserido com sucesso!')</script>";
            echo "<script>window.location='listarMultaView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function update($dados)
    {
        if (
            !empty($dados['cliente_id']) && !empty($dados['veiculo_id']) &&
            !empty($dados['locacao_id']) &&  !empty($dados['valor']) &&
            !empty($dados['data_hora_multa'])
        ) {
            $this->model::update($dados);
            echo "<script>alert('Registro alterado com sucesso!')</script>";
            echo "<script>window.location='MultaListarView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function remove($id)
    {
        $objModel = $this->model::find($id);
        if (empty($objModel)) {
            echo "<script>alert('O ID informado não exite!')</script>";
            echo "<script>window.location='MultaListarView.php'</script>";
        } else {
            $this->model::deletar($id);
            echo "<script>alert('Registro removido com sucesso!')</script>";
            echo "<script>window.location='MultaListarView.php'</script>";
        }
    }
    public function search($dados)
    {
        $result = $this->model::search($dados);

        return $result;
    }
}
