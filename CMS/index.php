<?php 
    
    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

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
                
                <div class="centro">
                    <div class="conteudo">
                        <a href="cadastroNoticias.php">
                            <div class="imagem">
                                <img src="Imagens/TopNews.png">
                            </div>
                            <div class="titulo">
                                Noticias
                            </div>
                        </a>
                    </div>
                    <div class="conteudo">
                        <a href="SobreBanca.php">
                            <div class="imagem">
                                <img src="Imagens/Newsstand.png">
                            </div>
                            <div class="titulo">
                                Sobre a Banca
                            </div>
                        </a>
                    </div>
                    <div class="conteudo">
                        <a href="CadastroPromocao.php">
                            <div class="imagem">
                                <img src="Imagens/Promocao.png">
                            </div>
                            <div class="titulo">
                                Promoções
                            </div>
                        </a>
                    </div>
                    <div class="conteudo">
                        <a href="CadastroEndereco.php">
                            <div class="imagem">
                                <img src="Imagens/Map.png">
                            </div>
                            <div class="titulo">
                                Nossas Bancas
                            </div>
                        </a>
                    </div>
                    <div class="conteudo">
                        <a href="cadastroCelebridade.php">
                            <div class="imagem">
                                <img src="Imagens/Celebridade.png">
                            </div>
                            <div class="titulo">
                                Celebridades do dia
                            </div>
                        </a>
                    </div>
                </div>
            
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
