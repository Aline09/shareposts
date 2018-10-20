<?php require APPROOT . '/views/inc/header.php';?>
    <div class="row">
     <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
        <h2>Crie sua conta</h2>
        <p>Por favor preencha o formulário abaixo:</p>
        <form action="<?php echo URLROOT;?>/usuarios/registrar" method="POST">

        <div class="form-group">
        <label for="nome">Nome: <sup>*</sup></label>
        <input type="text" name="nome" class="form-control form-control-lg <?php echo (!empty($data['erro_nome'])) ? 'is-invalid' : ' ';?>" value="<?php echo $data['nome'];?>">
        <span class="invalid-feedback">
        <?php echo $data['erro_nome'];?>
        </span>
        </div>

        <div class="form-group">
        <label for="email">Email: <sup>*</sup></label>
        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['erro_email'])) ? 'is-invalid' : ' ';?>"value="<?php echo $data['email'];?>">
        <span class="invalid-feedback">
        <?php echo $data['erro_email'];?>
        </span>
        </div>

        <div class="form-group">
        <label for="senha">Senha: <sup>*</sup></label>
        <input type="password" name="senha" class="form-control form-control-lg <?php echo (!empty($data['erro_senha'])) ? 'is-invalid' : ' ';?>"value="<?php echo $data['nome'];?>">
        <span class="invalid-feedback">
        <?php echo $data['erro_senha'];?>
        </span>
        </div>

        <div class="form-group">
        <label for="confirma_senha">Confirme sua senha: <sup>*</sup></label>
        <input type="password" name="confirma_senha" class="form-control form-control-lg <?php echo (!empty($data['confirma_senha_err'])) ? 'is-invalid' : ' ';?>"value="<?php echo $data['confirma_senha'];?>">
        <span class="invalid-feedback">
        <?php echo $data['confirma_senha_err'];?>
        </span>
        </div>

        <div class="row">
            <div class="col">
                <input type="submit" value="Registre-se!" class="btn btn-success btn-black">
            </div>
            <div class="col">
            <a href="<?php echo URLROOT;?>/usuarios/logar" class="btn btn-light btn-block">Já possui uma conta? Entre!</a>
            </div>
        </div>

        </form>
     </div>
    </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php';?>