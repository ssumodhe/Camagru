     <?php
//            $html = file_get_contents('home.php');
//    
//    preg_match_all('/<img[^>]+>/i',$html, $imgTags); 
//
//for ($i = 0; $i < count($imgTags[0]); $i++) {
//  // get the source string
//  preg_match('/src="([^"]+)/i',$imgTags[0][$i], $imgage);
//
//  // remove opening 'src=' tag, can`t get the regex right
//  $origImageSrc[] = str_ireplace( 'src="', '',  $imgage[0]);
//}
//// will output all your img src's within the html string
//print_r($origImageSrc);
    
    
            $dom = new DOMDocument();
            $dom->loadHTML('home.php');
            $listeImages = $dom->getElementsByTagName("img");
            foreach ($listeImages as $image)
            {
                $photo = $image->getAttribute('src');
//                $photo = imagecreatefromstring($_SESSION['img']);
                echo ("<img src=\"".$photo."\"/>");
            }
            ?>