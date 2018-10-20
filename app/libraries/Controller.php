<?php

//Classe Base Controller
//Carrega models e views


class Controller{
    //Carrega model
    public function model($model){
        //Requer o arquivo onde está o model
        require_once '../app/models/' . $model . '.php';

    //Instancia a model

    return new $model();

    }

    public function view($view, $data = []){
        //Checa se o arquivo existem em view
        if(file_exists('../app/views/' . $view . '.php')){
            require_once '../app/views/' . $view . '.php';
        } else{
            //Se a view não existe
            die('Essa página não existe!');
        }
    }
}
