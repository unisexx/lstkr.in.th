<?php
if(!function_exists('genFilename')) {
function genFilename($f = false, $index = false) {
	return uniqid($index).($f?'.'.pathinfo($f, PATHINFO_EXTENSION):null);
}}

if(!function_exists('downloadFile')) {
function downloadFile($path = false, $name = false, $title = false) {
	$filePath = $path.'/'.$name;
    $fileName = explode('.',$name);
    $fileName = ($title?$title.'.'.end($fileName):$name);
    if(file_exists($filePath)) {
        return Response()->download(
            $filePath,
            $fileName,
            [ 'Content-Length: '. filesize($filePath) ]
        );
    } else {
        exit('Requested file does not exist on our server!');
    }
}}
?>
