<?php

if ($_SERVER['REMOTE_ADDR'] == "201.82.50.57"){

// YOUTUBE LISTA DE VIDEOS DO CANAL
// Obs.: Crie uma API KEY no https://code.google.com/apis/console, não se esqueça de habilitar o Youtube Data API

$maxResults = 4;
//$chaveSecreta = 'AIzaSyB_iaL-908vVstuO7NdHs9GaXA5vSmDrdg';
$chaveSecreta = 'AIzaSyDJvav9CM-ABImowiUXoXV2eLHa6cXtWJA';

$channelId = 'UCpk07TjMWhMr3Wv-bFnkk-A';
$ch = curl_init();
$options = array(
    CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/search?maxResults=' . $maxResults . '&order=date&part=snippet&channelId=' . $channelId . '&key=' . $chaveSecreta . '&t=' . time(),
    CURLOPT_HEADER => false,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array('Accept-Encoding: gzip,deflate')
);
curl_setopt_array($ch, $options);
$arquivo = curl_exec($ch);
curl_close($ch);
$playListas = json_decode(gzdecode($arquivo));

$videos = [];
foreach ($playListas->items as $getVideo) {
    if ($getVideo->id->videoId) {
        $videos[] = $getVideo->id->videoId;
    }
}

function escrever($path, $texto, $modo)
{
    $arquivo = fopen($path, $modo);
    fwrite($arquivo, $texto . "\n");
    fclose($arquivo);
}

$pathlistavideos = './wp-content/themes/fam-2020/listavideos.json';

if($videos != null) {
	escrever($pathlistavideos, json_encode($videos), 'w');
	echo "<h3>Lista de Vídeos Atualizada !</h3>";
	echo json_encode($videos);
}else {
	echo "<h3>Lista Vazia !!!</h3>";
}

}else{
    echo "<h3>Você não tem permissão para acessar essa pagina !</h3>";
}
