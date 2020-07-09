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
            !empty($dados['locacao_id']) && !empty($dados['valor']) &&  
            !empty($dados['data_multa'])  && !empty($dados['hora_multa'])
        ) {

            $objLocacaoModel = new LocacaoModel();
            $objLocacao = $objLocacaoModel::find($dados['locacao_id'], "locacao");
           

            $this->model = new LocacaoModel();

            if (
                $objLocacao->data_retirada < ($dados['data_multa']) &&
                $objLocacao->data_devolucao > ($dados['data_multa'])
            ) {
                

                echo "<script>alert('ok')</script>";
                echo "<script>window.location='listarMultaView.php'</script>";

                $this->model::setTable('multa');
                $this->model::insert($dados);
            } else {
                echo "<script>alert('data errada')</script>";
                echo "<script>window.location='listarMultaView.php'</script>";
            }
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    
    public function update($dados)
    {

        if (
            !empty($dados['cliente_id']) && !empty($dados['veiculo_id']) &&
            !empty($dados['locacao_id']) &&  !empty($dados['hora_multa']) &&
            !empty($dados['data_multa']) && !empty($dados['valor'])
        ) {

            $objLocacaoModel = new LocacaoModel();
            $objLocacao = $objLocacaoModel::find($dados['locacao_id'], 'locacao');
            $objLocacao2 = $objLocacaoModel::find($dados['locacao_id'], 'locacao');

            $this->model = new LocacaoModel();

            if (
                $objLocacao->data_retirada <= ($dados['data_multa']) &&
                $objLocacao2->data_devolucao >= ($dados['data_multa'])
            ) {
                $this->model::update($dados);

                echo "<script>alert('ok')</script>";
                echo "<script>window.location='listarMultaView.php'</script>";
            } else {
                echo "<script>alert('data errada')</script>";
                echo "<script>window.location='listarMultaView.php'</script>";
            }
        } else {
            echo "<script>alert('tente novamente')</script>";
        }
    }
    public function remove($id)
    {
        $objModel = $this->model::find($id);
        if (empty($objModel)) {
            echo "<script>alert('id informado não exite!')</script>";
            echo "<script>window.location='listarMultaView.php'</script>";
        } else {
            $this->model::deletar($id);
            echo "<script>alert('removido')</script>";
            echo "<script>window.location='listarMultaView.php'</script>";
        }
    }
    public function search($dados)
    {
        $result = $this->model::search($dados);

        return $result;
    }
}