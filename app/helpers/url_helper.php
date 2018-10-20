<?php

//Redireciona páginas

function redirecionar($pagina){
    header('location: ' . URLROOT . '/' . $pagina);
}