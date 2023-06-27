<div class="tudo">
<?php
        // ATENÇÃO: o tipo da coluna na tabela deve ser MEDIUMBLOB
        include("conecta.php");

        $login = $_POST["login"];
        $Id_produto = $_POST["Id_produto"];

        // Lê o conteúdo do arquivo de imagem e armazena na variável $imagem
		$imagem = file_get_contents($_FILES["imagem"]["tmp_name"]);
		
		$comando = $pdo->prepare("INSERT INTO carrinho(login,Id_produto,foto) VALUES(:login,:Id_produto,:foto)");
        $comando->bindParam(":login", $login);
        $comando->bindParam(":Id_produto", $Id_produto);
        $comando->bindParam(":foto", $imagem, PDO::PARAM_LOB);
		$resultado = $comando->execute();



        
        // As linhas abaixo você usará sempre que quiser mostrar a imagem

        $comando = $pdo->prepare("SELECT * FROM carrinho");
		$resultado = $comando->execute();
        while( $linhas = $comando->fetch() )
        {
            $dados_imagem = $linhas["foto"];
            $i = base64_encode($dados_imagem);

            $login =  $linhas["login"];
            $Id_produto =  $linhas["Id_produto"];

            echo("LOGIN: $login     ID: $Id_produto  <br>");
            echo(" <img src='data:image/jpeg;base64,$i' width='100px'> <br> <br> ");
        }
		
?></div>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="carrinho.css">
    <link rel="shortcut icon" href="imagens/icone-da-pagina.png" type="image/x-icon">
    <title>Smiling</title>
   

</head>
<body>
    
    <header>
    </nav>
   <center>
       <a href="index.html"><img src="imagens/smlAGRvaiP.png" width="200px"></a>
   </center> 
</header>


</body>
</html> 


