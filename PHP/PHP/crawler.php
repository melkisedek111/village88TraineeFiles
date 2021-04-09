<?php
    $searchString = "search?q=coding+ninjas&num=100";
    $url = "https://www.google.com/$searchString";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    $result = curl_exec($curl);
    $doc = new DOMDocument();
    $doc->loadHTML($result, LIBXML_NOERROR);
    $nodes = $doc->getElementsByTagName('title');
    $title = $nodes->item(0)->nodeValue;
    $links = $doc->getElementsByTagName('div');
    echo "<h1>$title</h1> Related Links";
    $filteredLinks = [];
    for ($i = 0; $i < $links->length; $i++) {
        $link = $links->item($i);
        if ($link->getAttribute('class') == 'BNeawe UPmit AP7Wnd') {
            if(strpos($doc->saveXML($link), "ninjas") !== false)
                $filteredLinks[] = $doc->saveXML($link);
        }
    }
    echo "<pre>";
    var_dump($filteredLinks);
    curl_close($curl);
