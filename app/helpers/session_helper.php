<?php

session_start();

//Mensagens de funcionamento do sistema para o usuário

function flash($nome = '', $msg = '', $class = 'alert alert-success'){

    if(!empty($nome)){
        if(!empty($msg) && empty($_SESSION[$nome])){
            if(!empty($_SESSION[$nome])){
                unset($_SESSION[$nome]);
            }

            if(!empty($_SESSION[$nome . '_class'])){
                unset($_SESSION[$nome . '_class']);
            }

            $_SESSION[$nome] = $msg;
            $_SESSION[$nome . '_class'] = $class;
        } elseif(empty($msg) && !empty($_SESSION[$nome])){
            $class = !empty($_SESSION[$nome . '_class']) ? $_SESSION[$nome . '_class'] : '';
            
            echo '<div class="'.$class.'" id="msg-flash">' .$_SESSION[$nome] . '</div>';

            unset($_SESSION[$nome]);
            unset($_SESSION[$nome . '_class']);
        }
    }
} 

//Verificar se o usuário está logado

function estaLogado(){
    if(isset($_SESSION['usuario_id'])){
        return true;
    } else{
        return false;
    }
}