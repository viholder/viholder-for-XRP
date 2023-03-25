
<?= $this->extend('admin/auth/layout') ?>
<?= $this->section('content') ?>


<style>
    	body {
            margin:0px;
        }
       
	 @media  (max-width: 800px) {
        #viholder-cover {
        background-image: url("<?php echo base_url('assets/admin/img/viholder-zurich-bridge-back.jpg' ); ?>");           
 
              }
    }

	 @media  (min-width: 800px) {
        #viholder-cover {
          background-image: url("<?php echo base_url('assets/admin/img/viholder-zurich-back.jpg' ); ?>");  
        }
    }
	
	 
	#viholder-cover{  
	    width:100%;
         background-position: center;
 	     background-repeat: no-repeat;
         background-size: cover;
		 max-width: 100%;
         height: calc(100vh - 16px);
	}
	  
	
	#viholder-cover-frame{ 
		top:0px;
		 width:100%;
 		 max-width: 100%;
        height: calc(100vh - 16px);
		/* background:#212121; */
		position:absolute;
		  display: flex;
  		justify-content: center;
 		 align-items: center;  
	}
	
	#logo-viholder-box{
		top:-20px;
	    width:300px;
		height:55px;
		display:block;
		background:#cf2e2e;
		position:relative;
		background-image: url("<?php echo base_url('assets/admin/img/viholder-white.png' ); ?>");
	    background-repeat: no-repeat;
        background-size: contain;
		 background-position: 0px 0px;
	    
	}
</style>
<div id="viholder-cover"> 
	 
	
     <div id="viholder-cover-frame">  

 	     <div id="logo-viholder-box">  </div>
 </div>
