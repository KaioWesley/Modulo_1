<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    $nome = null;
    $email = null;
    $telefone = null;
    $celular = null;
    $dtNasc = null;
    $nivel = null;
    $botao = "Cadastrar";

    session_start();

    

    if(isset($_POST['btnUser'])){
        $nome = $_POST['txtNome'];
        $email = $_POST['txtEmail'];
        $telefone = $_POST['txtTel'];
        $celular = $_POST['txtCel'];
        $dtNasc = $_POST['dtNasc'];
        $nivel = $_POST['cmbNivel'];
        
        if($_POST['btnUser']=="Cadastrar"){
            $sql = "INSERT INTO tbl_user 
            (nome, email, telefone, celular, dtNasc, idNivel)
            VALUES ('".$nome."','".$email."','".$telefone."','".$celular."','".$dtNasc."','".$nivel."')";
        }else if($_POST['btnUser']=="Editar"){
            $sql="UPDATE tbl_user SET nome = '".$nome."', email = '".$email."', telefone = '".$telefone."', celular = '".$celular."', dtNasc = '".$dtNasc."', idNivel = '".$nivel."'
            WHERE idUsuarios=".$_SESSION['idUsuarios'];
        }
        mysqli_query($conexao, $sql);
        //echo($sql);
        header('location:cadastroUser.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idUsuarios'];
            $sql = "DELETE FROM tbl_user WHERE idUsuarios = ".$codigo;
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:cadastroUser.php');
        }
        else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idUsuarios'];
            
            $_SESSION['idUsuarios'] = $codigo;
            //$sql = "SELECT * FROM tbl_user where idUsuarios=".$codigo;
            $sql = "SELECT u.*, n.nome as nomeNivel
            FROM tbl_user as u, tbl_nivel AS n 
            WHERE u.idNivel = n.idNivel AND u.idUsuarios =".$codigo;

            $select = mysqli_query($conexao, $sql);
            
            
            
            
            
            if($rsUser=mysqli_fetch_array($select)){
                $nome = $rsUser['nome'];
                $email = $rsUser['email'];
                $telefone = $rsUser['telefone'];
                $celular = $rsUser['celular'];
                $dtNasc = $rsUser['dtNasc'];
                $nivel = $rsUser['idNivel'];
                $nomeNivel = $rsUser['nomeNivel'];
                
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
               
                <div class="cadastroUser">
                
                    <form name="frmCadastro" method="post" action="cadastroUser.php">
                        
                        <table>
                            <tr class="tabela">
                                <td>
                                    Nome
                                </td>
                                <td>
                                    Data de Nascimento
                                </td>
                                <td>
                                    Telefone
                                </td>
                                <td>
                                    Celular
                                </td>
                                <td>
                                    Email
                                </td>
                                <td>
                                    Nivel
                                </td>
                                <td>
                                    Opções
                                </td>
                            </tr>
                            <?php
                    
                        $sql = "SELECT * FROM tbl_user";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsUser = mysqli_fetch_array($select)){
                    
                    ?>
                            <tr>
                                <td>
                                    <?php 
                                
                                    echo($rsUser['nome'])
                            
                                ?>
                                </td>
                                <td>
                                   <?php 
                                
                                    echo($rsUser['dtNasc'])
                            
                                ?>
                                </td>
                                <td>
                                    <?php 
                                
                                    echo($rsUser['telefone'])
                            
                                ?>
                                </td>
                                <td>
                                    <?php 
                                
                                    echo($rsUser['celular'])
                            
                                ?>
                                </td>
                            
                                <td>
                                   <?php 
                                
                                    echo($rsUser['email'])
                            
                                ?>
                                </td>
                                <td>
                                    <?php 
                                
                                    echo($rsUser['idNivel'])
                            
                                ?>
                                </td>
                                <td>
                                <a href="cadastroUser.php?modo=excluir&idUsuarios=<?php echo($rsUser['idUsuarios'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="cadastroUser.php?modo=busca&idUsuarios=<?php echo($rsUser['idUsuarios'])?>">
                                    <img src="Imagens/pencil.png"></a>
                            </td>
                            
                            </tr>
                        <?php } ?>
                            
                        </table>
                    
                        <table>
                            <tr>
                                <td>
                                    Nome Completo:
                                </td>
                                <td>
                                    <input type="text" maxlength="50" value="<?php echo($nome)?>" name="txtNome">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Data de Nascimento:
                                </td>
                                <td>
                                    <input type="date" value="<?php echo($dtNasc)?>" name="dtNasc">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                    Telefone:
                                
                                </td>
                                <td>
                                    <input type="text" value="<?php echo($telefone)?>" name="txtTel">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Celular:
                                </td>
                                <td>
                                    <input type="text" value="<?php echo($celular)?>" name="txtCel">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email:
                                </td>
                                <td>
                                    <input type="email" value="<?php echo($email)?>" name="txtEmail">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nivel:
                                </td>
                                <td>
                                    <select name="cmbNivel">
                                        
                                        
                                        <?php
                                            if($modo == 'busca'){
                                                
                                                
                                                
                                                ?>
                                        
                                        <option value="<?php echo($nivel)?>" selected> <?php echo($nomeNivel)?> </option>
                                            <?php    
                                            }else{
                                                
                                                $nivel = 0;
                                                ?>
                                        
                                            <option selected>~~SELECIONE UM NIVEL~~</option>
                                        <?php 
                                                
                                            }
                                            
                                        $sql = "SELECT * FROM tbl_nivel WHERE idNivel <>".$nivel;
                    
                                        $select = mysqli_query($conexao, $sql);

                                        while($rsNivel = mysqli_fetch_array($select)){
                                        
                                        ?>
                                        <option value="<?php echo($rsNivel['idNivel'])?>">
                                            <?php 
                                            echo($rsNivel['nome'])?>
                                        </option>
                                        
                                        <?php  } ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="<?php echo($botao); ?>" name="btnUser"
                                    class="botao">
                                </td>
                            </tr>
                            
                        </table>
                    
                    </form>
                
                </div>
            
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
