<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();

$cat = 27; //dicas
$dicas = Timber::get_posts('cat='.$cat);
//print_r($dicas[0]);
$context['dicas'] = $dicas;


// YOUTUBE LISTA DE VIDEOS DO CANAL
// Obs.: Crie uma API KEY no https://code.google.com/apis/console, não se esqueça de habilitar o Youtube Data API


$maxResults=3;
$chaveSecreta = 'AIzaSyA-TDeAYf3PL2jgHHibj_4024XodKWTepw';
$channelId = 'UCpk07TjMWhMr3Wv-bFnkk-A';
$ch = curl_init();
$options = array(
    CURLOPT_URL => 'https://www.googleapis.com/youtube/v3/search?maxResults='.$maxResults.'&order=date&part=snippet&channelId=' . $channelId . '&key=' . $chaveSecreta . '&t=' . time(),
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
    $videos[] = $getVideo->id->videoId;
}

//print_r($videos);

$context['post'] = $post;
$context['videos'] = $videos;
if ($post->post_name == "clube-de-vantagens-fam") {
    $args = array(
        // Get post type project
        'post_type' => 'parceiro',
        // Get all posts
        'posts_per_page' => -1
    );
    $posts = Timber::get_posts( $args );
    $context['parceiros'] = $posts;
}
else if ($post->post_name == "encontrocomeducadores-famtalks") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://conteudo.vestibularfam.com.br/encontro-com-educadores-fam-talks");
    exit();
}
else if ($post->post_name == "megadescontofam") {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://megadesconto2019.vestibularfam.com.br/");
    exit();
}
if(wp_is_mobile()){
    $context['tamanho'] = 450;  
}else{
    $context['tamanho'] = 500;
}
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );