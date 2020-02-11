<?

    $auctions = require 'auctions.php';
    
    function wrap_tag($content, $tag){
        return '<' . $tag . '>' .  $content . '</' . $tag . '>';
    }
    
    function build_head_table($auction){
        $head ='';
        foreach ($auction as $key => $item) {
            $head .= wrap_tag($key, 'td');
        }
        
        return wrap_tag(wrap_tag($head, 'tr'), 'thead');
    }
    
    function build_body_table($auctions){
        $body = '';
        foreach ($auctions as $auction) {
            
            $stroke ='';
            foreach ($auction as $key => $item) {
                
                $doc_str = '';
                if($key == 'docs')
                    foreach ($item as $doc)
                        $doc_str .= wrap_tag($doc, 'p');
                else
                    $doc_str .= $item;
                    
                $stroke .= wrap_tag($doc_str, 'td');
            }
            
            $body .= wrap_tag($stroke, 'tr');
        }
        
        return wrap_tag($body, 'tbody');
    }
    
    $build_table = function($auctions){
        $table = build_head_table($auctions[0]);
        $table .= build_body_table($auctions);
        
        return wrap_tag($table, 'table');
    };
    
    return ['build' =>  $build_table];

?>