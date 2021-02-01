<?php
class ImgDownloader {
	

	public static function slugify($text){
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}

	public static function onLoad($stranka) {
		echo "<h2><a target='_blank' href='".$stranka."'>".$stranka."</a></h2>";
		$dom = new DOMDocument();
		$dom->loadHTML(file_get_contents($stranka));
		$dom->preserveWhiteSpace = false;
		$images = $dom->getElementsByTagName('img');
		$url_info = parse_url($stranka);
		$url_base = $url_info['scheme']."://".$url_info['host'];
		$i = 0;
		$alt_names = array();
		echo "<ul>";
		foreach ($images as $image) {
		  $i++;
		  echo "<li>";
		  $title = $image->getAttribute('alt');
		  $alt = self::slugify($image->getAttribute('alt'));
		  $src = $image->getAttribute('src');
		  if (substr( $src, 0, 1 ) === "/") {
		  	$src = $url_base.$src;
		  }
		  if (strpos($src, "size-decor-v-1" )!== false) {
		  	$src = str_replace("-size-decor-v-1", "", $src);
		  }
		  if (strpos($src, "frontend-medium" )!== false) {
		  	$src = str_replace("size-frontend-medium-v-4", "size-large-v-1", $src);
		  }
		  echo "<p class='title'>".$title."</p>";
		  echo "<p class='src'>".$src."</p>";
		  if (!is_dir('images/')) {
		    mkdir('images/');
		  }
		  if ($alt) {
		  	if( in_array( $alt, $alt_names )){
				file_put_contents("images/".$alt."-".$i.".jpg", fopen($src, 'r'));
		  	}else{
			  	array_push($alt_names, $alt);
				file_put_contents("images/".$alt.".jpg", fopen($src, 'r'));
		  	}
		  }else{
		  	file_put_contents("images/".$i.".jpg", fopen($src, 'r'));
		  }
		  echo "</li>";
		}
		echo "</ul>";

    }
}
