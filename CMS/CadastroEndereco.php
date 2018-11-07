<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $nome = null;
    $numero = null;
    $botao = "Cadastrar";


    if(isset($_POST['btnCadastro'])){
        $nome = $_POST['txtEndereco'];
        $numero = $_POST['txtNumero'];
        
        if($_POST['btnCadastro']=="Cadastrar"){
        $sql = "INSERT INTO tbl_endereco
        (logradouro, numero, ativado)
        VALUES ('".$nome."', '".$numero."', 1)";
            
    }else if($_POST['btnCadastro']=="Editar"){
        $sql="UPDATE tbl_endereco SET logradouro = '".$nome."', numero = '".$numero."' WHERE idEndereco=".$_SESSION['idEndereco'];
    }
        
        

    mysqli_query($conexao, $sql);
        
    //echo($sql);

    header('location:CadastroEndereco.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idEndereco'];
            $sql = "DELETE FROM tbl_endereco where idEndereco=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:CadastroEndereco.php');
            
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idEndereco'];
            
            $_SESSION['idEndereco'] = $codigo;
            $sql = "SELECT * FROM tbl_endereco where idEndereco=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
            
            
            if($rsEnd=mysqli_fetch_array($select)){
                $nome = $rsEnd['logradouro'];
                $numero = $rsEnd['numero'];
            }
        }else if($modo == 'ativado'){
            $codigo = $_GET['idEndereco'];
            $_SESSION['idEndereco'] = $codigo;
            $sql = "UPDATE tbl_endereco SET ativado = 1 WHERE idEndereco=".$_SESSION['idEndereco'];
            mysqli_query($conexao, $sql);
            header('location:CadastroEndereco.php');
            
        //If para desativar conteudo
        }else if($modo == 'desativado'){
            $codigo = $_GET['idEndereco'];
            $_SESSION['idEndereco'] = $codigo;
            $sql = "UPDATE tbl_endereco SET ativado = 2 WHERE idEndereco=".$_SESSION['idEndereco'];
            mysqli_query($conexao, $sql);
            header('location:CadastroEndereco.php');
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
                <form name="frmCadastro" method="post" action="CadastroEndereco.php">
                    <table border="1">
                        <tr>
                            <td>
                                Logradouro:
                            </td>
                            <td>
                                <input type="text" value="<?php echo($nome)?>" name="txtEndereco" required onkeypress="return Validar(event,'number', this.id);" id="logradouro">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Numero:
                            </td>
                            <td>
                                <input type="number" value="<?php echo($numero)?>" name="txtNumero" required >
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
                                Logradouro:
                            </td>
                            <td>
                                Numero:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_endereco";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <?php 
                                
                                    echo($rsEnd['logradouro'])
                            
                                ?>
                            </td>
                             <td>
                                <?php 
                                
                                    echo($rsEnd['numero'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="CadastroEndereco.php?modo=excluir&idEndereco=<?php echo($rsEnd['idEndereco'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="CadastroEndereco.php?modo=busca&idEndereco=<?php echo($rsEnd['idEndereco'])?>">
                                    <img src="Imagens/pencil.png"></a>
                                
                                <?php
                                    if($rsEnd['ativado'] == 1){?>
                                      
                                <a href="CadastroEndereco.php?modo=desativado&idEndereco=<?php  echo($rsEnd['idEndereco'])?>">
                                    <img src="Imagens/tick.png">
                                </a>
                                    <?php }else{ ?>
                                        <a href="CadastroEndereco.php?modo=ativado&idEndereco=<?php  echo($rsEnd['idEndereco'])?>">
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
