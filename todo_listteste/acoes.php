<?php
session_start();
require_once('conexao.php');

if (isset($_POST['task_create'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $descricao = mysqli_real_escape_string($conn, $_POST['descricao']);
    $prioridade = mysqli_real_escape_string($conn, $_POST['prioridade']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $data = mysqli_real_escape_string($conn, $_POST['data']);

    $sql = "INSERT INTO tasks (nome, descricao, prioridade, `status`, `data`) VALUES('$nome', '$descricao', '$prioridade', '$status', '$data')";

    mysqli_query($conn, $sql);

    header('Location: index.php');
    exit();
}

if (isset($_POST['delete_task'])) {
    $usuarioId = mysqli_real_escape_string($conn, $_POST['delete_task']);
    $sql = "DELETE FROM todo WHERE id = '$id'";

    mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) > 0) {
        $_SESSION['message'] = "Usuário com ID {$usuarioId} excluído com sucesso!";
        $_SESSION['type'] = 'success';
    } else {
        $_SESSION['message'] = "Ops! Não foi possível excluir o usuário";
        $_SESSION['type'] = 'error';
    }

    header('Location: index.php');
    exit;
}

if (isset($_POST['edit_task'])) {
    $usuarioId = mysqli_real_escape_string($conn, $_POST['id']);
    $nome = mysqli_real_escape_string($conn, $_POST['txtNome']);
    $email = mysqli_real_escape_string($conn,$_POST['txtEmail']);
    $dataNascimento = mysqli_real_escape_string($conn, $_POST['txtDataNascimento']);
    $senha = mysqli_real_escape_string($conn,$_POST['txtSenha']);

    $sql = "UPDATE usuarios SET nome = '{$nome}', email = '{$email}', data_nascimento = '{$dataNascimento}'";


    if (!empty($senha)){
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = '{$senha}'";
    }

    $sql.= "WHERE id = '{$usuarioId}'";

    mysqli_query($conn,$sql);

    if (mysqli_affected_rows($conn) >= 0){
        $_SESSION['message'] = "Usuário atualizado com sucesso!";
        $_SESSION['message'] = "Sucess";
    }else{
        $_SESSION['message'] = "Não foi possível alterar o usuário";
        $_SESSION['message'] = "error";
    }

    mysqli_query($conn,$sql);
    header("Location: index.php");
}
