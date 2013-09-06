<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'configure.php';

$baseUrl  = dirname($_SERVER['PHP_SELF']) . '/';
$request = str_replace($baseUrl, '', $_SERVER['REQUEST_URI']);

function link_to($link) 
{
    global $baseUrl;
    return $baseUrl . $link;
}

function getNews($section = null)
{
    global $db;
    $stmt = $db->prepare('SELECT SUM(views) + 1 FROM news');
    $stmt->execute();
    $totalViews = $stmt->fetchColumn();
    $where = !$section ? '1' : "section = '$section'";    
    $sql = "
        SELECT 
            id, 
            provider, 
            title, 
            description, 
            pub_date, 
            ((((views + 1) / $totalViews) * 7) + (1 / ROUND((UNIX_TIMESTAMP() - UNIX_TIMESTAMP(pub_date)) / 60)) * 3) as score
        FROM news 
        WHERE $where
        ORDER BY score DESC, views DESC, pub_date DESC
        LIMIT 40";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_CLASS, 'Article');
    return $news;

}

function goToNews($id)
{
    global $db;
    $stmt = $db->prepare('UPDATE news SET views = views + 1 WHERE id = ?');
    $stmt->execute(array($id));

    $stmt = $db->prepare('SELECT link FROM news WHERE id = ?');
    $stmt->execute(array($id));
    $link = $stmt->fetchColumn();
    header("Location: $link");
    die;
}

$section = false;
if ($request && strpos($request, '/') !== false) {
    list($section, $value) = explode('/', $request);
}

switch($section) {
    case 'go':
        goToNews($value);
    break;
    case 'about':
        $title = $config['_site']['about'] ;
        include __DIR__ . DIRECTORY_SEPARATOR . 'header.php';
        include __DIR__ . DIRECTORY_SEPARATOR . 'about.php';
        include __DIR__ . DIRECTORY_SEPARATOR . 'footer.php';
        die;
    break;
}

if ($request && !isset($config['_sections'][$section])) {
    header("HTTP/1.0 404 Not Found");
    $title = $config['_site']['not_found'];
    include __DIR__ . DIRECTORY_SEPARATOR . 'header.php';
    include __DIR__ . DIRECTORY_SEPARATOR . '404.php';
    include __DIR__ . DIRECTORY_SEPARATOR . 'footer.php';
    die;
}

$news = getNews($section);
$main = array_shift($news);
$submain = array();
$submain[] = array_shift($news);
$submain[] = array_shift($news);

$totalNews = count($news);
$important = array();
for ($i = 0; $i < $totalNews && $i < 10; $i++)
{
    $important[] = array_shift($news);
}
$title = $main->getTitle();

include __DIR__ . DIRECTORY_SEPARATOR . 'header.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'layout.php';
include __DIR__ . DIRECTORY_SEPARATOR . 'footer.php';
