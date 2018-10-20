<?php 

class Posts extends Controller{
    public function __construct(){
       
        //Verifica se o usuário está logado
        if(!estaLogado()){
            redirecionar('usuarios/logar');
        } 

        //Instancia um objeto model
        $this->modelPost = $this->model('Post');
        $this->usuarioModel = $this->model('Usuario');
    }

    public function index(){
        //Usa o objeto model para pegar os posts
        $posts = $this->modelPost->buscarPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function adicionar(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'titulo' => trim($_POST['titulo']),
                'texto' => trim($_POST['texto']),
                'usuario_id' => $_SESSION['usuario_id'],
                'erro_texto' => '',
                'erro_titulo' => '',
            ];

            if(empty($data['titulo'])){
                $data['erro_titulo'] = 'Por favor, digite um título para o seu post';
            }

            if(empty($data['texto'])){
                $data['erro_texto'] = "Digite seu texto";
            }

            if(empty($data['erro_titulo']) && empty($data['erro_texto'])){
                if($this->modelPost->inserirPost($data)){
                    flash('post_mensagem', 'Post adicionado com sucesso!');
                    redirecionar('posts');
                }else{
                    die('Algo inesperado aconteceu!');
                }
            } else{
                $this->view('posts/adicionar', $data);
            }
            
        } else{
        $data = [
            'titulo' => '',
            'texto' => '',
        ];
        $this->view('posts/adicionar', $data);
    }
}

public function mostrar($id){
    //Um método para mostrar os detalhes do post de acordo com o id que é passado na url
    $post = $this->modelPost->buscarPostId($id);
    $usuario = $this->usuarioModel->buscarUsuarioId($post->id_usuario);
    $data = [
        'post' => $post,
        'usuario' => $usuario
    ];
    
    $this->view('posts/mostrar', $data);
}

public function editar($id){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'id' => $id,
            'titulo' => trim($_POST['titulo']),
            'texto' => trim($_POST['texto']),
            'usuario_id' => $_SESSION['usuario_id'],
            'erro_texto' => '',
            'erro_titulo' => '',
        ];

        if(empty($data['titulo'])){
            $data['erro_titulo'] = 'Por favor, digite um título para o seu post';
        }

        if(empty($data['texto'])){
            $data['erro_texto'] = "Digite seu texto";
        }

        if(empty($data['erro_titulo']) && empty($data['erro_texto'])){
            if($this->modelPost->alterarPost($data)){
                flash('post_mensagem', 'Post alterado com sucesso!');
                redirecionar('posts');
            }else{
                die('Algo inesperado aconteceu!');
            }
        } else{
            $this->view('posts/editar', $data);
        }
        
    } else{
        //Buscando post
        $post = $this->modelPost->buscarPostId($id);

        //Verificando se o usuário é quem postou o post

        if($post->id_usuario !== $_SESSION['usuario_id']){
            redirect('posts');
        }
    
        $data = [
                'id' => $id,
                'titulo' => $post->titulo,
                'texto' => $post->texto,
         ];
    $this->view('posts/editar', $data);
    }
}

    public function deletar($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $this->modelPost->buscarPostId($id);
            if($post->id_usuario !== $_SESSION['usuario_id']){
                redirect('posts');
            }
            if($this->modelPost->deletarPost($id)){
                
                flash('post_mensagem', 'Post removido com sucesso!');
                redirecionar('posts');
            } else{
                die('Algo errado aconteceu!');
            }
        }else{
            redirecionar('posts');
        }
}


    
}