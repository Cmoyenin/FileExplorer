<?php 


// function for setup size units

function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824)
    {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576)
    {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    elseif ($bytes >= 1024)
    {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    elseif ($bytes > 1)
    {
        $bytes = $bytes . ' bytes';
    }
    elseif ($bytes == 1)
    {
        $bytes = $bytes . ' byte';
    }
    else
    {
        $bytes = '0 bytes';
    }
    return $bytes;
}


//function for upload your files
function uploadFiles(){
    if (isset($_FILES["fileToUpload"])){
        $target_dir = './upload/' ;  // should be on mod775 with linux ( serveur )
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); 
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file); 
    }
}


//function for delete your files

function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}




//function for setup time zone.

date_default_timezone_set('Europe/Paris');

?>

