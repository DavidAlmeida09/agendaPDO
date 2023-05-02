<?php

  //classe responsavel de fazer a conexão com o banco de dados
  class Conexao
  {

    private $host = "localhost";
    private $dbname = "task";
    private $user = "root";
    private $pass = "";

    public function conectar()
    {
      try{
        $conexao = new PDO("mysql:host=$this->host;dbname=$this->dbname", "$this->user" ,"$this->pass");
        
        return $conexao;

      }catch(PDOException $erro){
        echo "<p>" .$erro->getMessage() . "</p>";
      }
    }
  }