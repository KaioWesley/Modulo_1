<?php
//conexao com o banco de dados 
 require_once('CMS/externo.php');
$conexao = conexaoBD();
// session_start inicia a sessão
session_start();



if(isset($_GET['modo'])){
    
    unset ($_SESSION['nome']);
    unset ($_SESSION['senha']);
    header('location:index.php');
}else{

// as variáveis login e senha recebem os dados digitados na página
$nome = $_POST['txtUsuario'];
$senha = $_POST['txtSenha'];

// A variavel $result pega as variaveis $login e $senha, faz uma 
//pesquisa na tabela de usuarios

$sql = "SELECT * FROM tbl_user 
WHERE nome = '" . $nome . "' AND senha= '" . $senha . "'";
$select = mysqli_query($conexao, $sql);
$rsEnd = mysqli_fetch_array($select);

echo($sql);

if($rsEnd)
{
$_SESSION['nome'] = $rsEnd['nome'];
$_SESSION['senha'] = $senha;
header('location:CMS/index.php');
}
else{
  unset ($_SESSION['nome']);
  unset ($_SESSION['senha']);
  header('location:index.php');
   
  }
}

?>