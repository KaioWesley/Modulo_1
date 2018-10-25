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
                        <form name="frmLogin" method="post" action="index.php" >
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
                <h1 class="titulo">NOS ENCONTRE PERTO DE VOCÊ</h1>
                
                <div class="texto">
                    <div class="imgFundo2">
                        <?php
                    
                        $sql = "SELECT * FROM tbl_endereco";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                        ?>
                        <div class="banca"><?php echo($rsEnd['logradouro'])?> Nº <?php echo($rsEnd['numero'])?></div>
                        <?php } ?>
                    </div>
                </div>
            
            </section>
            
            
        </div>
        
        
        
        <footer>
            Para mais Informações acesse o <a href="mensagem.php">Fale Conosco</a>
        </footer>
        
	</body>
</html>