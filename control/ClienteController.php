<?php
include '../../model/ClienteModel.php';

class ClienteController
{

    private $model;

    public function __construct()
    {
        $this->model = new ClienteModel();
    }

    public function index()
    {
        $objeto = $this->model::selectAll();

        return $objeto;
    }

    public function create($dados)
    {

        if (
            !empty($dados['nome']) && !empty($dados['telefone']) &&
            !empty($dados['cpf']) &&  !empty($dados['email']) &&
            !empty($dados) && !empty($dados['municipio_id'])
        ) {
            /*
            $municipio_id = $dados['municipio_id'];
            unset($dados['municipio_id']);
            array_push($dados, ['municipio_id' => intval($municipio_id)]);
*/
            $this->model::insert($dados);

            echo "<script>alert('Registro inserido com sucesso!')</script>";
            echo "<script>window.location='listarClienteView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function update($dados)
    {
        if (
            !empty($dados['nome']) && !empty($dados['telefone']) &&
            !empty($dados['cpf']) &&  !empty($dados['email']) &&
            !empty($dados['municipio_id'])
        ) {
            $this->model::update($dados);
            echo "<script>alert('Registro alterado com sucesso!')</script>";
            echo "<script>window.location='ClienteListarView.php'</script>";
        } else {
            echo "<script>alert('Alguns campos não foram informados, tente novamente')</script>";
        }
    }
    public function remove($id)
    {
        $objModel = $this->model::find($id);
        if (empty($objModel)) {
            echo "<script>alert('O ID informado não exite!')</script>";
            echo "<script>window.location='ClienteListarView.php'</script>";
        } else {
            $this->model::deletar($id);
            echo "<script>alert('Registro removido com sucesso!')</script>";
            echo "<script>window.location='ClienteListarView.php'</script>";
        }
    }
    public function search($dados)
    {
        $result = $this->model::search($dados);

        return $result;
    }
}
