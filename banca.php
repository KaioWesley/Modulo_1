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
                <h1 class="titulo">CONHEÇA UM POUCO SOBRE NÓS</h1>
                <div class="texto">
                    <div class="img1">
                        <h2 class="titulo">A criação</h2>
                        <div class="cor">
                            <?php
                    
                        $sql = "SELECT * FROM tbl_criacao";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                            <div class="centro">
                                <img src="CMS/<?php echo($rsEnd['icone']) ?>" alt="Lampada" title="Lampada" class="icone">
                            </div>
                            
                            <p><?php echo($rsEnd['paragrafo1']) ?></p>
                            <p><?php echo($rsEnd['paragrafo2']) ?></p>
                        <?php } ?>
                        </div>
                    </div>
                    
                    <div class="img2">
                        <h2 class="titulo">Acontecimentos importantes</h2>
                        <div class="cor">
                            <?php
                    
                        $sql = "SELECT * FROM tbl_eventos_importantes";
                    
                        $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){
                    
                    ?>
                            <div class="centro">
                                <img src="CMS/<?php echo($rsEnd['iconeEvento']) ?>" alt="Lampada" title="Lampada" class="icone">
                            </div>
                            
                            <p><?php echo($rsEnd['paragrafoEvento1']) ?></p>
                            <p><?php echo($rsEnd['paragrafoEvento2']) ?></p>
                        <?php } ?>
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