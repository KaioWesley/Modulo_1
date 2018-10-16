<?php

    require_once('externo.php');

	$conexao = conexaoBD();

    session_start();

    if(isset($_POST['btnUser'])){
        $nome = $_POST['txtNome'];
        $email = $_POST['txtEmail'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $dtNasc = $_POST['txtDtNasc'];
        $nivel = $_POST['cmbNivel'];
        
        if($_POST['btnUser']=="Cadastrar"){
            $sql = "INSERT INTO tbl_User 
            (nome, email, telefone, celular, dtNasc)
            VALUES ('".$nome."','".$email."','".$telefone."','".$celular."','".$dtNasc."','".$observacao."')";
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
               
                <div class="cadastroUser">
                
                    <form name="frmCadastro" method="post" action="cadastroUser.php">
                    
                        <table border="1">
                            <tr>
                                <td>
                                    Nome Completo:
                                </td>
                                <td>
                                    <input type="text" maxlength="50" name="txtNome">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Data de Nascimento:
                                </td>
                                <td>
                                    <input type="date" name="dtNasc">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    
                                    Telefone:
                                
                                </td>
                                <td>
                                    <input type="text" name="txtTel">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Celular:
                                </td>
                                <td>
                                    <input type="text" name="txtCel">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Email:
                                </td>
                                <td>
                                    <input type="email" name="txtEmail">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nivel:
                                </td>
                                <td>
                                    <select name="cmbNivel">
                                        <option>50</option>
                                        <option>550</option>
                                        <option>520</option>
                                        <option>0</option>
                                        <option selected>~~SELECIONE UM NIVEL~~</option>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="Cadastrar" name="btnUser">
                                </td>
                            </tr>
                            
                        </table>
                    
                    </form>
                
                </div>
            
            </section>
            <footer>SITE DESENVOLVIDO POR KAIO WESLEY</footer>
        </div>
	</body>
</html>
