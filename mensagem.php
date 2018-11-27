<?php
    //CRIANDO VARIAVEIS PARA SE CONECTAR NO BANCO
    $host = "192.168.0.2";
    $database = "dbpc1620182";
    $user = "pc1620182";
    $password = "senai127";


    //VARIAVEIS VAZIAS PRA NÃO DAR ERRO

    $nome = null;
    $celular = null;
    $email = null;
    $sexo = null;
    $profissao = null;
    $produto = null;
    $sugestao = null;

    //VER SE O BANCO VAI CONECTAR
    if(!$conexao = mysqli_connect($host, $user, $password, $database)){
        echo('ERROR 404');
    }

    //SE O BOTAO FOR ATIVADO DEVE PUXAR O CONTEUDO DAS CAIXAS
    if(isset($_POST['btnEnvio'])){
        $nome = $_POST['txtNome'];
        $celular = $_POST['txtCelular'];
        $email = $_POST['txtEmail'];
        $sexo = $_POST['rbSexo'];
        $profissao = $_POST['txtProfissao'];
        $produto = $_POST['txtProduto'];
        $sugestao = $_POST['txtSugestao'];
        
        
        
        $sql = "INSERT INTO tbl_fale_conosco
            (nome, celular, email, sexo, profissao,sugestao, produto)
            VALUES ('".$nome."','".$celular."','".$email."','".$sexo."','".$profissao."','".$sugestao."','".$produto."')";

    mysqli_query($conexao, $sql);
        
        //echo($sql);

    header('location:mensagem.php');
    }

    
?>

<!doctype html>
<html lang="pt-br">
	<head>
		<title>
			Bugs Bunny
		</title>
         <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-1.9.1.min.js"></script>
        <script src="js/jssor.slider.min.js"></script>
        <script src="api-event-handling.js"></script>
        <script>
            
            function Validar(caracter, type, campo){
                
            document.getElementById(campo).style='background-color: #ffffff;';
                
                if(window.event)
                    
                    //Guarda o ascii da letra digitada pelo usuario
                    
                    var letra = caracter.charCode;
                else
                    var letra = caracter.which;
                
                if(type=='number'){
                    
                    if(letra>=48 && letra<=57){
                        
                    document.getElementById(campo).style='background-color: #fcb0b0;';
                    //cancela a acão da tecla
                    return false;
                    }
                    
                }else if(type == 'caracter'){
                    if(letra < 48 || letra > 57){
                        document.getElementById(campo).style='background-color: #fcb0b0;';
                    //cancela a acão da tecla
                    return false;}
                }
                
            }
        
        </script>
	</head>
	<body >



        <header>

                <nav>
                    <a href="index.php">
                        <img src="Image/Coelho.png" alt="Logo" title="Logo"></a>
                    <a href="index.php">
                        Home
                    </a>
                    <a href="noticias.php">Notícias em Destaque</a>
                    <a href="banca.php">Sobre a Banca</a>
                    <a href="promocao.php">Promoções</a>
                    <a href="mapa.php">Nossas Bancas</a>
                    <a href="celebridade.php">Sua Celebridade Esta Aqui</a>
                    <a href="mensagem.php">Fale Conosco</a>
                </nav>

                    <div class="login">
                        <form name="frmLogin" method="post" action="login.php" >
                            Usuario:<br>
                            <input type="text" name="txtUsuario"><br>

                            Senha:<br>
                            <input type="password" name="txtSenha">

                            <input type="submit" name="btnLogin" value="Entrar">
                        </form>
                    </div>

        </header>
        <div class="principal">

            <section class="texto">
                <div class="alinhar"></div>
                <h1 class="titulo">MANDE SUA SUGESTÃO</h1>
                <div class="texto">

                    <div class="imgFundo">

                    <div class="cor2">
                    <form name="frmSugestao" method="post" action="mensagem.php">


                            <table class="formulario">
                                <tr>
                                    <td>
                                        Nome:
                                    </td>
                                    <td>
                                        <input type="text" name="txtNome" id="nome" onkeypress="return Validar(event,'number', this.id);" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Celular:
                                    </td>
                                    <td>
                                        <input type="text" name="txtCelular" id="celular" onkeypress="return Validar(event, 'caracter', this.id);" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Email:
                                    </td>
                                    <td>
                                        <input type="email" name="txtEmail" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Sexo:
                                    </td>
                                    <td>
                                        <input type="radio" name="rbSexo" value="M" checked>M
                                        <input type="radio" name="rbSexo" value="F">F
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Profissão:
                                    </td>
                                    <td>
                                        <input type="text" name="txtProfissao" id="profissao" onkeypress="return Validar(event,'number', this.id);" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Produto:
                                    </td>
                                    <td>
                                        <input type="text" name="txtProduto" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Sugestão:
                                    </td>
                                    <td>
                                       <textarea name="txtSugestao"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Enviar" name="btnEnvio">
                                    </td>
                                    <td>
                                       <input type="reset" value="Apagar" name="btnReset">
                                    </td>
                                </tr>
                            </table>

                        </form>
                     </div>
                        </div>
                </div>

            </section>


        </div>



        <footer>
            Para mais Informações acesse o <a href="mensagem.php">Fale Conosco</a>
        </footer>

	</body>
</html>
