<?php

function smallImage($path) {
    $newPath=str_replace(basename($path), 'small-'.basename($path), $path);
    return $newPath;

}

?>