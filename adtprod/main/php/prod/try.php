<?php

function foo($seconds) {
  $t = round($seconds);
  return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}

echo foo('172.92'), "\n";
echo foo('9290.52262423327'), "\n";
echo foo(86400+120+6), "\n";
?>