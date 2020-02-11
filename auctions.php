<?
    $parser = require 'parser.php';
    
    $get_auctions = function($url) use ($parser){
            
        $site = parse_url($url);
        
        //==============Get Main Page================================================================
        
        $page = file_get_contents($site['scheme'] . '://' . $site['host'] . $site['path']);
        
        
        $auctions = $parser['main_page']($page);
        
        //==============Get Auction Carts================================================================
        
        foreach ($auctions as $auction) {
            $auction['cart_page'] = file_get_contents($site['scheme'] . '://' . $site['host'] . $auction['link']);
        }
        
         //==============Parsing Docs================================================================
        
        foreach ($auctions as $auction) {
            $auction['docs'] = $parser['auction_cart']($auction['cart_page']);
        }
        
        return $auctions;
    };
    
    return ['get' => $get_auctions];
?>