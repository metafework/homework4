<!DOCTYPE html>
<html>
<head>Text Analysis/ File management</head>
<body>
<br>
<?php

$inputFile=fopen("input.txt","r");
$fileContentString= fread($inputFile,filesize("input.txt")) or die("Cannot find input file.");
$wordArray= explode (",", $fileContentString);
/*foreach ($wordArray as $key => $word) {
  echo $word;
}*/
$wordAssArray=array();
$count=0;
foreach ($wordArray as $word){
  $count+=1;
  if (array_key_exists("$word",$wordAssArray)){
    $wordAssArray["$word"]+= 1;
  }else{
    $wordAssArray["$word"] = 1;
  }
  }
ksort($wordAssArray);
foreach ($wordAssArray as $word => $freq) {
    echo  $word, " : ", $freq," : ", number_format((($freq/sizeof($wordAssArray))*100),2),"%", "<br>" ;
}
?>
</body>
</html>
