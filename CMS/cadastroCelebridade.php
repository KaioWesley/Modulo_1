<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $sobre = null;
    $imagem = null;
    $tela = null;
    $botao = "Cadastrar";

    require_once('CadastroImagens.php');

    if(isset($_POST['btnCadastro'])){
        $sobre = $_POST['txtSobre'];
        
        
        
        
        
        if($_POST['btnCadastro']=="Cadastrar"){
            $imagem = imagens($_FILES['imgFoto']);
            $tela = imagens($_FILES['imgBanner']);
            if($imagem == null || $tela == null){
                echo("erro");
            }else{
                $sql = "INSERT INTO tbl_celebridade
        (informacao, foto, banner)
        VALUES ('".$sobre."', '".$imagem."', '".$tela."')";
            
    }
                
            }else if($_POST['btnCadastro']=="Editar"){
                $imagem = imagens($_FILES['imgFoto']);
                $tela = imagens($_FILES['imgBanner']);
                
            if($imagem == null && $tela == null){
                
                $sql="UPDATE tbl_celebridade SET informacao = '".$sobre."' WHERE idCelebridade=".$_SESSION['idCelebridade'];
                
            }else if($imagem != null && $tela == null){
                $sql="UPDATE tbl_celebridade SET informacao = '".$sobre."', foto = '".$imagem."' WHERE idCelebridade=".$_SESSION['idCelebridade'];
                
            }else if($imagem == null && $tela != null){
                $sql="UPDATE tbl_celebridade SET informacao = '".$sobre."', banner = '".$tela."' WHERE idCelebridade=".$_SESSION['idCelebridade'];
            }else{
                $sql="UPDATE tbl_celebridade SET informacao = '".$sobre."', foto = '".$imagem."', banner = '".$tela."' WHERE idCelebridade=".$_SESSION['idCelebridade'];
            }
            
        
    }
            
    mysqli_query($conexao, $sql);
        
    //echo($sql);

    header('location:CadastroCelebridade.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idCelebridade'];
            $sql = "DELETE FROM tbl_celebridade where idCelebridade=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:CadastroCelebridade.php');
            
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idCelebridade'];
            
            $_SESSION['idCelebridade'] = $codigo;
            $sql = "SELECT * FROM tbl_celebridade where idCelebridade=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
           
            
            if($rsEnd=mysqli_fetch_array($select)){
                $sobre = $rsEnd['informacao'];
                $imagem = $rsEnd['foto'];
                $tela = $rsEnd['banner'];
            }
        }
    }

?>

<html>
	<head>
		<title>

		</title>
         <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
        <div class="principal">
            <header>
                <h3>Gerenciador Bugs Bunny</h3>
                <div class="logo"><img src="Imagens/Bunny.png"></div>
            </header>
            <nav>
                <div class="alinhar">
                    <div class="link">
                        <a href="index.php">
                            <img src="Imagens/Computer.png">
                        </a>
                    </div>
                    <div class="link">
                        <a href="fale_conosco.php">
                            <img src="Imagens/Fale_Conosco.png">
                        </a>
                    </div>
                    <div class="link">
                        <a href="Produtos.php">
                            <img src="Imagens/News.png">
                        </a>
                    </div>
                    <div class="link">
                        <a href="Usuarios.php">
                            <img src="Imagens/User.png">
                        </a>
                    </div>
                    <div class="mensagem">
                        BEM-VINDO(xxx)
                        <br><br><br><br>
                        <a href="#">Logout</a>
                    </div>
                </div>
            </nav>
            <section class="gerenciador">
            
                <form name="frmCadastro" method="post" action="CadastroCelebridade.php" enctype="multipart/form-data">
                    <table border="1">
                        <tr>
                            <td>
                                Sobre a Celebridade:
                            </td>
                            <td>
                                <textarea name="txtSobre" maxlength="350" cols="40" rows="5"><?php echo($sobre)?></textarea>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Imagem:
                            </td>
                            <td>
                                <input type="file" name="imgFoto" value="">
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Banner:
                            </td>
                            <td>
                                <input type="file" name="imgBanner" value="">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <img src="<?php echo($imagem)?>" class="foto">
                            </td>
                            <td>
                                <img src="<?php echo($tela)?>" class="banner">
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="<?php echo($botao)?>" name="btnCadastro"
                                class="botao">
                            </td>
                        </tr>
                        
                    </table>
                </form>    
                
                <table>
                    
                        <tr class="tabela">
                        
                            <td>
                                Foto:
                            </td>
                            <td>
                                Banner:
                            </td>
                            <td>
                                Sobre a celebridade:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_celebridade";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <img src="<?php 
                                
                                    echo($rsEnd['foto'])
                            
                                ?>" class="foto">
                                
                            </td>
                             <td>
                                <img src="<?php 
                                
                                    echo($rsEnd['banner'])
                            
                                ?>" class="banner">
                            </td>
                             
                             <td>
                                <?php 
                                
                                    echo($rsEnd['informacao'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="cadastroCelebridade.php?modo=excluir&idCelebridade=<?php echo($rsEnd['idCelebridade'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="cadastroCelebridade.php?modo=busca&idCelebridade=<?php echo($rsEnd['idCelebridade'])?>">
                                    <img src="Imagens/pencil.png"></a>
                            </td>
                            
                            
                        </tr>
                    <?php }?>
                    </table>
                
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
