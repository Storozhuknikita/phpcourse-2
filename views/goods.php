<?php

foreach($goods as $good){
    echo '<a href="?a=good&amp;id='.$good->id.'"> '.$good->id.'/ '.$good->name.'</a><br/>';
}

?>