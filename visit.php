<?php
// coded by C00l3r_   visit flooder 02/11/2006
// Definindo encode pra UTF-8
header('Content-type: text/html; charset="utf-8"',true);

// Compress com gzip para ficar mais rapida a pagina ela fica comprimida
ob_start("ob_gzhandler");

// Array dos user agent
$useragent = array(
'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; WOW64; Trident/4.0; SLCC2; .NET CLR\', 2.0.50727; .NET CLR 3.5.30729; .NET CLR 3.0.30729; Media Center PC 6.0; MDDC)',
'Mozilla/5.0 (Windows; U; Windows NT 5.1; pt) AppleWebKit/532.5 (KHTML, like Gecko) Chrome/4.0.249.78 Safari/532.5',
'Mozilla/5.0 (Windows; U; Windows NT 6.1; pt; rv:1.9.1b2) Gecko/20081201 Firefox/3.1b2',
'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_7; en-us) AppleWebKit/525.28.3 (KHTML, like Gecko) Version/3.2.3 Safari/525.28.3',
'Mozilla/5.0 (Windows; U; Windows NT 5.1; pt; rv:1.7.13) Gecko/20060410 Firefox/1.0.8',
'Opera/9.80 (Windows NT 5.2; U; en) Presto/2.2.15 Version/10.10',
'Mozilla/5.0 (Windows; U; Windows NT 5.1; pt; rv:1.7.3) Gecko/20041002 Firefox/0.10.1',
'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)',
'Mozilla/5.0 (Windows; U; Windows NT 5.1; pt; rv:1.9.1.4) Gecko/20091016 Firefox/3.5.4 (.NET CLR 3.5.30729)', 
'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; InfoPath.1; MS-RTC LM 8)',
'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; Business Everywhere 7.1.2; GTB6; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)',
'Mozilla/5.0 (Windows; U; Windows NT 5.1; pt; rv:1.8.1.8pre) Gecko/20071019 Firefox/2.0.0.8 Navigator/9.0.0.1',
'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.0; Smart Bro)'
);

//forms post
$url=$_POST['url'];
$wordlist=$_POST['wordlist'];

if($url != "") {
 $cookie="cookie.txt";
 $wordlist = file_get_contents($wordlist);
 $wordlist = explode("\n", $wordlist);
 print " Testando proxys...<br>"; $cont=0;
 foreach($wordlist as $proxy){
	$ch = curl_init(); $x=rand(0,12);
	curl_setopt ($ch, CURLOPT_URL, $url );
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($ch, CURLOPT_USERAGENT, $useragent[$x]);
	curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
         curl_setopt($ch, CURLOPT_PROXY, $proxy);
//	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);
	curl_setopt ($ch, CURLOPT_REFERER, $url );
	$result = curl_exec ($ch);
	curl_close($ch);
        echo "<font color=\"green\"><p>visita com $proxy <br></font></p>";  $cont+=1;    
 }
 echo "<font color=\"green\"><p>total de $cont cliques<br></font></p>";
}
?>
<html>

<div align="center"><head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style>

body {
        color: #ffffff;

	margin-left: 0;

	margin-right: 0;

	margin-top: 0;

	margin-bottom: 0;

}

.titulo {

	font-family: Arial, Helvetica, sans-serif;

	font-size: 70px;

	color: #ffffff;

	font-weight: bold;

}



.normal {

	font-family: Arial, Helvetica, sans-serif;

	font-size: 12px;

	color: #ffffff;

}



.form {

	font-family: Arial, Helvetica, sans-serif;

	font-size: 10px;

	color: #fff;

	background-color: #000;

	border: 1px dashed #666666;

}



.texto {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

}



.alerta {

	font-family: Verdana, Arial, Helvetica, sans-serif;

	font-weight: bold;

	color: #990000;

	font-size: 10px;

}

</style>
</head>

<body bgcolor="black" link="#fffff" vlink="#fffff" alink="#fffff">
<title>...:::Slimer-visit-flooder:::...</title>
<?php
$form="
        <div align=\"center\">
        <img src=\"slimer3.gif\">
        <p>Slimer Bot  coded by Cooler_</p>
	<form enctype=\"multipart/form-data\" action=\"visit.php\" method=\"POST\">
	Alvo: <input type=\"text\" name=\"url\" value=\"http://Target.com\"><br>
        Lista de Proxys: <input type=\"text\" name=\"wordlist\" value=\"proxy2.txt\">
	<input type=\"submit\" value=\"Testar\" />
	</form></div>";
echo $form;


?>
