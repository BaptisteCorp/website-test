<?php
$note = (int)readline('Entre ta note :');
if ($note <= 12) {
    echo 'T\'es nul';
} elseif ($note === 14) {
    echo 'Brova';
} else {
    echo'Pas mal';
}
//coucou les petits potes
switch ($note){    // Sert a rien mais pour tester
    case 14:
        echo 'Brova';
        break;
    
}
/*
oui 
*/
?>
