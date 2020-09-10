<html>
    <header>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    </header>
    <section>
        <head></head>
        <body>
            <form action="chaveAcessoNFe.php" method="post">
                <h1>Consultar Chave de Acesso Nf-e</h1>
                Codigo do Estado 23<br>
                Série 1
                <p>Data da Nf</p>
                <input type="month" name="mes" maxlength="9" pattern="[0-9]{4}-[0-9]{2}">
                <p>CNPJ</p>
                <input type="text" name="cnpj" maxlength="14" autofocus>
                <p>Modelo</p>
                <input type="text" name="modelo" maxlength="2">
                <p>Numero da Nf</p>
                <input type="text" name="numeroNF" maxlength="9">
                <p>Ambiente de emissão</p>
                <input type="text" name="formaEmissao" maxlength="1">
                <br>
                <input type="button" value="Consultar" onclick="consultaChaveAcesso();">
                
            <div id="resultado" class="resultado"></div>
            </form>
        </body>
    </section>
    <footer>
        <script src="js/postConsultaChaveAcesso.js"></script>
    </footer>
</html>