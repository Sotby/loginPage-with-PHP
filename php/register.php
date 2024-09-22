<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar ao banco de dados
    $conn = new mysqli("localhost", "Sotby", "Gxp142536", "users");
    
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Pegar dados do formulário
    $username = $_POST['uName'];
    $email = $_POST['Email'];
    $senha = password_hash($_POST['psw'], PASSWORD_DEFAULT);

    // Verificar se o usuário já existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo "Email já registrado!";
    } else { 
        $sql = "SELECT * FROM usuarios WHERE username = '$username'";
        $result = $conn->query(query: $sql);
        if($result->num_rows>0){
            echo "Nome de usuario em uso";
        } else {
        // Inserir no banco de dados
        $sql = "INSERT INTO usuarios (username, email, pass) VALUES ('$username', '$email', '$senha')";
        if ($conn->query($sql) === TRUE) {
            echo "Registro concluído com sucesso!";
            header("Location: login.php");
        } else {
            echo "Erro: " . $conn->error;
        }
    }

    $conn->close();
    }
}
?>