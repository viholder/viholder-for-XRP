<?php

class lingue_signa {

     public $debub;
	   public $file;
     public $name;
     public $dir;
	
	 public function __construct($debub,$filename,$name)
    {
         $this->debub = $debub; 
		     $this->filename = $filename; 
		     $this->name = $name; 
		     $this->dirpath = "TRANSCRIPT/";
    }
	
	public function signa_stats(){
		
	$string=self::transcripcions();
	$total=0;
	$file = file_get_contents($this->dirpath."DICTIONARY/".$this->filename, true);
	$frase="";
	$palabras = explode(",", $file);

	  for ($i = 0; $i <= count($palabras)-1; $i++) { 		 
		 if (!empty($palabras[$i])){
			 if ( substr_count($string, " ".$palabras[$i]." ")>0){
				   $frase=$frase." ".substr_count($string, " ".$palabras[$i]." ")." ".$palabras[$i]."<br>";
		    	 $total=$total + substr_count($string, " ".$palabras[$i]." ");
			 }
		 }
	  }
	
		if ($this->debub=="yes"){ 
				 
	       return  $total."<br>".$frase;	
		 }else{
		  	$out['name']=$this->name;
		  	$out['total']=$total;
		    return $total;
		}
	
    }
	
	public function transcripcions(){
	
		
 		$files = scandir($this->dirpath."TRANSCRIPTIONS/");
		$out="";
		
		foreach($files as $file) {
  		  	if (strpos($file, '.txt')) {
     	 	  	$out.=  file_get_contents($this->dirpath."TRANSCRIPTIONS/".$file, true)."<br><br><br>";
   			 }
		}
	
		return $out;
}
	
}
