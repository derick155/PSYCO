<?php



$dbServerName = "database-1.cqcorq0ea3iq.us-east-2.rds.amazonaws.com";
$dbUsername = "admin";
$dbPassword = "7zqCVtBpxip2ioHG60Oo";
$dbName = "dados";

// create connection
$conn =  mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName);
if (!isset($_GET['nome_livro'])) {
	header("Location: index.php");
	exit;
}

$nome = "%".trim($_GET['nome_livro'])."%";


$resultbusca = "SELECT * FROM BRS WHERE TELEFONE LIKE '$nome' LIMIT 1";
$resultadoo = mysqli_query($conn,$resultbusca);
$rows = array();
while($row_resultado = mysqli_fetch_array($resultadoo)){
  $rows = $row_resultado;

}
print json_encode($rows);