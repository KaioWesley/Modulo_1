<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $titulo = null;
    $preco = null;
    $botao = "Cadastrar";

    require_once('CadastroImagens.php');

    if(isset($_POST['btnCadastro'])){
        $titulo = $_POST['txtTitulo'];
        $preco = $_POST['txtPreco'];
        
        
        
        
        if($_POST['btnCadastro']=="Cadastrar"){
            $capa = imagens($_FILES['imgCapa']);
            if($capa == null){
                echo("erro");
            }else{
                $sql = "INSERT INTO tbl_promocao
        (titulo, preco, capa, ativado)
        VALUES ('".$titulo."', '".$preco."', '".$capa."', 1)";
            
    }
                
            }else if($_POST['btnCadastro']=="Editar"){
                $capa = imagens($_FILES['imgCapa']);
                
                
            if($capa == null){
                
                $sql="UPDATE tbl_promocao SET titulo = '".$titulo."', preco = '".$preco."' WHERE idPromocao=".$_SESSION['idPromocao'];
                
            }else if($capa != null){
                $sql="UPDATE tbl_promocao SET titulo = '".$titulo."', capa = '".$capa."', preco = '".$preco."' WHERE idPromocao=".$_SESSION['idPromocao'];
                
            }
            
        
    }
        
    mysqli_query($conexao, $sql);
        
    //echo($sql);

    header('location:CadastroPromocao.php');
    }


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['idPromocao'];
            $sql = "DELETE FROM tbl_promocao where idPromocao=".$codigo;
            
            mysqli_query($conexao, $sql);
            
            //echo($sql);
            header('location:CadastroPromocao.php');
            
        }else if($modo == 'busca'){
            $botao = "Editar";
            $codigo = $_GET['idPromocao'];
            
            $_SESSION['idPromocao'] = $codigo;
            $sql = "SELECT * FROM tbl_promocao where idPromocao=".$codigo;
            
            $select = mysqli_query($conexao, $sql);
            
           
            
            if($rsEnd=mysqli_fetch_array($select)){
                $titulo = $rsEnd['titulo'];
                $capa = $rsEnd['capa'];
                $preco = $rsEnd['preco'];
            }
        }else if($modo == 'ativado'){
            $codigo = $_GET['idPromocao'];
            $_SESSION['idPromocao'] = $codigo;
            $sql = "UPDATE tbl_promocao SET ativado = 1 WHERE idPromocao=".$_SESSION['idPromocao'];
            mysqli_query($conexao, $sql);
            header('location:CadastroPromocao.php');
            
        //If para desativar conteudo
        }else if($modo == 'desativado'){
            $codigo = $_GET['idPromocao'];
            $_SESSION['idPromocao'] = $codigo;
            $sql = "UPDATE tbl_promocao SET ativado = 2 WHERE idPromocao=".$_SESSION['idPromocao'];
            mysqli_query($conexao, $sql);
            header('location:CadastroPromocao.php');
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
               <form name="frmCadastro" method="post" action="CadastroPromocao.php" enctype="multipart/form-data">
                    <table border="1">
                        <tr>
                            <td>
                                Titulo do Livro:
                            </td>
                            <td>
                                <input type="text" name="txtTitulo" value="<?php echo($titulo)?>" onkeypress="return Validar(event, 'number', this.id);" required id="titulo">
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Preço:
                            </td>
                            <td>
                                <input type="text" name="txtPreco" value="<?php echo($preco)?>" maxlength="10" required id="preco" onkeypress="return Validar(event, 'caracter', this.id);">
                            </td>
                            
                        </tr>
                        <tr>
                            <td>
                                Capa do Livro:
                            </td>
                            <td>
                                <input type="file" name="imgCapa" required>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <img src="<?php echo($capa)?>" class="foto">
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
                                Capa:
                            </td>
                            <td>
                                Titulo:
                            </td>
                            <td>
                                Preco:
                            </td>
                            <td>
                                Opções:
                            </td>
                            
                            
                        </tr>
                    
                    <?php
                    
                        $sql = "SELECT * FROM tbl_promocao";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                         <tr>
                        
                            <td>
                                <img src="<?php 
                                
                                    echo($rsEnd['capa'])
                            
                                ?>" class="foto">
                                
                            </td>
                             <td>
                                 <?php 
                                
                                    echo($rsEnd['titulo'])
                            
                                ?>
                                
                            </td>
                             
                             <td>
                                <?php 
                                
                                    echo($rsEnd['preco'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="cadastroPromocao.php?modo=excluir&idPromocao=<?php echo($rsEnd['idPromocao'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="cadastroPromocao.php?modo=busca&idPromocao=<?php echo($rsEnd['idPromocao'])?>">
                                    <img src="Imagens/pencil.png"></a>
                                
                                <?php
                                    if($rsEnd['ativado'] == 1){?>
                                      
                                <a href="cadastroPromocao.php?modo=desativado&idPromocao=<?php  echo($rsEnd['idPromocao'])?>">
                                    <img src="Imagens/tick.png">
                                </a>
                                    <?php }else{ ?>
                                        <a href="cadastroPromocao.php?modo=ativado&idPromocao=<?php  echo($rsEnd['idPromocao'])?>">
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
