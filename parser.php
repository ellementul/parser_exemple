<?

define('MAIN_REG', '#<div.+?class\s*?=\s*?(["\'])registerBox procedure-list-item\1.*?>(.+?)</table>#su');
define('AUCTION_REG', '#<a.+?href\s*?=\s*?(["\'])(?P<href_auction>.+?)\1.*?>(.+?)№ ООС: (?P<id_auction>\d{10,20})#su');
define('DOC_REG','#<span.+?>\s<a\s+?href\s*?=\s*?(["\'])(?P<href_doc>.+?)\1\.*?>#su');


$main_page = function ($page){
    
    preg_match_all(MAIN_REG, $page, $list);
    
    $auctions_strs =  $list[2];
    
    $auctions = [];
    
    foreach ($auctions_strs as $auction_str) {
        
        preg_match_all(AUCTION_REG, $auction_str, $list);
        
        $auctions[] = [
            'id' => $list['id_auction'][0],
            'link' => $list['href_auction'][0],
            'docs' => ['No document'],
        ];
    
    }
    
    return $auctions;
};

$find_docs = function ($page){
        
        preg_match_all(DOC_REG, $page, $list);
        return $list['href_doc'];
};


return [
    'main_page' => $main_page,
    'auction_cart' => $find_docs,
];

?>