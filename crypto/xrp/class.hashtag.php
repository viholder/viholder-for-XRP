<?php
/**
 * Hastag Class
 * A class that outputs hashtags from an input phrase, it generates links to Instagram, Twitter and plain text
 * inputs: 
 * phrase and service: Instagram, Twitter
 * @author Jean Paul Delaye 
 */

class hashtag {
	
	 public $phrase="";
	 
	 public function __construct($phrase) {
    
	     $this->phrase = $phrase;
		 
	 }
		 
  
     public function get_words($service) {	
		 
		  
 		 $rowphrase  =  $this->phrase;
		 $removethis = array("“", ".", "-", "@", ",", ";", ":", "_", "/", "¿", "?", "(", ")", "&", "$", "#","{", "}", "+", "*", "^", "!", "¡", "=", "%", "[" ,"]" );
     $notwanted = array("y", "ni", "no", "solo", "sino", "también", "tanto", "como", "así", "igual", "que", "lo", "mismo", "pero", "mas", "mientras", "ya", "ora", "sea", "en", "lo", "la", "en", "com", "el", "es", "con", "un", "a", "hacia", "de", "in", "of", "at", "the", "this", "that", "those", "into", "out");
	
	
		$frase = str_replace($removethis, "", $rowphrase);
		$words = explode(" ", $frase);
	    $out="";
		 
		for ($x = 0; $x <= count($words)-1; $x++) {
	 
			if (in_array($words[$x], $notwanted)){

			}else{
		       
				
				if ($service=="hastag"){ 
					 $out.= "<br>#".$words[$x]; 
				} 
				if ($service=="instagram"){ 
					 $out.= "<br><a href='https://www.instagram.com/explore/tags/".$words[$x]."'>#".$words[$x]."</a>";
				} 
				if ($service=="twitter"){ 
					 $out.= "<br><a href='https://twitter.com/hashtag/".$words[$x]."'>#".$words[$x]."</a>";
				} 
				
				if ($service=="plain"){ 
				 $out.= "<br>".$x." ".$words[$x];
				}
				 
 			}

		} 
	
          return $out;		 
	
}
