<?php require APPROOT . '/views/inc/header.php'?>
    <a href="<?php echo URLROOT;?>/posts" class="btn btn-light">Voltar</a>
    <br>
    <h1><?php echo $data['post']->titulo ?></h1>
   <div class="bg-light text-dark p-2 mb-3">
   Escrito por <?php echo $data['usuario']->nome;?> em <?php echo date('d/m/y', strtotime($data['post']->criado_em))?>
   </div>
   <p><?php echo $data['post']->texto;?></p>
   <?php if($data['post']->id_usuario == $_SESSION['usuario_id']):?>
   <hr>
   <a href="<?php echo URLROOT;?>/posts/editar/<?php echo $data['post']->id?>" class="btn btn-dark">Editar</a>

   <form class="float-right" action="<?php echo URLROOT;?>/posts/deletar/<?php echo $data['post']->id?>" method="POST">
   <input type="submit" value="Deletar" class="btn btn-danger">
   </form>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'?>