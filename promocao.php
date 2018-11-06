<?php 

    require_once('CMS/externo.php');

	$conexao = conexaoBD();

    session_start();

    

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
            
            <section>
                <div class="alinhar"></div>
                <h1 class="titulo">MAIS DIVERSÃO POR MENOS PREÇO</h1>
                
                    
                    
            </section>
            <section class="conteudo2">
                
                
                        <?php
                    
                            $sql = "SELECT * FROM tbl_promocao where ativado=1";

                            $select = mysqli_query($conexao, $sql);

                            while($rsEnd = mysqli_fetch_array($select)){
                    
                        ?>
                <div class="livro2">
                    <table>
                            <tr>
                                <td>
                                    <img src="CMS/<?php echo($rsEnd['capa'])?>" alt="Crepusculo" title="Crepusculo" class="capa">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Titulo: <?php echo($rsEnd['titulo'])?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Preço: <?php echo($rsEnd['preco'])?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="limpar">Detalhes</a>
                                </td>
                            </tr>
                        </table>
                </div>
                        <?php }?>
                    
            </section>
            
        </div>
        
        
        
        <footer>
            Para mais Informações acesse o <a href="mensagem.php">Fale Conosco</a>
        </footer>
        
	</body>
</html>