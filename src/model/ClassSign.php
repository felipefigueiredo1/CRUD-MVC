<?php

namespace crud\model;

use crud\model\ClassConexao;
use PDO;

class ClassSign
{   
    private $id;
    private $name;
    private $email;
    private $senha; 

    //Pegando valores enviados via POST
    public function __construct()
    {
        $this->id    = empty($_POST['id'])    ? null : $_POST['id'];
        $this->name  = empty($_POST['nome'])  ? null : $_POST['nome'];
        $this->email = empty($_POST['email']) ? null : $_POST['email'];
        $this->senha = empty($_POST['senha']) ? null : $_POST['senha'];
    }
   
    //Listando usuários registrados
    public static function listando()
    {
        $query = "SELECT * FROM usuario ORDER BY id ASC";
        $conn = ClassConexao::pegaConexao();
        $dados = $conn->prepare($query);
        $dados->execute();
        $lista = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
        
    }

    //Inserção de usuários
    public function inserindo()
    {
        $query = "INSERT INTO usuario(nome, senha, email) VALUES (:Nome, :Senha, :Email)";
        $conn = ClassConexao::pegaConexao();
        $dados = $conn->prepare($query);
        $dados->bindValue(":Nome", $this->name);
        $dados->bindValue(":Senha", $this->senha);
        $dados->bindValue(":Email", $this->email);
        $dados->execute();
        $row = $dados->rowCount();
        if ($row > 0){
            echo '<script>alert("Usuário criado com sucesso!")</script>';
        } else {
            echo '<script>alert("ERRO usuário já existente!")</script>';
        }
    }

    //Atualização de registros de usuário
    public function atualizando()
    {   
        $query = "UPDATE usuario SET nome=:Nome, senha=:Senha, email=:Email WHERE id=:id";
        $conn = ClassConexao::pegaConexao();
        $dados = $conn->prepare($query);
        $dados->bindValue(":Nome",  $this->name);
        $dados->bindValue(":Senha", $this->senha);
        $dados->bindValue(":Email", $this->email);
        $dados->bindValue(":id",    $this->id);
        $dados->execute();
    }

    //Deleção de usuário
    public function deletando()
    {
        $query = "DELETE FROM usuario WHERE id = :id";
        $conn = ClassConexao::pegaConexao();
        $dados = $conn->prepare($query);
        $dados->bindValue(":id", $this->id);
        $dados->execute();
    }
}