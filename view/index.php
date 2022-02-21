<div class="container" id="cadastro">
    <div class="row">
            <h2>Cadastro</h2>
            <form action="login" method="post">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control campo" required  placeholder="Nome">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="email">Endereço de e-mail</label>
                            <input type="email" name="email" class="form-control campo"  required  placeholder="Email">
                        </div>           
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" name="senha" class="form-control campo" required  placeholder="Senha">
                        </div>
                    </div>                                        
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="insert" id="insert">
                        </div>
                </div>
            </form>  
    </div>
</div>
<div class="container" id="updatedelete">
    <div class="row">
        <h2>Update/Delete</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Senha</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        foreach ($listagem as $chave => $valor){
                    ?>
                    
                    <tr>
                        <form action="login" method="post">

                            <td scope="row"><?php echo $valor['id']; ?></td>
                            <td><input type ="text" name="nome"  value="<?php echo $valor['nome'];  ?>"></td>
                            <td><input type ="email" name="email" value="<?php echo $valor['email']; ?>"></td>
                            <td><input type ="password" name="senha" value="<?php echo $valor['senha']; ?>"></td>
                            <td>
                            <input type="hidden" name="id" value="<?php echo $valor['id']; ?>">
                            <input type="submit" class="btn btn-success" name="update" value="Editar">
                            </td>
                        
                        </form>
                        <form action="login" method="post">
                            
                            <td>
                            <input type="hidden" name="id" value="<?php echo $valor['id']; ?>"> 
                            <input type="submit" class="btn btn-danger" name="delete" value="Excluir">
                            </td>
                            
                        </form>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>
    </div>
</div>