<?php

namespace crud\model;

use crud\model\ClassConnection;
use PDO;

class ClassSign extends ClassValidation
{   
    protected $id;
    protected $name;
    protected $email;
    protected $password;

    /**
     * Pegando valores enviados via POST
     */
    public function __construct()
    {
        $this->id          = empty($_POST['id'])       ? null : $_POST['id'];
        $this->name        = empty($_POST['name'])     ? null : $_POST['name'];
        $this->email       = empty($_POST['email'])    ? null : $_POST['email'];
        $this->password    = empty($_POST['password']) ? null : $_POST['password'];
    }
    
    /**
     * Listando usuários registrados
     * @return array $lista
     */
    public static function listing()
    {
        $query = "SELECT * FROM user ORDER BY id ASC";
        $conn  = ClassConnection::getConnection();
        $dados = $conn->prepare($query);
        $dados->execute();
        $lista = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $lista;   
    }

    /**
     * Inserção de usuários
     * @return string
     */
    public function inserting()
    {
        //Inicia função de validação de email
        if($this->verifyEmail() == true){
            
            //Inicia função de limpeza de variaveis
            $this->cleanData();
            
            $query = "INSERT INTO user(name, password, email) VALUES (:name, :password, :email)";
            $conn  = ClassConnection::getConnection();
            $dados = $conn->prepare($query);
            $dados->bindValue(":name", $this->name);
            $dados->bindValue(":password", $this->password);
            $dados->bindValue(":email", $this->email);
            $dados->execute();
            $row   = $dados->rowCount();

            if ($row > 0){
                echo '<script>alert("Usuário criado com sucesso!")</script>';
            } else {
                echo '<script>alert("ERRO usuário já existente!")</script>';
            }

        } else {
            echo '<script>alert("E-mail inválido")</script>';
        }
    }

    /**
     * Atualização de registros de usuário
     * @return string
     */
    public function updating()
    {   
        //Inicia função de validação de email
        if($this->verifyEmail() == true) {

            //Inicia função de limpeza de variaveis
            $this->cleanData();
            
            $query = "UPDATE user SET name=:name, password=:password, email=:email WHERE id=:id";
            $conn = ClassConnection::getConnection();
            $dados = $conn->prepare($query);
            $dados->bindValue(":name",  $this->name);
            $dados->bindValue(":password", $this->password);
            $dados->bindValue(":email", $this->email);
            $dados->bindValue(":id",    $this->id);
            $dados->execute();
            if($dados) {
                echo '<script>alert("Editado com sucesso!")</script>';
            } else {
                echo '<script>alert("ERRO não é possivel editar!")</script>';
            }
        } else {
            echo '<script>alert("E-mail inválido")</script>';
        }    
    }

    /**
     * Deleção de usuário
     * @return string
     */
    public function deleting()
    {
        $query = "DELETE FROM user WHERE id = :id";
        $conn = ClassConnection::getConnection();
        $dados = $conn->prepare($query);
        $dados->bindValue(":id", $this->id);
        $dados->execute();
        if($dados) {
            //echo '<script>alert("Deletado com sucesso!")</script>';
            ClassSign::listing();
        } else {
            echo '<script>alert("ERRO não é possivel deletar!")</script>';
        }
    }
}