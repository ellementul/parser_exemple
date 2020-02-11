<?

    define ('HOST',	"localhost");
    define ('DB_USER', "046131335_ret");
    define ('DB_PASSWORD', "MySQL2020");
    define ('DB', "id260471578-0_test");
    
    $insert = function($auctions){
    
        $db_link = mysqli_connect( HOST, DB_USER, DB_PASSWORD, DB );
        
        foreach($auctions as $auction){
            
            $cod = $auction['id'];
            $link = $auction['link'];
            $query = "INSERT INTO auctions (cod, link) VALUE ('$cod', '$link')";
            $result = mysqli_query($db_link, $query);
            if(!mysqli_query($db_link, $query)) echo 'Ошибка добавления записей в базу!';
            
            $query = "SELECT * FROM auctions WHERE cod IN ('$cod')";
            $result = mysqli_query($db_link, $query);
            
            $uid_auction = mysqli_fetch_row($result)[0];
            
            foreach($auction['docs'] as $doc){
                $query = "INSERT INTO documents (link, uid_auction) VALUE ('$doc', '$uid_auction')";
                if(!mysqli_query($db_link, $query)) echo 'Ошибка добавления записей в базу!';
            }
        }
        
        
        mysqli_close( $db_link );
    };
    
    return ['add_auction' => $insert];
?>