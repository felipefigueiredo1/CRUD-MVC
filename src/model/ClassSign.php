<?php

namespace crud\model;

use crud\model\ClassConnection;
use PDO;

class ClassSign
{   
    private $id;
    private $name;
    private $email;
    private $password;

    //Pegando valores enviados via POST
    public function __construct()
    {
        $this->id          = empty($_POST['id'])       ? null : $_POST['id'];
        $this->name        = empty($_POST['name'])     ? null : $_POST['name'];
        $this->email       = empty($_POST['email'])    ? null : $_POST['email'];
        $this->password    = empty($_POST['password']) ? null : $_POST['password'];
    }
    
    //Pegando as variaveis de cadastro para limpeza
    private function cleanData()
    {
        $this->id          = $this->cleanVar($this->id);
        $this->name        = $this->cleanVar($this->name);
        $this->password    = $this->cleanVar($this->password);
    }
    
    //Limpando as variaveis de cadastro
    private function cleanVar($values)
    {
        $values           = filter_var($values, FILTER_SANITIZE_STRING);
        $character        = array("<", ">", "@", ";", "[", "]", "(", ")", "{", "}", "/", "\\", "--", "`", "´");
        $values           = str_replace($character, "", $values);
        return trim($values);
    }

    //Pegando e-mail para verificação
    private function verifyEmail()
    {
        return $this->verifyEmailVar($this->email);
    }

    //Verificando se o e-mail é válido
    private function verifyEmailVar($value)
    {
        $value = filter_var($value, FILTER_VALIDATE_EMAIL);
        return $value; 
    }

    //Listando usuários registrados
    public static function listing()
    {
        $query = "SELECT * FROM user ORDER BY id ASC";
        $conn  = ClassConnection::getConnection();
        $dados = $conn->prepare($query);
        $dados->execute();
        $lista = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $lista;
        
    }

    //Inserção de usuários
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

    //Atualização de registros de usuário
    public function updating()
    {   
        $query = "UPDATE usuario SET name=:name, password=:password, email=:email WHERE id=:id";
        $conn = ClassConnection::getConnection();
        $dados = $conn->prepare($query);
        $dados->bindValue(":name",  $this->name);
        $dados->bindValue(":password", $this->password);
        $dados->bindValue(":email", $this->email);
        $dados->bindValue(":id",    $this->id);
        $dados->execute();
    }

    //Deleção de usuário
    public function deleting()
    {
        $query = "DELETE FROM user WHERE id = :id";
        $conn = ClassConnection::getConnection();
        $dados = $conn->prepare($query);
        $dados->bindValue(":id", $this->id);
        $dados->execute();
    }
}