<?php require APPROOT . '/views/inc/header.php'?>
<?php  flash('post_mensagem')?>
<div class="row mb-3">

    <div class="col-md-6">
        <h1>Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT;?>/posts/adicionar" class="btn btn-primary float-right">
            Adicionar
        </a>
    </div>
</div>
<?php foreach($data['posts'] as $post) :?>
<div class="card card-body mb-3">
<h4 class="card-title">
<?php echo $post->titulo;?></h4>
<div class="bg-light p-2 mb-3">Escrito por <?php echo $post->nome;?> em <?php echo date('d/m/y', strtotime($post->postCriado));?></div>
<p class="card-text"><?php echo $post->texto;?></p>
<a href="<?php echo URLROOT;?>/posts/mostrar/<?php echo $post->postId;?>" class="btn btn-dark">Veja Mais</a>
</div>
<?php endforeach; ?>
<?php require APPROOT . '/views/inc/footer.php'?>