<?php


if(isset($_GET['keyword'])  ){

$response = array();

$keyword = $_GET['keyword'];


$api = 'AIzaSyB2__dPng5IGT9Nlca0UT7FxN459mrITmo';
$data = file_get_contents('https://www.googleapis.com/books/v1/volumes?q='.$keyword);



$book = json_decode($data);
$meta_data = $book->items;


for($i = 0; $i < count($meta_data); $i++)
{
    $title = $meta_data[$i]->volumeInfo->title;
    $author = $meta_data[$i]->volumeInfo->authors;
    $desc = @$meta_data[$i]->volumeInfo->description;
    $link = @$meta_data[$i]->volumeInfo->previewLink;
    $cat = @$meta_data[$i]->volumeInfo->categories;
    $pages = @$meta_data[$i]->volumeInfo->pageCount;
    $thumb = $meta_data[$i]->volumeInfo->imageLinks->thumbnail;


    array_push($response, array(
        'title'=>$title,
        'author'=>$author,
        'pages' => $pages,
        'image'=>$thumb,
        'desc'=>$desc,
        'link'=>$link
    ));

}


    echo json_encode($response);


}


?>