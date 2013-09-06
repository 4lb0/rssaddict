<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'configure.php';

function parseRss($url)
{
    $rss = new SimpleXMLElement(file_get_contents($url));
    $entries = array();
    foreach ($rss->channel->item as $item) {
        $entries[] = array(
            'title' => (string) $item->title,
            'link' => (string) $item->link,
            'description' => (string) $item->description,
            'pub_date' => date("Y-m-d H:i:s", strtotime((string) $item->pubDate)),
        );
    }
    return $entries;
}

function saveNews($news)
{
    global $db;
    ksort($news);
    $stmt = $db->prepare('
        INSERT INTO news (description, link, provider, pub_date, section, title) 
        VALUES (?, ?, ?, ?, ?, ?) ');
    $stmt->execute(array_values($news));
}

foreach ($config as $provider => $urls) {
    if (!configIsSpecial($provider)) {
        foreach ($urls as $section => $url) {
            if (!configIsSpecial($section)) {
                echo "$provider $section -> $url\n";
                $defaultInfo = array(
                    'section' => $section,
                    'provider' => $provider,
                );
                $entries = parseRss($url);
                foreach ($entries as $entry) {
                    saveNews(array_merge($entry, $defaultInfo));
                }                    
            }
        }
    }
}

