<?php
include("config.php");

$erro = array();

if (isset($_POST['ok'])) {
    $email = $conn->real_escape_string($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro[] = "E-mail inválido.";
    }

    $sql_code = "SELECT id_usuario, nome_usuario FROM usuario WHERE email_usuario = ?";
    $stmt = $conn->prepare($sql_code);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    $total = $stmt->num_rows;

    if ($total == 0) {
        $erro[] = "O e-mail informado não está cadastrado.";
    } else {
        // Generate a new password
        $novasenha = substr(md5(time()), 0, 6);

        // Update the password in the database
        $senhaCriptografada = md5($novasenha);
        $sql_code = "UPDATE usuario SET senha_usuario = ? WHERE email_usuario = ?";
        $stmt = $conn->prepare($sql_code);
        $stmt->bind_param("ss", $senhaCriptografada, $email);
        $stmt->execute();
        $stmt->close();

        echo "<script>console.log('Nova Senha:', '$novasenha');</script>";

        // TODO: Send the new password to the user's email
        $subject = "Recuperação de Senha";
        $message = "Sua nova senha: " . $novasenha;
        $headers = "From: luccasiasd.777@gmail.com.br"; // Replace with your email address

        // Uncomment the line below when you have a working mail server
        // mail($email, $subject, $message, $headers);

        $erro[] = "Senha alterada com sucesso. Verifique o seu e-mail.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Password Recovery</title>
</head>
<body>
    <?php
    if (count($erro) > 0) {
        foreach ($erro as $msg) {
            echo "<p>$msg</p>";
        }
    }
    ?>
    <form method="POST" action="">
        <input value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Seu e-mail" name="email" type="text">
        <input name="ok" value="ok" type="submit">
    </form>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .alert {
            padding: 15px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            color: #333;
            background-color: #f8d7da;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</body>
</html>
