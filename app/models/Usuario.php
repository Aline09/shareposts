<?php

class Usuario{
    private $db;

    public function __construct(){
        //Criando um objeto da classe Database
        $this->db = new Database;
    }

    //Adiciona um usuário no banco

    public function registrar($data){
        $this->db->query('INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)');

        $this->db->bind(':nome', $data['nome']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':senha', $data['senha']);

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }


    }

    public function logar($email,$senha){
        $this->db->query('SELECT * from usuarios WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $senha_hash = $row->senha;

        if(password_verify($senha, $senha_hash)){
            return $row;
        } else{
            return false;
        }
    }

    //Procura um usuário no banco pelo seu email

    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM usuarios WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        //Checando se existe uma row

        if($this->db->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }

    public function buscarUsuarioId($id){
        $this->db->query('SELECT * FROM usuarios WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    } 
}