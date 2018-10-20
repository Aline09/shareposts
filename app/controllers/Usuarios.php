<?php

class Usuarios extends Controller{
    public function __construct(){
        //Carregando o objeto model
        $this->usuarioModel = $this->model('Usuario');
    }

    
    public function registrar(){
        //Vê se existe post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           //Processa o formulário 
           //Sanitize POST data

           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

           //Pega os dados do formulário
           $data = [
            'nome' => trim($_POST['nome']),
            'email' => trim($_POST['email']),
            'senha' => trim($_POST['senha']),
            'confirma_senha' => trim($_POST['confirma_senha']),
            'erro_nome' => '',
            'erro_email' => '',
            'erro_senha' => '',
            'confirma_senha_err' => ''
        ];

        //Validando nome 

        if(empty($data['nome'])){
            $data['erro_nome'] = 'Digite seu nome';
        }

        //Validando email e setando erro

        if(empty($data['email'])){
            $data['erro_email'] = 'Digite seu email';
        } else{
            //Checar se o email já existe
            if($this->usuarioModel->findUserByEmail($data['email'])){
                $data['erro_email'] = 'Este email já está cadastrado em nosso banco de dados';
            }
        }

        
        //Validando senha

        if(empty($data['senha'])){
            $data['erro_senha'] = 'Digite sua senha';
        } elseif(strlen($data['senha']) < 6){
            $data['erro_senha'] = 'A senha deve ter no mínimo 6 caracteres';
        }

        //Validando a confirmação da senha

        if(empty($data['confirma_senha'])){
            $data['confirma_senha_err'] = 'Confirme sua senha';
        } else {
            if($data['senha'] != $data['confirma_senha']){
                $data['confirma_senha_err'] = 'As senhas digitadas são diferentes';
            }
        }

        //Certificando-se de que todos os erros estão vazios

        if(empty($data['erro_email']) && empty($data['erro_nome']) && empty($data['erro_senha']) && empty($data['confirma_senha_err'])){
        
        //Após a confirmação, mascaramos a senha
        $data['senha'] = password_hash($data['senha'], PASSWORD_DEFAULT);

        //Registrado usuário no banco de dados

        if($this->usuarioModel->registrar($data)){
            flash('registro_sucesso', 'Você está registrado e já pode logar.');
            redirecionar('usuarios/logar');
        } else{
            die('Algo inesperado aconteceu!');
        }

        } else{
            //Carrega a view com erros
            $this->view('usuarios/registrar', $data);
        }

        
        
        } else{
            //Inicia os dados vazios
            $data = [
                'nome' => '',
                'email' => '',
                'senha' => '',
                'confirma_senha' => '',
                'erro_nome' => '',
                'erro_email' => '',
                'erro_senha' => '',
                'confirma_senha_err' => ''
            ];
            $this->view('usuarios/registrar', $data);
        }
       
    }

    public function logar(){
        //Vê se existe post request
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Processa o formulário
            
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //Pega os dados do formulário
            $data = [
             'email' => trim($_POST['email']),
             'senha' => trim($_POST['senha']),
             'erro_email' => '',
             'erro_senha' => '',
            ];

            //Validando email e setando erro
            if(empty($data['email'])){
                $data['erro_email'] = 'Digite seu email';
            }
            //Validando senha e setando erro
            if(empty($data['senha'])){
                $data['erro_senha'] = 'Digite sua senha';
            }

            //Checar se o email já esta cadastrado

            if($this->usuarioModel->findUserByEmail($data['email'])){
                //Se retornar true o usuário existe
            }else{
                //Se não o usuário ainda não foi cadastrado no banco de dados
                $data['erro_email'] = 'Usuário não encontrado!';
            }

            //Verificando se todos os erros estão vazios, se não carrega a view com erros. Se sim submeter o form.

            if(empty($data['erro_email']) && empty($data['erro_senha'])){
                //Formulário Validado
                //Envia os dados para o model verificar email e senha 
                $logado = $this->usuarioModel->logar($data['email'], $data['senha']);

                if($logado){
                    //Se email e senha existem, cria uma variável de sessão para o usuário 
                    $this->criaSessao($logado);
                    
                } else{
                    //Se não, seta um erro para a senha e recarrega a view com erro
                    $data['erro_senha'] = 'Senha incorreta';

                    $this->view('usuarios/logar', $data);
                    
                }
            } else{
                //Carrega a view com erros
                $this->view('usuarios/logar', $data);
            }

         } else{
             //Inicia os dados vazios
             $data = [
                 'email' => '',
                 'senha' => '',
                 'erro_email' => '',
                 'erro_senha' => '',
             ];

             $this->view('usuarios/logar', $data);
         }
        
     }
    
     public function criaSessao($usuario){
        $_SESSION['usuario_id'] = $usuario->id;
        $_SESSION['usuario_email'] = $usuario->email;
        $_SESSION['usuario_nome'] = $usuario->nome;
        redirecionar('posts');
     }

     public function sair(){
         unset($_SESSION['usuario_id']);
         unset($_SESSION['usuario_email']);
         unset($_SESSION['usuario_nome']);

         session_destroy();

         redirecionar('usuarios/logar');
        }

       
    }