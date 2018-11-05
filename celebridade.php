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
            
            <section>
                <div class="alinhar"></div>
                <h1 class="titulo">CONHEÇA MAIS SOBRE SEU IDOLO</h1>
                
                    <div class="banner">
                    <div id="jssor_1" style="position:relative; margin:0; top:0px; left:0px; width:1000px; height:380px; overflow:hidden; visibility:hidden;">
                        <!-- Loading Screen -->
                        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
                            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="svg/loading/static-svg/spin.svg" alt="Carregando" />
                        </div>
                        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:980px;height:380px;overflow:hidden;">
                            
                            <?php
                            
                                $sql = "SELECT * FROM tbl_celebridade";
                            
                            $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){?>
                            
                            <div>
                                <img data-u="image" src="CMS/<?php 
                                
                                    echo($rsEnd['banner'])
                            
                                ?>" class="foto" alt="Michael Jackson" title="Michael Jackson"/>
                            </div>
                            <?php }?>
                            
                            
                        </div>
        <!-- Bullet Navigator -->
                        <div data-u="navigator" class="jssorb053" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
                            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                    <path class="b" d="M11400,13800H4600c-1320,0-2400-1080-2400-2400V4600c0-1320,1080-2400,2400-2400h6800 c1320,0,2400,1080,2400,2400v6800C13800,12720,12720,13800,11400,13800z"></path>
                                </svg>
                            </div>
                        </div>
                        <!-- Arrow Navigator -->
                        <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
                            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                                <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
                            </svg>
                        </div>
                        <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
                            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                                <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                                <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
                            </svg>
                        </div>
                    </div>
                </div>
                    
            </section>
            <section class="texto">
                <div class="cor3">
                    <div class="informacao">
                        
                            <?php
                            
                                $sql = "SELECT * FROM tbl_celebridade";
                            
                            $select = mysqli_query($conexao, $sql);
                    
                        while($rsEnd = mysqli_fetch_array($select)){?>
                        <div class="inicio">
                            <div class="image1">
                                <img src="CMS/<?php 
                                
                                    echo($rsEnd['foto'])
                            
                                ?>" class="foto">
                            </div>
                            <div class="resumo">
                                
                                <?php echo($rsEnd['informacao'])?>
                            
                            </div>
                            </div>
                            <?php }?>
                        
                        
                    </div>
                </div>            
            </section>
            
        </div>
        
        
        
        <footer>
            Para mais Informações acesse o <a href="mensagem.php">Fale Conosco</a>
        </footer>
        
	</body>
</html>