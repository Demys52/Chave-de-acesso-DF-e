<?php
//      Validações
if(isset($_POST["mes"]) && !empty($_POST["mes"]))
{
    $dateAnoMes = $_POST["mes"];
    $ano        = substr($dateAnoMes, 2, 2);
    $mes        = substr($dateAnoMes, 5, 2);
    if(($ano < 0 || (!is_numeric($ano))) || ($mes < 0 || $mes > 12 || (!is_numeric($mes))))
    {
        exit("Data inválida!");
    }
}
else
{exit("Data inválida!");}
if(isset($_POST["cnpj"]) && !empty($_POST["cnpj"]))
{
    if(!is_numeric($_POST["cnpj"]) || strlen($_POST["cnpj"]) !== 14 || $_POST["cnpj"] < 0)
    {
        exit("CNPJ incorreto!");
    }
}
else
{exit("CNPJ incorreto!");}
if(isset($_POST["modelo"]) && !empty($_POST["modelo"]))
{
    if(!is_numeric($_POST["modelo"]) || strlen($_POST["modelo"]) > 2 || $_POST["modelo"] < 0)
    {
        exit("Modelo inválido!");
    }
}
else
{exit("Modelo inválido!");}
if(isset($_POST["numeroNF"]) && !empty($_POST["numeroNF"]))
{
    if(!is_numeric($_POST["numeroNF"]) || strlen($_POST["numeroNF"]) > 9 || $_POST["numeroNF"] < 0)
    {
        exit("Numero da NF-e incorreto!");
    }
}
else
{exit("Numero da NF-e incorreto!");}
if(isset($_POST["formaEmissao"]) && !empty($_POST["formaEmissao"]))
{
    if(!is_numeric($_POST["formaEmissao"]) || strlen($_POST["formaEmissao"]) > 1 || $_POST["formaEmissao"] < 0)
    {
        exit("Ambiente de emissão da NF-e incorreto!");
    }
}
else
{exit("Ambiente de emissão da NF-e incorreto!");}
// Receber os dados do usuario  =>  Quantidade de caracteres
// Codigo da UF                 =>  2
// Ano e Mês yymm               =>  4
// Cnpj do emitente             =>  14
// Modelo                       =>  2
// ?Serie?                      =>  3
// Numero NF                    =>  9
// Ambiente de emissão          =>  1
$uf             = 23;
$anoMes         = $ano.$mes;
$cnpj           = $_POST["cnpj"];
$modelo         = $_POST["modelo"];
$serie          = "001";
$numeroNf       = $_POST["numeroNF"];
$numeroNf       = addZero($numeroNf, 9);
$formaEmissao   = $_POST["formaEmissao"];
// Codigo numerico              =>  8
// Digito verificador           =>  1
    /*  Codigo numérico irá buscar os 5 primeiros digitos do CNPJ   **
        *  e completar com 3 zeros no inicio                           **
        *  digito verificador será calculado em uma função, que        **
        *  que utiliza um calculo de modulo 11 com os números base de  **
        *  2,3,4,5,6,7,8,9 da direita para a esquerda                  */
$codNumerico    = "000" . substr($cnpj, 0, 5);
$cNfe = $uf.$anoMes.$cnpj.$modelo.$serie.$numeroNf.$formaEmissao.$codNumerico;
$digitoVerificador = dv($cNfe);
echo $digitoVerificador;
//função que calcula o digito verificador
function dv ($cNfe)
{
    $cNfe = str_split($cNfe);
    //echo count($cNfe);
    $baseCalculo = array(4,3,2,9,8,7,6,5);
    $soma = 0;
    for($x=0; $x < count($cNfe); $x++)
    {
        if(!isset($y) || $y > 7)
        {
            $y=0;
            $soma += $cNfe[$x] * $baseCalculo[$y];
        }
        else
        {
            $soma += $cNfe[$x] * $baseCalculo[$y];
        }
        $y++;
    }
    if($soma % 11 == 0 || $soma % 11 == 1)
    {
        $digVerificador = 0;
    }
    else
    {
        $digVerificador = 11 - ($soma % 11);
    }
    $cNfe = implode("", $cNfe);
    $cNfe .= $digVerificador;
    return $cNfe;
}
// função incrementa o zero
function addZero ($post, $tamanho)
{
    $recebido = str_split($post);
    $zero = $tamanho - count($recebido);
    for($x=0; $x < $zero; $x++)
    {
        $post = "0".$post;
    }
    return $post;
}
?>