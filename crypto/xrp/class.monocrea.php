 <?php

/**
 * Monocrea Class
 * TPhp class that output a character drawing. It loads random SVG files from 3 directories, 
 * each one containig parts of the character body to be created. Heads, Body and Legs.
 * @author Jean Paul Delaye 
 */



class monocrea  {
	
  public $monocrea="";
  public $cabeza="";
  public $cuerpo="";
  public $piernas="";
	
  public function __construct( ) {
	  
 	   
  }
	
  public function get_mono($parte) {	  
 
	  if($parte=="cabeza"){$dir = 'MONOCREA/CABEZAS/';}
	  if($parte=="cuerpo"){$dir = 'MONOCREA/CUERPOS/';}
	  if($parte=="piernas"){$dir = 'MONOCREA/PIERNAS/';}

 	  $fileNames = array();
	  
	  if(is_dir($dir)){
  		  $handle = opendir($dir);
   		  while(false !== ($file = readdir($handle))){
       	 		 if(is_file($dir.'/'.$file) && is_readable($dir.'/'.$file)){
               		 $fileNames[] = $file;
      		 	 }
   		   }
   
		    closedir($handle);
   		    $fileNames = array_reverse($fileNames);
		   
	 }else {
 		    return "<p>There is an directory read issue</p>";
		    exit;
	 }
	  
		    return $dir.$fileNames[rand(0, count($fileNames)-1)];
	 
  }
	
  function __destruct() { 
	  
          $cabeza =  self::get_mono("cabeza");
	  $cuerpo =  self::get_mono("cuerpo");
	  $piernas =  self::get_mono("piernas");

	  $mono_cabeza_svg  = '<svg  height="300" width="300" transform="translate(300,0) scale(1)" >'.file_get_contents( $cabeza ).'</svg>';
          $mono_cuerpo_svg  = '<svg  height="300" width="300" transform="translate(300,300) scale(1)" >'.file_get_contents( $cuerpo ).'</svg>';
	  $mono_piernas_svg = '<svg height="300" width="300" transform="translate(300,600) scale(1)" >'.file_get_contents( $piernas ).'</svg>';
	  
	  
	  echo  ' <div id="dibujo"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1200 1200" transform=" scale(1)" >'.$mono_cabeza_svg.$mono_cuerpo_svg.$mono_piernas_svg. "</svg></div>";
	  
   }	
}
	
	  
	


