<?php

//Principal classe do aplicativo MVC
//Pega a url digitada, tranforma numa array e usa esse array para chamar o controller, metodo e param
//O formato da url será: /controller/method/params

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        $url = $this->getUrl();

        //Procura na pasta controllers se existe o primeiro valor da array como arquivo .php. Escrevo o caminho tendo em //mente que estou na index.php na pasta public

        if(file_exists('../app/controllers/' . ucwords($url[0]) . ".php")){
            //Se o arquivo existe ele torna-se o atual controller
            $this->currentController = ucwords($url[0]);
            //Unset index 0
            unset($url[0]);
        }

        //Requer o arquivo do novo controller, a classe

        require_once '../app/controllers/' . $this->currentController . '.php';

        //Instancia o objeto

        $this->currentController = new $this->currentController;

        //Checa se existe o segundo index da array url
        if(isset($url[1])){
        //Checa se o método com esse nome existe no controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod = $url[1];

                unset($url[1]);
            }
        }

        //Pega os parâmetros

        $this->params = $url ? array_values($url) : [];

        //Chama uma callback com uma array de parâmetros

        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
           $url = explode("/", $url);
            return $url;
        }
    }
}