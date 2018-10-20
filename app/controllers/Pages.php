<?php

class Pages extends Controller{
    public function __construct(){
        
    }

    public function index(){
        if(estaLogado()){
            redirecionar('posts');
        }

        $data = [
            'titulo' => 'SharePosts',
            'descricao' => 'Aplicação construída sobre o Framework myMVC'];

       $this->view('pages/index', $data);
    }

    public function about(){
        $data = ['titulo' => 'Sobre nós',
                'descricao' => 'App criado sobre o framework PHP myMVC. Compartilhe seus posts com outros usuários!'];
        $this->view('pages/about', $data);
    }
}