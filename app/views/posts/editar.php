<?php require APPROOT . '/views/inc/header.php'?>
    <a href="<?php echo URLROOT;?>/posts" class="btn btn-light">Voltar</a>
        <div class="card card-body bg-light mt-5">
        
        <h2>Edite seu post:</h2>
        <p>Crie novas ideias!</p>
        <form action="<?php echo URLROOT;?>/posts/editar/<?php echo $data['id'];?>" method="POST">


        <div class="form-group">
        <label for="titulo">Título: <sup>*</sup></label>
        <input type="text" name="titulo" class="form-control form-co trol-lg <?php echo (!empty($data['erro_titulo'])) ? 'is-invalid' : '';?>"value="<?php echo $data['titulo'];?>">
        <span class="invalid-feedback">
        <?php echo $data['erro_titulo'];?>
        </span>
        </div>

        <div class="form-group">
        <label for="senha">Texto: <sup>*</sup></label>
        <textarea name="texto" class="form-control form-co trol-lg <?php echo (!empty($data['erro_texto'])) ? 'is-invalid' : '';?>";?><?php echo $data['texto'];?></textarea>
        <span class="invalid-feedback">
        <?php echo $data['erro_texto'];?>
        </span>
        </div>

     
            <div class="col">
                <input type="submit" value="Editar" class="btn btn-success btn-black">
            </div>
            
       

        </form>
     </div>

<?php require APPROOT . '/views/inc/footer.php'?>