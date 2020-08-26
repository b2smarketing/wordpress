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
// Usuário e ApiKey do Youtube
$username = 'famamericana';

// Crie uma API KEY no https://code.google.com/apis/console, não se esqueça de habilitar o Youtube Data API
$apiKey = 'AIzaSyAEtAlNZzSTAVQjy2Xmsq__WSXAoz3lYgk';

$channelUrl = "https://www.googleapis.com/youtube/v3/channels?forUsername={$username}&part=contentDetails&key={$apiKey}";
$videosUrl = "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=20&key={$apiKey}";

function request($url) {
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
  $body = curl_exec($curl);
  curl_close($curl);

  return json_decode($body);
}

$channel = request($channelUrl)->items[0]->contentDetails;
$playlistId = $channel->relatedPlaylists->uploads;

$videos = request("{$videosUrl}&playlistId={$playlistId}")->items;

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
Timber::render( array( 'page-' . $post->post_name . '.twig', 'page.twig' ), $context );