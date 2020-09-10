function consultaChaveAcesso()
{
    var getMes = document.getElementsByName("mes")[0].value;
    var getCNPJ = document.getElementsByName("cnpj")[0].value;
    var getModelo = document.getElementsByName("modelo")[0].value;
    var getNumero = document.getElementsByName("numeroNF")[0].value;
    var getFormaEmissao = document.getElementsByName("formaEmissao")[0].value;
    
    if(!getMes)
    {
        alert("Infome a data emitida!");
    }
    else if(!getCNPJ)
    {
        alert("Digite o CNPJ");
        document.getElementsByName("cnpj")[0].focus();
    }
    else if(!getModelo)
    {
        alert("Informe o modelo do DF-e (ex:NF-e: 55)");
        document.getElementsByName("modelo")[0].focus();
    }
    else if(!getNumero)
    {
        alert("Digite o Numero do DF-e");
        document.getElementsByName("numeroNF")[0].focus();
    }
    else if(!getFormaEmissao)
    {
        alert("Informe o Ambiente de emissão (ex: Produção: 1)");
        document.getElementsByName("formaEmissao")[0].focus();
    }
    else
    {
        $("#resultado").html("<div class='loader'></div>");
        $.ajax({
                type: "POST",
                url: "../chaveAcessoNFe.php",
                    data: { mes: getMes, cnpj: getCNPJ, modelo: getModelo, numeroNF: getNumero, formaEmissao: getFormaEmissao },
                    complete: function (response) {
                        $("#resultado").html(response.responseText);
                        //window.location.reload();
                    },
                    error: function () {
                        $("#resultado").html("Verifique sua conexão e tente novamente!");
                        alert("Erro");
                    }
                });
    }

}