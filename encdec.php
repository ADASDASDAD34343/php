<?php

function encdec($inText,$key) {
 for($i=0;$i<strlen($inText);)  {
     for($j=0;$j<strlen($key);$j++,$i++) {
         $outText .= $inText{$i} ^ $key{$j};
     }
 }
 return $outText;
}

?>
