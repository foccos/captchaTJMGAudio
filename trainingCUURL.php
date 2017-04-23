<?php 


// exemplo processo: 0001956-29.2010.8.24.0011
//0001956: Número sequencial do processo.
//29: Dígito verificador, calculado segundo o algoritmo Módulo 97 base 10, conforme Norma ISO 7064:2003.
//2010: Ano de distribuição.
//8: Segmento do Poder Judiciário. No caso, Justiça Estadual.
//24: Tribunal. No caso, TJSC.
//0011: Unidade de origem do processo. No caso, foro de Brusque.

// $nProcesso = $_GET[nProcesso]; 
// $nComarca = $_GET[nProcesso];
// $anoProcesso = $_GET[nProcesso];
// $nProcessoUrl =$_GET[nProcesso];
// $nInstancia = $_GET[nProcesso]; //1 ou 2



//	$nProcesso = "0277508-76.2016.8.13.0701";  ---------remover os "." "-"

	$nProcesso = "02775087620168130701"; 
	$nComarca = "701";
	$anoProcesso = "16";
	$nProcessoUrl = "027750";
	$nInstancia = "1";


if ($nProcesso && $nComarca && $anoProcesso && $nProcessoUrl && $nInstancia) {
	 

$url=  'http://www4.tjmg.jus.br/juridico/sf/proc_movimentacoes.jsp?comrCodigo='.$nComarca.'&numero='.$nInstancia.'&listaProcessos='.$anoProcesso.$nProcessoUrl.'';
 //http://www.tjmg.jus.br/portal/processos/
echo $url;
echo "<br>";

// faz a chamada Curl que gera a imagem de captcha para consulta de CPF ou CNPJ conforme o parâmetro passado por get
$ch = curl_init($url); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);	// para consulta de CPF, necessário devido SSL (https), para CNPJ este parametro não interfere na consulta
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);	// para consulta de CPF, necessário devido SSL (https), para CNPJ este parametro não interfere na consulta
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:8.0) Gecko/20100101 Firefox/8.0');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $conteudo = curl_exec($ch);

  // acoplando as urls 
  $conteudo = str_replace("src=\"/", "src=\"", $conteudo);
  $conteudo = str_replace("src=\"", "src=\"http://www4.tjmg.jus.br/juridico/sf/", $conteudo);


 /* $conteudo = str_replace("src='/", "src='", $conteudo);
  $conteudo = str_replace("src='", "src='http://www4.tjmg.jus.br/juridico/sf/", $conteudo);


  $conteudo = str_replace("src=\"/", "src=\"", $conteudo);
  $conteudo = str_replace("src=\"", "src=\"http://www4.tjmg.jus.br/juridico/sf/", $conteudo);

   

  $conteudo = str_replace("captcha.svl", "http://www4.tjmg.jus.br/juridico/sf/captcha.svl", $conteudo);*/

  

  $conteudo = str_replace("js/juridico.js", "http://www4.tjmg.jus.br/juridico/sf/js/juridico.js", $conteudo); 
  $conteudo = str_replace("dwr/util.js", "http://www4.tjmg.jus.br/juridico/sf/dwr/util.js", $conteudo); 

  $conteudo = str_replace("captcha.svl", "http://www4.tjmg.jus.br/juridico/sf/captcha.svl", $conteudo);

  echo  $conteudo;
curl_close($ch);		

} else {
	echo "Parâmetros insuficientes! ";
}

?>

 
