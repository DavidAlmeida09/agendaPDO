<?php

  //classe responsavel de fazer as operações de CRUD
  
  class TarefaService
  {
    private $conexao;
    private $tarefa;

    //Essa função está recebendo a conexão e a tarefa
    public function __construct(Conexao $conexao, Tarefa $tarefa)
    {
      //chama o método conectar da classe conexao
      $this->conexao = $conexao->conectar();
      $this->tarefa = $tarefa;
    }

    public function inserir()
    {
      $query = "INSERT INTO tb_tarefas(tarefa)VALUES(:tarefa)";
      $stmt = $this->conexao->prepare($query);
      $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
      $stmt->execute();

    }

    public function recuperar()
    {
      $query = "SELECT t.id, s.status, t.tarefa FROM tb_tarefas AS t LEFT JOIN tb_status as s ON (t.id_status=s.id)";
      $stmt = $this->conexao->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function atualizar()
    {
      $query = "UPDATE tb_tarefas SET tarefa = :tarefa WHERE id =:id";
      $stmt = $this->conexao->prepare($query);
      $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
      $stmt->bindValue(':id', $this->tarefa->__get('id'));
      return $stmt->execute();
      

    }

    public function remover()
    {
      $query = "DELETE FROM tb_tarefas WHERE id=:id LIMIT 1";
      $stmt = $this->conexao->prepare($query);
      $stmt->bindValue(':id', $this->tarefa->__get('id'));
      $stmt->execute();


    }

    public function realizada()
    {
      $query = "UPDATE tb_tarefas SET id_status = :tarefa WHERE id =:id";
      $stmt = $this->conexao->prepare($query);
      $stmt->bindValue(':tarefa', $this->tarefa->__get('id_status'));
      $stmt->bindValue(':id', $this->tarefa->__get('id'));
      return $stmt->execute();
      

    }

    public function pendentes()
    {
      $query = "SELECT t.id, s.status, t.tarefa FROM tb_tarefas AS t LEFT JOIN tb_status as s ON (t.id_status=s.id) WHERE t.id_status = :id_status";
      $stmt = $this->conexao->prepare($query);
      $stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
  }