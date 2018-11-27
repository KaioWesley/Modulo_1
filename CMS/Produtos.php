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
               
                <div class="imagem3">
                    <a href="cadastroProduto.php">
                        <img src="Imagens/produto.png"><br> Cadastrar Produto
                    </a>
                </div>
                <div class="imagem3">
                    <a href="cadastroCategoria.php">
                        <img src="Imagens/categoria.png"><br> Cadastrar Categoria
                    </a>
                </div>
                <div class="imagem3">
                    <a href="cadastroSubCategoria.php">
                        <img src="Imagens/subcategoria.png"><br> Cadastrar Subcategoria
                    </a>
                </div>
            
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
