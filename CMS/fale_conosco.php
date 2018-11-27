<?php
	require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    $nome = null;
    $celular = null;
    $email = null;
    $sexo = null;
    $profissao = null;
    $produto = null;
    $sugestao = null;


    if(isset($_GET['modo'])){
        $modo = $_GET['modo'];
        
        if($modo == 'excluir'){
            $codigo = $_GET['id'];
            $sql = "DELETE FROM tbl_fale_conosco where id=".$codigo;
            
            //Executa no BD o script    
            mysqli_query($conexao, $sql);
            //Redireciona para página inicial
            header('location:fale_conosco.php');
        }
            $select = mysqli_query($conexao, $sql);
            
            if($rsConsulta=mysqli_fetch_array($select)){
                $nome = $rsConsulta['nome'];
                $celular = $rsConsulta['celular'];;
                $email = $rsConsulta['email'];;
                $sexo = $rsConsulta['sexo'];;
                $profissao = $rsConsulta['profissao'];;
                $produto = $rsConsulta['produto'];;
                $sugestao = $rsConsulta['sugestao'];;
            }
        }
        
    

?>
<html>
	<head>
		<title>

		</title>
         <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery.js"></script>

				 <script>
					 	$(document).ready(function(){
							$(".vizualizar").click(function(){
								$("#container").slideDown(1000);
                            });
                        });

						function modal(idItem){
							$.ajax({
								type:"POST",
								url:"modal.php",
								data:{
									idRegistro:idItem},
									success:function(dados){
										$("#modal").html(dados);
									}
								})
                            }
						
				 </script>
				 <style>
            #container{
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                position: fixed;
                z-index: 999;
                display: none;
            }

            #modal{
                width: 500px;
                height: 300px;
                background-color: #ffffff;
                margin-left: auto;
                margin-right: auto;
                margin-top: 100px;
            }
        </style>
	</head>
	<body>

		<div id="container">
			<div id="modal">
                JKKKJJ
			</div>
		</div>

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
                <table>
                    <tr class="tabela">
                        <td>
                            Nome
                        </td>
                        <td>
                            Celular
                        </td>
                        <td>
                            Email
                        </td>
                        <td>
                            Sexo
                        </td>
                        <td>
                            Profissão
                        </td>
                        <td>
                            Produto
                        </td>
                        <td>
                            Sugestão
                        </td><!--tbl_fale_conosco-->
												<td>
                            Opções
                        </td>

                    </tr>

                    <?php
                        $sql = "SELECT * FROM tbl_fale_conosco";

                        $select = mysqli_query($conexao, $sql);

                        while ($rsContatos = mysqli_fetch_array($select)) {

                     ?>

                    <tr>
                        <td>
                            <?php
                            echo($rsContatos['nome'])
                            ?>
                        </td>
                        <td>
                            <?php
                            echo($rsContatos['celular'])
                            ?>
                        </td>
                        <td>
                            <?php
                            echo($rsContatos['email'])
                            ?>
                        </td>
                        <td>
                            <?php
                            echo($rsContatos['sexo'])
                            ?>
                        </td>
                        <td>
                            <?php
                            echo($rsContatos['profissao'])
                            ?>
                        </td>
                        <td>
                            <?php
                            echo($rsContatos['produto'])
                            ?>
                        </td>
                        <td>
                            <?php
                            echo($rsContatos['sugestao'])
                            ?>
                        </td>
                        <td>
													
                        </a>
                        <a href="fale_conosco.php?modo=excluir&id=<?php echo($rsContatos['id'])?>">
                            <img src="Imagens/delete.png">
                        </a>
                        <a href="#" class="vizualizar" onclick="modal(<?php echo($rsContatos['id'])?>)">
                            <img src="Imagens/search.png"></a>
                        </td>
                    </tr>
				<?php } ?>
                </table>
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
