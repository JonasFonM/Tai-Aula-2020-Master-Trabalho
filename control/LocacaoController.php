<?php
include '../../model/LocacaoModel.php';

class LocacaoController
{

    private $model;

    public function __construct()
    {
        $this->model = new LocacaoModel();
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
            !empty($dados['data_retirada']) && !empty($dados['hora_retirada']) && 
            !empty($dados['data_devolucao']) && !empty($dados['hora_devolucao']) 
        ) {
            
            $this->model::insert($dados);

            echo "<script>alert('Registro inserido com sucesso!')</script>";
            echo "<script>window.location='listarLocacaoView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function update($dados)
    {
        if (
            !empty($dados['cliente_id']) && !empty($dados['veiculo_id']) &&
            !empty($dados['data_retirada']) &&  !empty($dados['hora_retirada']) && 
            !empty($dados['data_devolucao']) &&  !empty($dados['hora_devolucao']) 
        ) {
            $this->model::update($dados);
            echo "<script>alert('Registro alterado com sucesso!')</script>";
            echo "<script>window.location='LocacaoListarView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function remove($id)
    {
        $objModel = $this->model::find($id);
        if (empty($objModel)) {
            echo "<script>alert('O ID informado não exite!')</script>";
            echo "<script>window.location='LocacaoListarView.php'</script>";
        } else {
            $this->model::deletar($id);
            echo "<script>alert('Registro removido com sucesso!')</script>";
            echo "<script>window.location='LocacaoListarView.php'</script>";
        }
    }
    public function search($dados)
    {
        $result = $this->model::search($dados);

        return $result;
    }
}
