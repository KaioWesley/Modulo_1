<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $nome = null;
    $botao = "Cadastrar";


    if(isset($_POST['btnCadastro'])){
        $nome = $_POST['txtNome'];
        
        if($_POST['btnCadastro']=="Cadastrar"){
        $sql = "INSERT INTO tbl_subcategoria
        (nome, ativado)
        VALUES ('".$nome."', 1)";
            
    }else if($_POST['btnCadastro']=="Editar"){
        $sql="UPDATE tbl_subcategoria SET nome = '".$nome."' WHERE idSubcategoria=".$_SESSION['idSubcategoria'];
    }
        
        

    mysqli_query($conexao, $sql);
        
    //echo($sql);

    header('location:cadastroSubCategoria.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idSubcategoria'];
            $sql = "DELETE FROM tbl_subcategoria where idSubcategoria=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:cadastroSubCategoria.php');
            
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idSubcategoria'];
            
            $_SESSION['idSubcategoria'] = $codigo;
            $sql = "SELECT * FROM tbl_subcategoria where idSubcategoria=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
            
            
            if($rsEnd=mysqli_fetch_array($select)){
                $nome = $rsEnd['nome'];
            }
        }else if($modo == 'ativado'){
            $codigo = $_GET['idSubcategoria'];
            $_SESSION['idSubcategoria'] = $codigo;
            $sql = "UPDATE tbl_subcategoria SET ativado = 1 WHERE idSubcategoria=".$_SESSION['idSubcategoria'];
            mysqli_query($conexao, $sql);
            header('location:cadastroSubCategoria.php');
            
        //If para desativar conteudo
        }else if($modo == 'desativado'){
            $codigo = $_GET['idSubcategoria'];
            $_SESSION['idSubcategoria'] = $codigo;
            $sql = "UPDATE tbl_subcategoria SET ativado = 2 WHERE idSubcategoria=".$_SESSION['idSubcategoria'];
            mysqli_query($conexao, $sql);
            header('location:cadastroSubCategoria.php');
        }
    }

?>

<html>
	<head>
		<title>

		</title>
         <link rel="stylesheet" type="text/css" href="css/style.css">
        <script type="text/javascript" src="js/mascara.js"></script>
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
                <form name="frmCadastro" method="post" action="cadastroSubCategoria.php">
                    <table border="1">
                        <tr>
                            <td>
                                Nome:
                            </td>
                            <td>
                                <input type="text" value="<?php echo($nome)?>" name="txtNome" required id="nome">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Categoria:
                            </td>
                            <td>
                                <select>
                                    <option>
                                        hga
                                    </option>
                                </select>
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
                                Nome:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_subcategoria";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <?php 
                                
                                    echo($rsEnd['nome'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="cadastroSubCategoria.php?modo=excluir&idSubcategoria=<?php echo($rsEnd['idSubcategoria'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="cadastroSubCategoria.php?modo=busca&idSubcategoria=<?php echo($rsEnd['idSubcategoria'])?>">
                                    <img src="Imagens/pencil.png"></a>
                                
                                <?php
                                    if($rsEnd['ativado'] == 1){?>
                                      
                                <a href="cadastroSubCategoria.php?modo=desativado&idSubcategoria=<?php  echo($rsEnd['idSubcategoria'])?>">
                                    <img src="Imagens/tick.png">
                                </a>
                                    <?php }else{ ?>
                                        <a href="cadastroSubCategoria.php?modo=ativado&idSubcategoria=<?php  echo($rsEnd['idSubcategoria'])?>">
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
