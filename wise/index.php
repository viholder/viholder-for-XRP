 <?php
 $inputJSON = file_get_contents('php://input');
  $input2= json_decode( $inputJSON, true ); 
  $input= json_encode( $inputJSON ); 


 $file = '/opt/bitnami/apache/htdocs/vh/uploads/media/wise_data.json';
 $file2 = '/opt/bitnami/apache/htdocs/vh/uploads/media/wise_data2.json';

 
 file_put_contents($file, $input);
 file_put_contents($file2, $input2['id']);
