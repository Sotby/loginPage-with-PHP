<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados
    $conn = new mysqli("localhost", "Sotby", "Gxp142536", "users");

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Pegar dados do formulário
    $email = $_POST['uName'];
    $username = $_POST['uName'];
    $senha = $_POST['psw'];

    // Verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email' or username = '$username'" ;
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar senha
        if (password_verify($senha, $row['senha'])) {
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");  // Redirecionar para a página de dashboard
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }

    $conn->close();
}
?>
