<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $titulo = null;
    $imagem = null;
    $tela = null;
    $botao = "Cadastrar";

    require_once('CadastroImagens.php');

    if(isset($_POST['btnCadastro'])){
        $titulo = $_POST['txtTitulo'];
        
        
        
        
        
        if($_POST['btnCadastro']=="Cadastrar"){
            $imagem = imagens($_FILES['imgFoto']);
            $tela = imagens($_FILES['imgBanner']);
            if($imagem == null || $tela == null){
                echo("erro");
            }else{
                $sql = "INSERT INTO tbl_noticia
        (titulo, imagem, banner, ativado)
        VALUES ('".$titulo."', '".$imagem."', '".$tela."', 1)";
            
    }
                
            }else if($_POST['btnCadastro']=="Editar"){
                $imagem = imagens($_FILES['imgFoto']);
                $tela = imagens($_FILES['imgBanner']);
                
            if($imagem == null && $tela == null){
                
                $sql="UPDATE tbl_noticia SET titulo = '".$titulo."' WHERE idNoticia=".$_SESSION['idNoticia'];
                
            }else if($imagem != null && $tela == null){
                $sql="UPDATE tbl_noticia SET titulo = '".$titulo."', imagem = '".$imagem."' WHERE idNoticia=".$_SESSION['idNoticia'];
                
            }else if($imagem == null && $tela != null){
                $sql="UPDATE tbl_noticia SET titulo = '".$titulo."', banner = '".$tela."' WHERE idNoticia=".$_SESSION['idNoticia'];
            }else{
                $sql="UPDATE tbl_noticia SET titulo = '".$titulo."', imagem = '".$imagem."', banner = '".$tela."' WHERE idNoticia =".$_SESSION['idNoticia'];
            }
            
        
    }
            
    mysqli_query($conexao, $sql);
        
    //echo($sql);

    header('location:CadastroNoticias.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idNoticia'];
            $sql = "DELETE FROM tbl_noticia where idNoticia=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:CadastroNoticias.php');
            
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idNoticia'];
            
            $_SESSION['idNoticia'] = $codigo;
            $sql = "SELECT * FROM tbl_noticia where idNoticia=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
           
            
            if($rsEnd=mysqli_fetch_array($select)){
                $titulo = $rsEnd['titulo'];
                $imagem = $rsEnd['imagem'];
                $tela = $rsEnd['banner'];
            }
        }else if($modo == 'ativado'){
            $codigo = $_GET['idNoticia'];
            $_SESSION['idNoticia'] = $codigo;
            $sql = "UPDATE tbl_noticia SET ativado = 1 WHERE idNoticia=".$_SESSION['idNoticia'];
            mysqli_query($conexao, $sql);
            header('location:CadastroNoticias.php');
            
        //If para desativar conteudo
        }else if($modo == 'desativado'){
            $codigo = $_GET['idNoticia'];
            $_SESSION['idNoticia'] = $codigo;
            $sql = "UPDATE tbl_noticia SET ativado = 2 WHERE idNoticia=".$_SESSION['idNoticia'];
            mysqli_query($conexao, $sql);
            header('location:CadastroNoticias.php');
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
                            <img src="Imagens/Computer.png"> <br>Adm.Conteudo
                        </a>
                    </div>
                    <div class="link">
                        <a href="fale_conosco.php">
                            <img src="Imagens/Fale_Conosco.png"> <br>Adm.Fale Conosco
                        </a>
                    </div>
                    <div class="link">
                        <a href="Produtos.php">
                            <img src="Imagens/News.png"> <br>Adm.Produtos
                        </a>
                    </div>
                    <div class="link">
                        <a href="Usuarios.php">
                            <img src="Imagens/User.png"> <br>Adm.Usuarios
                        </a>
                    </div>
                    <div class="mensagem">
                        BEM-VINDO, <?php echo($_SESSION['nome'])?>.
                        <br><br><br><br>
                        <a href="../login.php?modo=logout ">    <span>Logout</span>
                        </a>
                    </div>
                </div>
            </nav>
            <section class="gerenciador">
            
                <form name="frmCadastro" method="post" action="CadastroNoticias.php" enctype="multipart/form-data">
                    <table border="1">
                        <tr>
                            <td>
                                Titulo da Noticia:
                            </td>
                            <td>
                                <input type="text" name="txtTitulo" value="<?php echo($titulo)?>">
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Imagem:
                            </td>
                            <td>
                                <input type="file" name="imgFoto">
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Banner:
                            </td>
                            <td>
                                <input type="file" name="imgBanner">
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                                <img src="<?php echo($imagem)?>" class="banner">
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
                                Imagem:
                            </td>
                            <td>
                                Banner:
                            </td>
                            <td>
                                Titulo:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_noticia";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <img src="<?php 
                                
                                    echo($rsEnd['imagem'])
                            
                                ?>" class="banner">
                                
                            </td>
                             <td>
                                 <img src="<?php 
                                
                                    echo($rsEnd['banner'])
                            
                                ?>" class="banner">
                                
                            </td>
                             
                             <td>
                                <?php 
                                
                                    echo($rsEnd['titulo'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="cadastroNoticias.php?modo=excluir&idNoticia=<?php echo($rsEnd['idNoticia'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="cadastroNoticias.php?modo=busca&idNoticia=<?php echo($rsEnd['idNoticia'])?>">
                                    <img src="Imagens/pencil.png"></a>
                                
                                <?php
                                    if($rsEnd['ativado'] == 1){?>
                                      
                                <a href="cadastroNoticias.php?modo=desativado&idNoticia=<?php  echo($rsEnd['idNoticia'])?>">
                                    <img src="Imagens/tick.png">
                                </a>
                                    <?php }else{ ?>
                                        <a href="cadastroNoticias.php?modo=ativado&idNoticia=<?php  echo($rsEnd['idNoticia'])?>">
                                        <img src="Imagens/cross.png">
                                    </a>
                                    
                                   <?php } ?>
                                
                            </td>
                            
                            
                        </tr>
                    <?php }?>
                    </table>
                
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
