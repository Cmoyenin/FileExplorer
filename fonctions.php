<?php 


// fonction pour changer le format de la taille des fichiers

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

function uploadFiles(){
    if (isset($_FILES["fileToUpload"])){
        $target_dir = './upload/' ;  // devra être en mode 775 sous linux ( serveur )
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // On créé le nom du fichier   
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file); //On copie le contenu du fichier
    }
}


//fonction de suppression de dossier v1 recursive

function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}




//On défini le fuseau horaire sur Paris

date_default_timezone_set('Europe/Paris');

?>

