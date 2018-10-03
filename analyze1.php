<!DOCTYPE html>
<html style="text-align:center;">
<head>Text Analysis/ File management</head>
<body>
<br>
<?php

//Open file, read content to array
$inputFile=fopen("input.txt","r"); // Open input.txt for reading
$fileContentString= fread($inputFile,filesize("input.txt")) or die("Cannot find input file.");
fclose($inputFile);
$wordArray= explode (",", $fileContentString);

/*
  Part I.
*/
$wordAssArray=array();
$count=0;
$stringArray=array();
// Itterate through words in array
foreach ($wordArray as $word){
  // Check if word is already in associative array
  if (array_key_exists("$word",$wordAssArray)){
    $wordAssArray["$word"]+= 1; // If yes increment frequency count

  }else{
    $wordAssArray["$word"] = 1; // If no set frequency to one
  }
  //$stringArray[$count]=$word. " : ". $wordAssArray["$word"]." : ". (String)number_format((($wordAssArray["$word"]/sizeof($wordAssArray))*100),2)."%";
  $count+=1; // Total word count
  }
$count=0;
foreach ($wordAssArray as $word => $freq) {
  $stringArray[$count++]=$word. " : ". $wordAssArray["$word"]." : ". (String)number_format((($wordAssArray["$word"]/sizeof($wordAssArray))*100),2)."%";
}

sort($stringArray); // Sort Associative array by key

echo '<div style="float:left;">';
// Itterate through Associative array

$wordFreq=fopen("word_frequency.txt","w")or die("Cannot find input file.");
$ind=0;
foreach ($stringArray as $index=>$word) {
  echo  $stringArray[$index], "<br>" ;
}
foreach ($stringArray as $index=>$word) {
  fwrite($wordFreq, $stringArray[$index]."\n" );
}
fclose($wordFreq);

/****
 *
  Part II
 *
*****/
$mutators=array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
$fakeWords=array();
$realWords=array();
foreach ($wordArray as $word){
    $misspellCheck = str_split($word);
    $newBatch = array();
  foreach ($misspellCheck as $char){
    $chance = rand(1,100);
    $mutationChance = rand(0,25);
    if ($chance <= 10){
        array_push($newBatch,$mutators[$mutationChance]);
    } else {
        array_push($newBatch, $char);
    }

  }
    $newBatchString = implode($newBatch);
    if(in_array($newBatchString,$wordArray)){
      array_push($realWords, $newBatchString);
    }else{
      array_push($fakeWords, $newBatchString);
    }
}

echo '</div>';
sort($realWords);
sort($fakeWords);
echo '<div style="float:right;"><table><tr><th>Typos</th></tr>';

$misspelledWords=fopen("misspelled.txt", "w") or die("Cannot create misspelledWords.txt .");
foreach($fakeWords as $word){
    echo '<tr><td>'.$word.'</td></tr>';
    fwrite($misspelledWords, "$word, " );
}
fclose($misspelledWords);
echo '</table></div>';

/****
 *
  Part III
 *
*****/

foreach($fakeWords as $index=>$word){
  $lev[$word]=100;
  //foreach ($dictArray as $dictWord) {
  foreach($wordArray as $index1=>$dictWord){
    if (levenshtein($word,$dictWord)<$lev[$word]){

  //  if (levenshtein($word,$dictWord)<$lev[$word]){
      $lev[$word]=$dictWord;
    }else{}
  }
}

$levFile=fopen("levFile.txt", "w") or die("Could not open file for writing.");
foreach($lev as $word=>$dictSib){
  $levNum=(String)levenshtein($word,$lev[$word]);
  fwrite($levFile, "$word".":"."$dictSib".":"."$levNum\n" );
}
fclose($levFile);
?>
</body>
</html>
