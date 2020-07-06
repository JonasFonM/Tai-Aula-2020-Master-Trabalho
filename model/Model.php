<?php
include '../../Config.php';

class Model
{

    private static $table;

    public static function setTable($nomeTabela)
    {
        self::$table = $nomeTabela;
    }

    public static function getTable()
    {
        return self::$table;
    }


    //metodo para conexao com o banco de dados
    public static function connection()
    {
        $str_conn = Config::BD_TIPO . ":host=" . Config::BD_HOST .
            ";dbname=" . Config::BD_NOME . ";port=" . Config::BD_PORTA;

        //retorna um objeto PDO com os seus atributos e metodos para manipular o Banco de dado
        return new PDO(
            $str_conn,
            Config::BD_USUARIO,
            Config::BD_SENHA,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . Config::BD_CHARSET)
        );
    }

    public static function selectAll($diffTable = '')
    {
        $nameTable = !empty($diffTable) ? $diffTable : self::getTable();

        $conn = self::connection(); // conecta o banco de dados
        //prepara o select da tabela
        $stmt = $conn->prepare("SELECT * FROM $nameTable order by id desc");
        //executa o SQL
        $stmt->execute();
        //retorna a execução no formato de um Array
        return $stmt;
    }

    //funcao para buscar um registro no banco de dados através de um ID
    public static function find($id, $diffTable = "")
    {
        $nameTable = !empty($diffTable) ? $diffTable : self::getTable();

        $conn = self::connection(); // conecta o banco de dados
        //prepara o select da tabela fazendo um Where pelo id
        $stmt = $conn->prepare("SELECT * FROM $nameTable WHERE id = ?");
        //executa o SQL
        $stmt->execute([$id]);
        //retorna a execução no formato de um objeto
        return $stmt->fetchObject();
    }

    //funcao para logar no sistema
    public static function logar($login, $senha)
    {
        $conn = self::connection(); // conecta o banco de dados
        //prepara o select da tabela fazendo um Where pelo id
        $stmt = $conn->prepare("SELECT * FROM usuario WHERE login = ? AND senha = ? AND ativo = 1");
        //executa o SQL
        $stmt->execute([$login, $senha]);
        //retorna a execução no formato de um objeto
        return $stmt->fetchObject();
    }

    //funcao para buscar um registro no banco de dados através de um Campo
    public static function search($dados)
    {
        $nomeTabela = self::getTable();
        $campo = $dados['tipo'];

        $conn = self::connection(); // conecta o banco de dados
        //prepara o select da tabela fazendo um Where pelo nome utilizando o ignoreCase com o BINARY
        //a variavel $campo ficou representando a coluna da tabela
        $stmt = $conn->prepare("SELECT * FROM $nomeTabela WHERE $campo LIKE ?;");
        //executa o SQL colocando % para para realizar a busca do registro
        $stmt->execute(["%" . $dados['valor'] . "%"]);
        //retorna a execução no formato de um objeto
        return $stmt;
    }

    //funcao para atualziar os dados de um formulario
    public static function update($dados, $diffTable = "")
    {
        $nameTable = !empty($diffTable) ? $diffTable : self::getTable();
        $id = $dados['id'];

        //sintaxe do SQL para atualizar um cliente
        $sql = "UPDATE $nameTable SET ";

        $flag = 0;
        $arrayValue = [];
        foreach ($dados as $campo => $valor) {
            $sql .= $flag == 0 ? "$campo = ?" : ", $campo = ?";

            $flag = 1;
            $arrayValue[] = $valor;
        }

        $sql .= " WHERE id = $id;";

        $conn = self::connection(); //conecta ao banco de dados
        //prepara o SQL
        $stmt = $conn->prepare($sql);
        //execulta o SQL substituindo onde tem a iterrogacao pelos parametros 
        //passados atraves do vetor seguindo a mesma sequencia da esqueda para direita
        //o ultimo e o id representa o registro que sera alterado
        $stmt->execute($arrayValue);

        //retorna verdadeiro ou falso se executou a operacao
        return $stmt;
    }

    //funcao para realizer o insert de um registro no banco de dado 
    public static  function insert($dados)
    {
        $nameTable = self::getTable();
        //sql do Insert
        $sql = "INSERT INTO $nameTable(";

        $flag = 0;
        foreach ($dados as $campo => $valor) {
            $sql .= ($flag == 0 ? $campo : ", $campo");

            $flag = 1;
        }

        $sql .= ") VALUES (";

        $flag = 0;
        $arrayValue = [];
        foreach ($dados as $campo => $valor) {

            $sql .= ($flag == 0 ? " ? " : ", ?");
            $flag = 1;

            $arrayValue[] = $valor;
        }

        $sql .= ");";

        $conn = self::connection(); //conecta ao banco de dado
        //prepara o SQL
        $stmt = $conn->prepare($sql);
        //execulta o SQL substituindo onde tem a iterrogacao pelos parametros 
        //passados atraves do vetor seguindo a mesma sequencia da esqueda para direita
        $stmt->execute($arrayValue);

        return $stmt;
    }

    //funcao para deletar um registro no banco de dados através de um ID
    public static function deletar($id, $diffTable = "")
    {
        $nameTable = !empty($diffTable) ? $diffTable : self::getTable();

        $conn = self::connection(); // conecta o banco de dados
        //prepara o deletar o registro da tabela fazendo um Where pelo id
        $stmt = $conn->prepare("DELETE FROM $nameTable WHERE `id` = ?;");
        //executa o SQL
        $stmt->execute([$id]);
        //retorna a execução no formato de um objeto
        return $stmt;
    }
}
