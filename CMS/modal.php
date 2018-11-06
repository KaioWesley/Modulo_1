<?php
    
    require_once('externo.php');
    $conexao = conexaoBD();

    $codigo = $_POST['idRegistro'];
    
    $sql = "SELECT * FROM tbl_fale_conosco where id=".$codigo;

    $select = mysqli_query($conexao,$sql);
    
    if($rs=mysqli_fetch_array($select)){
        $nome = $rs['nome'];
        $celular = $rs['celular'];
        $email = $rs['email'];
        $sexo = $rs['sexo'];
        $profissao = $rs['profissao'];
        $produto = $rs['produto'];
        $sugestao = $rs['sugestao'];
    }
 
?>

<html>
	<head>
		<title>
			
		</title>
        <script src="js/jquery.js"></script>
        <script>
            $(document).ready(function(){
                $('.fechar').click(function(){
                    $('#container').slideUp(1000);
                })
            })
        </script>
         <link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
        
            <a href="#" class="fechar"><img src="Imagens/exit.png"></a>
           
        
        
        <table border="1" width="800">
            <tr>
                <td>
                    Nome:
                </td>
                <td>
                    <?php echo($nome)?>
                </td>
            </tr> 
            <tr>
                <td>
                    Celular
                </td>
                <td>
                    <?php echo($celular)?>
                </td>
            </tr> 
            <tr>
                <td>
                    Email
                </td>
                <td>
                    <?php echo($email)?>
                </td>
            </tr> 
            <tr>
                <td>
                    Sexo:
                </td>
                <td>
                    <?php echo($sexo)?>
                </td>
            </tr> 
            <tr>
                <td>
                    Profissao:
                </td>
                <td>
                    <?php echo($profissao)?>
                </td>
            </tr> 
            <tr>
                <td>
                    Produto:
                </td>
                <td>
                    <?php echo($produto)?>
                </td>
            </tr>
            <tr>
                <td>
                    Sugestão
                </td>
                <td>
                    <?php echo($sugestao)?>
                </td>
            </tr>
        </table>
	</body>
</html>