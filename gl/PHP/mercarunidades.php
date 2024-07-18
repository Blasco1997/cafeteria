<?php
    session_start();
    if(isset($_POST["produto"]) && isset($_POST["descproduto"]) && isset($_POST["stockproduto"])
    && isset($_POST["prezoproduto"]) && isset($_POST["provedorproduto"]) && isset($_POST["cantidade"])) {
        $produto = $_POST["produto"];
        $descproduto = $_POST["descproduto"];
        $stockproduto = $_POST["stockproduto"];
        $prezoproduto = $_POST["prezoproduto"];
        $provedorproduto = $_POST["provedorproduto"];
        $cantidade = $_POST["cantidade"];
        $subtotal = $prezoproduto * $cantidade;
        $produtocomprado = array(
            'produto' => $produto,
            'descricion' => $descproduto,
            'stock' => $stockproduto,
            'cantidade' => $cantidade,
            'prezo' => $prezoproduto,
            'subtotal' => $subtotal,
            'provedor' => $provedorproduto
        );
        if(isset($_SESSION['comprado'])) {
            // Se existe, agregar o novo array á variable de sesión existente
            array_push($_SESSION['comprado'], $produtocomprado);
            header("location: produtoscomprados.php");
        } else {
            // Se non existe, crear a variable de sesión co novo array
            $_SESSION['comprado'] = array($produtocomprado);
            header("location: produtoscomprados.php");
        }
    }
?>