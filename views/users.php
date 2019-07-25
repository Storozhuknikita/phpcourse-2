<?php

foreach($users as $user){
    echo '<a href="?a=user&amp;id='.$user->id.'"> '.$user->id.'/ '.$user->user_name.'</a> ';
    echo '<a href="?a=delete&amp;id='.$user->id.'" style="color: red;">[x]</a><br/>';
}

?>