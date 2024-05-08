<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Receiver Page</title>
</head>
<body>
<?php session_start(); 
if(isset($_POST['return'])) {
    unset($_SESSION['last_id']);
    header("Location: index.php");
    exit;
}
$hostName = "localhost";
$userName = "root";
$password = "root";
$databaseName = "newmodeldb";
$TemCovid;
$Prediction;
$Porcentagem;
$color = "#000000";
$id = $_SESSION['last_id'];
$sql = ""; //sql para pegar os dados do banco de dados
$conn = new mysqli($hostName, $userName, $password, $databaseName);
// Check connection 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT TemCovid, Porcentagem FROM prediction WHERE idPessoa = " . $id;
$result = $conn->query($sql);

$row = mysqli_fetch_assoc($result);
if ($result->field_count > 0) {

$TemCovid = $row['TemCovid'];
$Porcentagem = $row['Porcentagem'];

 if ($TemCovid == 0){
   $Prediction = "Negativo";
   $color = "#1abc1a";
} else if($TemCovid == 1){
  $Prediction = "Positivo";
  $color = "#ff5050";
} else {
    die("Erro com o resultado");
}

} else {
    echo "0 results";
}

?>
 <div class="card card-with-top-line">
   <div class="card-top-line"></div>
<br> <br> 
<b>Resultado:</b>
<b> <?php  echo "<span style=\"color: $color\">$Prediction</span>";
?></b>
<br> <br> 
<br> <br> 
<b>Confiabilidade:</b>
<b> <?php echo $Porcentagem; ?></b>
</div>
<form method="post">
    <button type="submit" name="return">Voltar</button>
</form>
</body>
</html>