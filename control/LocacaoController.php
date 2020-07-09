<?php
include '../../model/LocacaoModel.php';


class LocacaoController
{
    private $model;
    public function __construct()
    {
        //instanciando objeto
        $this->model = new LocacaoModel();
    }
    public function index()
    {
        //listar
        $objeto = $this->model::selectAll();
        return $objeto;
    }
    public function create($dados)
    {
        //inserir
     if (!empty($dados['cliente_id']) && !empty($dados['veiculo_id']) && !empty($dados['data_retirada']) && !empty($dados['hora_retirada']) && !empty($dados['data_devolucao']) && !empty($dados['hora_devolucao'])) {
            
                  
            $objClienteModel = new ClienteModel();
            $objCliente = $objClienteModel::find($dados['cliente_id'], 'cliente');
            $this->model = new LocacaoModel();
               
            $date = new DateTime( $objCliente->data_nasc );
            $interval = $date->diff( new DateTime( date('Y-m-d') ) ) ->format( '%Y anos' );

     if ( $interval > 18 ) {
              
            $this->model::insert($dados);

            echo "<script>alert('Registro inserido com sucesso!')</script>";
            echo "<script>window.location='listarLocacaoView.php'</script>";
            }
     else {
            echo "<script>alert('O cliente é menor de idade, portanto não poderá alugar um carro')</script>";
        }
        }

     else {
            echo "<script>alert('Algum campo nao foi preencido')</script>";
        }
        }

    public function update($dados)
    {
        //editar
        if (!empty($dados['cliente_id']) && !empty($dados['veiculo_id']) && !empty($dados['data_retirada']) && !empty($dados['hora_retirada']) && !empty($dados['data_devolucao']) && !empty($dados['hora_devolucao'])) {

            $objClienteModel = new ClienteModel();
            $objCliente = $objClienteModel::find($dados['cliente_id'], 'cliente');
            $this->model = new LocacaoModel();
 
               $date = new DateTime( $objCliente->data_nasc );
               $interval = $date->diff( new DateTime( date('Y-m-d') ) ) ->format( '%Y anos' );

           if ( $interval > 18 ) {
              
            $this->model::insert($dados);

            echo "<script>alert('Registro inserido com sucesso!')</script>";
            echo "<script>window.location='listarLocacaoView.php'</script>";
            }
     else {
            echo "<script>alert('O cliente é menor de idade, portanto não poderá alugar um carro')</script>";
        }
        }

     else {
            echo "<script>alert('algum campo nao foi preencido')</script>";
        }
        }
    public function remove($id)
    {
        //remover, o exclamacao é igual a diferente
        $objModel = $this->model::find($id);
        if (empty($objModel)) {
            echo "<script>alert('o id informado nao existe!')</script>";
            echo "<script>window.location='listarLocacaoView.php'</script>";
        } else {
            $this->model::deletar($id);
            echo "<script>alert('registro removido com sucesso!')</script>";
            echo "<script>window.location='listarLocacaoView.php'</script>";
        }
    }
    public function search($dados)
    {
        //pesquisar
        $result = $this->model::search($dados);
        return $result;
    }
}