<?php

$misspelledFile=fopen("misspelled.txt", "r")or die("Could not open misspelled word file.");
$misspelledArray=explode($misspelledFile,",");
fclose("misspelled.txt");

$dictFile=fopen("engmix.txt", "r")or die("Could not open dictionary file.");
$dictArray=explode($dictFile,",");
fclose("engmix.txt");



foreach($misspelledArray as $word){
  $lev[$word]=-1;
  foreach ($dictArray as $dictWord) {
    if ($lev[$word]==-1 or levenshtein($word,$dictWord)<$lev){
      $lev[$word]=$dictWord;
    }
  }
}

$levFile="levFile.txt";
fopen($levFile, "w") or die("Could not open file for writing.")
foreach($lev as $word => $dictSib){
  fwrite($levFile, "$word, : , $dictSib, : , levenshtein($word,$dictSib) ",)

}



?>
