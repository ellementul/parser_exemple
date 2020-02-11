<?
   
    
    $auctions = require 'auctions.php';
    $table = require 'table.php';
    $db = require 'client_db.php';
    
    $url = 'https://etp.eltox.ru/registry/procedure';
    $auction_arr = $auctions['get']($url);
    
    echo $table['build']($auction_arr);
    $db['add_auction']($auction_arr);
?>



