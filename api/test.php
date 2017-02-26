<?php

$string = "\"[\\\"Cu,tom Exh,b't Material, for\\\",\\\"QUALCOMM\\\",\\\"MWC\\\",\\\"13-008\\\",\\\"W    D    N\\\",\\\"H    N\\\",\\\"Dimensions:    41    x    36    x    63\\\",\\\"Weight:    337    lbs.\\\",\\\"3) DIMMABLE TRANSFORMERS^\\\",\\";

$string = stripcslashes($string);
$string = str_replace('"["',"", $string);
$string = str_replace('","'," ", $string);
$string = str_replace('"]"',"", $string);

echo $string;