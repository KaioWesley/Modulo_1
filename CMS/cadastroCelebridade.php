<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $nome = null;
    $numero = null;
    $botao = "Cadastrar";


    if(isset($_POST['btnCadastro'])){
        $sobre = $_POST['txtSobre'];
        
        //PUXANDO A FOTO
        
        $foto = $_FILES['imgFoto']['name'];
        $tamanho_foto = $_FILES['imgFoto']['size'];
        $tamanho_foto = round($tamanho_foto/1024);
        $ext_foto = strrchr($foto, ".");
        $nome_foto = pathinfo($foto, PATHINFO_FILENAME);
        $nome_foto = md5(uniqid(time()).$nome_foto);
        $diretorio = "upload/";
        $extensao = array(".jpg",".png",".jpeg");
        
        //PUXANDO O BANNER
        
        $banner = $_FILES['imgBanner']['name'];
        $tamanho_banner = $_FILES['imgBanner']['size'];
        $tamanho_banner = round($tamanho_banner/1024);
        $ext_banner = strrchr($banner, ".");
        $nome_banner = pathinfo($banner, PATHINFO_FILENAME);
        $nome_banner = md5(uniqid(time()).$nome_banner);
        
        
        //ESTA PARTE AINDA NÃO ESTA PRONTA CHAME O PROFESSOR DPS DE ENTENDER O POR QUE NÃO DEU CERTO
        
        if(in_array($ext_foto, $extensao)){
            if($tamanho_foto<=2000){
                $foto_tmp = $_FILES['imgFoto']['tmp_name'];
                $arquivo = $diretorio.$nome_foto.$ext_foto;
                
                if(move_uploaded_file($foto_tmp, $foto)){
                    
                    if($_POST['btnCadastro']=="Cadastrar"){
                        $sql = "INSERT INTO tbl_celebridade
                        (logradouro, numero)
                        VALUES ('".$nome."', '".$numero."')";
            
                    }else if($_POST['btnCadastro']=="Editar"){
                        $sql="UPDATE tbl_celebridade SET logradouro = '".$nome."', numero = '".$numero."' WHERE idEndereco=".$_SESSION['idEndereco'];
                    }
                    
                }
            }
        }
        
        
        
        
        
        
        
        
        
        
        if($_POST['btnCadastro']=="Cadastrar"){
        $sql = "INSERT INTO tbl_endereco
        (logradouro, numero)
        VALUES ('".$nome."', '".$numero."')";
            
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
            
                <form name="frmCadastro" method="post" action="CadastroCelebridade.php">
                    <table border="1">
                        <tr>
                            <td>
                                Sobre a Celebridade:
                            </td>
                            <td>
                                <textarea name="txtSobre"></textarea>
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
                                <input type="file" name="imgFoto">
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
                                <?php 
                                
                                    echo($rsEnd['foto'])
                            
                                ?>
                            </td>
                             <td>
                                <?php 
                                
                                    echo($rsEnd['banner'])
                            
                                ?>
                            </td>
                             
                             <td>
                                <?php 
                                
                                    echo($rsEnd['informacao'])
                            
                                ?>
                            </td>
                            <td>
                                <a href="CadastroEndereco.php?modo=excluir&idEndereco=<?php echo($rsEnd['idEndereco'])?>">
                                    <img src="Imagens/delete.png"></a>
                                
                                <a href="CadastroEndereco.php?modo=busca&idEndereco=<?php echo($rsEnd['idEndereco'])?>">
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
