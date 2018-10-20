<?php

class Post{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }

    public function buscarPosts(){
        $this->db->query('SELECT *,
            posts.id as postId,
            usuarios.id as usuarioId,
            posts.criado_em as postCriado,
            usuarios.criado_em as usuarioCriado
            FROM posts
            INNER JOIN usuarios 
            ON posts.id_usuario = usuarios.id
            ORDER BY posts.criado_em DESC 
         ');
        return $this->db->resultSet();
    }

    public function buscarPostId($id){
        $this->db->query('SELECT * FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function inserirPost($data){
        $this->db->query('INSERT INTO posts (titulo, id_usuario, texto) values (:titulo, :usuario_id, :texto)');
        $this->db->bind(':titulo', $data['titulo']);
        $this->db->bind(':usuario_id', $data['usuario_id']);
        $this->db->bind(':texto', $data['texto']);

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }
    }

    public function alterarPost($data){
        $this->db->query('UPDATE posts SET titulo = :titulo, texto = :texto WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':titulo', $data['titulo']);
        
        $this->db->bind(':texto', $data['texto']);

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }
    }
   
    public function deletarPost($id){
        $this->db->query('DELETE FROM posts WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else{
            return false;
        }

    }
}