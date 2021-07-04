<?php
    session_start();
    if (!isset($_SESSION["nick"]))
    {
        if (isset($_POST["nick"]))
        {
            $_SESSION["nick"] = $_POST["nick"];
        }
        else
        {
            header("Location: index.php");
        }
    }  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link href="css/styleChat.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="Topo">
            <p>Bem vindo ao CHAT, <b><?php echo $_SESSION["nick"]?></b>. <a href="sair.php" class="quit">Sair</a> <br></p>
            <h2 class="msgRec">Mensagens recebidas no Chat</h2>
        </div>

        <div class="msgrecebidas">
            <textarea name="msgsrecebidas" cols="65" rows="20" class="msgRecebidas" disabled>
                <?php
                    $arquivo = fopen("conversa.txt", 'r');
                    $conversa = fread($arquivo, filesize("conversa.txt"));
                    fclose($arquivo);
                    echo $conversa;
                ?>
            </textarea>
        </div>

        <h2 class="txtMsg">Escreva sua mensagem</h2>
        <div class="msgenviadas">
            <form action="" method="post">
                <textarea name="novamsg" cols="65" rows="2" class="msgEnviadas"></textarea>
                <input type="submit" class="btnMsg" value="Enviar Mensagem">
            </form>
        </div>
    </div>

    <?php
        if (isset($_POST["novamsg"]))
        {
            $mensagem = $_SESSION["nick"] . ' diz: ' . $_POST["novamsg"] . ' &#10; ';

            //Fazendo a manipulação do Arquivo
            $arquivo = fopen("conversa.txt", 'a+');
            fwrite($arquivo, $mensagem);
            fclose($arquivo);
        }
    ?>
</body>
</html>
