 
<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $nome = null;
    $botao = "Cadastrar";


    if(isset($_POST['btnNivel'])){
        $nome = $_POST['txtNomeNivel'];
        
        if($_POST['btnNivel']=="Cadastrar"){
        $sql = "INSERT INTO tbl_nivel
        (nome)
        VALUES ('".$nome."')";
            
    }else if($_POST['btnNivel']=="Editar"){
        $sql="UPDATE tbl_nivel SET nome = '".$nome."' WHERE idNivel=".$_SESSION['idNivel'];
    }
        
        

    mysqli_query($conexao, $sql);
        
    //  echo($sql);

    header('location:cadastroNivel.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idNivel'];
            $sql = "DELETE FROM tbl_nivel where idNivel=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //Redireciona para página inicial
            header('location:cadastroNivel.php');
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idNivel'];
            
            $_SESSION['idNivel'] = $codigo;
            $sql = "SELECT * FROM tbl_nivel where idNivel=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
            
            
            if($rsNivel=mysqli_fetch_array($select)){
                $nome = $rsNivel['nome'];
                
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
               
                <div class="cadastroNivel">
                    
                    
                
                    <form name="frmCadastro" method="post" action="cadastroNivel.php">
                    
                        <table>
                            <tr>
                                <td>
                                    Nivel:
                                </td>
                                <td>
                                    <input type="text" value="<?php echo($nome) ?>" maxlength="50" name="txtNomeNivel">
                                </td>
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="<?php echo($botao)?>" name="btnNivel"
                                    class="botao">
                                </td>
                            </tr>
                            
                        </table>
                    
                    </form>
                
                </div>
            
                <table>
                    
                        <tr class="tabela">
                        
                            <td>
                                Nivel:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_nivel";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsNivel = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <?php 
                                
                                    echo($rsNivel['nome'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="cadastroNivel.php?modo=excluir&idNivel=<?php echo($rsNivel['idNivel'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="cadastroNivel.php?modo=busca&idNivel=<?php echo($rsNivel['idNivel'])?>">
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
