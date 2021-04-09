<?php
$states = array('CA', 'WA', 'VA', 'UT', 'AZ');
$html1 = "<select><option >Select States</option>";
for ($i=0; $i < count($states); $i++) { 
    $html1 .= "<option value='$states[$i]'>$states[$i]</option>";
}
$html1 .= "</select>";
echo $html1;

$html2 = "<select><option >Select States</option>";
foreach($states as $state) {
    $html2 .= "<option value='$state'>$state</option>";
}
$html2 .= "</select>";
echo $html2;

$states[] = 'NJ';
$states[] = 'NY';
$states[] = 'DE';

$html3 = "<select><option >Select States</option>";
for ($i=0; $i < count($states); $i++) { 
    $html3 .= "<option value='$states[$i]'>$states[$i]</option>";
}
$html3 .= "</select>";
echo $html3;

$html4 = "<select><option >Select States</option>";
foreach($states as $state) {
    $html4 .= "<option value='$state'>$state</option>";
}
$html4 .= "</select>";
echo $html4;