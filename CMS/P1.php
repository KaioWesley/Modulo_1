<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $par1 = null;
    $imagem = null;
    $par2 = null;
    $botao = "Cadastrar";

    require_once('CadastroImagens.php');

    if(isset($_POST['btnCadastro'])){
        $par1 = $_POST['txtPar1'];
        $par2 = $_POST['txtPar2'];
        
        
        
        
        
        if($_POST['btnCadastro']=="Cadastrar"){
            $imagem = imagens($_FILES['imgPar1']);
            if($imagem == null){
                echo("erro");
            }else{
                $sql = "INSERT INTO tbl_criacao
        (paragrafo1, paragrafo2, icone, ativado)
        VALUES ('".$par1."', '".$par2."', '".$imagem."', 1)";
            
    }
                
            }else if($_POST['btnCadastro']=="Editar"){
                $imagem = imagens($_FILES['imgPar1']);
                
            if($imagem == null){
                
                $sql="UPDATE tbl_criacao SET paragrafo1 = '".$par1."', paragrafo2 = '".$par2."' WHERE idCriacao=".$_SESSION['idCriacao'];
                
            }else{
                $sql="UPDATE tbl_criacao SET paragrafo1 = '".$par1."', paragrafo2 = '".$par2."', icone = '".$imagem."' WHERE idCriacao=".$_SESSION['idCriacao'];
            }
            
        
    }
            
    mysqli_query($conexao, $sql);
        
    //echo($sql);

    header('location:P1.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idCriacao'];
            $sql = "DELETE FROM tbl_criacao where idCriacao=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:P1.php');
            
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idCriacao'];
            
            $_SESSION['idCriacao'] = $codigo;
            $sql = "SELECT * FROM tbl_criacao where idCriacao=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
           
            
            if($rsEnd=mysqli_fetch_array($select)){
                $par1 = $rsEnd['paragrafo1'];
                $imagem = $rsEnd['icone'];
                $par2 = $rsEnd['paragrafo2'];
            }
        }else if($modo == 'ativado'){
            $codigo = $_GET['idCriacao'];
            $_SESSION['idCriacao'] = $codigo;
            $sql = "UPDATE tbl_criacao SET ativado = 1 WHERE idCriacao=".$_SESSION['idCriacao'];
            mysqli_query($conexao, $sql);
            header('location:P1.php');
            
        //If para desativar conteudo
        }else if($modo == 'desativado'){
            $codigo = $_GET['idCriacao'];
            $_SESSION['idCriacao'] = $codigo;
            $sql = "UPDATE tbl_criacao SET ativado = 2 WHERE idCriacao=".$_SESSION['idCriacao'];
            mysqli_query($conexao, $sql);
            header('location:P1.php');
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
               
                <form name="frmCadastro" method="post" action="P1.php" enctype="multipart/form-data">
                    <table border="1">
                        <tr>
                            <td>
                                Icone 128x128
                            </td>
                            <td>
                                <input type="file" name="imgPar1" required>
                            </td>
                            
                        </tr>
                        
                        <tr>
                            <td>
                                Paragrafo 1:
                            </td>
                            <td>
                                <textarea name="txtPar1" maxlength="160" cols="30" rows="5" required><?php echo($par1)?></textarea>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Paragrafo 2:
                            </td>
                            <td>
                                <textarea name="txtPar2" maxlength="160" cols="30" rows="5" required><?php echo($par2)?></textarea>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <input type="submit" value="<?php echo($botao)?>" name="btnCadastro"
                                class="botao">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="tabela">
                                Para não ter problemas no design é aconselhavel manter somente 1 cadastro ativado
                            </td>
                            
                        </tr>
                        <tr>
                            <td colspan="2">
                                <img src="<?php echo($imagem)?>" class="icone">
                            </td>
                            
                        </tr>
                        
                    </table>
                </form>    
                
                <table>
                    
                        <tr class="tabela">
                        
                            <td>
                                Icone:
                            </td>
                            <td>
                                Paragrafo 1:
                            </td>
                            <td>
                                Paragrafo 2:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_criacao";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <img src="
                                <?php 
                                
                                    echo($rsEnd['icone'])
                            
                                ?>" class="icone">
                             </td>
                             <td>
                                <?php 
                                
                                    echo($rsEnd['paragrafo1'])
                            
                                ?>
                            </td>
                             
                             <td>
                                <?php 
                                
                                    echo($rsEnd['paragrafo2'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="P1.php?modo=excluir&idCriacao=<?php echo($rsEnd['idCriacao'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="P1.php?modo=busca&idCriacao=<?php echo($rsEnd['idCriacao'])?>">
                                    <img src="Imagens/pencil.png"></a>
                                
                                <?php
                                    if($rsEnd['ativado'] == 1){?>
                                      
                                <a href="P1.php?modo=desativado&idCriacao=<?php  echo($rsEnd['idCriacao'])?>">
                                    <img src="Imagens/tick.png">
                                </a>
                                    <?php }else{ ?>
                                        <a href="P1.php?modo=ativado&idCriacao=<?php  echo($rsEnd['idCriacao'])?>">
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
