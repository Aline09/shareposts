<?php require APPROOT . '/views/inc/header.php';?>
    <div class="row">
     <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
        <?php flash('registro_sucesso');?>
        <h2>Login</h2>
        <p>Digite seus dados e comece a compartilhar seus posts!</p>
        <form action="<?php echo URLROOT;?>/usuarios/logar" method="POST">


        <div class="form-group">
        <label for="nome">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-co trol-lg <?php echo (!empty($data['erro_email'])) ? 'is-invalid' : '';?>"value="<?php echo $data['email'];?>">
        <span class="invalid-feedback">
        <?php echo $data['erro_email'];?>
        </span>
        </div>

        <div class="form-group">
        <label for="senha">Senha: <sup>*</sup></label>
        <input type="password" name="senha" class="form-control form-co trol-lg <?php echo (!empty($data['erro_senha'])) ? 'is-invalid' : '';?>"value="<?php echo $data['nome'];?>">
        <span class="invalid-feedback">
        <?php echo $data['erro_senha'];?>
        </span>
        </div>

        <div class="row">
            <div class="col">
                <input type="submit" value="Entre!" class="btn btn-success btn-black">
            </div>
            <div class="col">
            <a href="<?php echo URLROOT;?>/usuarios/registrar" class="btn btn-light btn-block">Ainda não possui uma conta? Registre-se!</a>
            </div>
        </div>

        </form>
     </div>
    </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>