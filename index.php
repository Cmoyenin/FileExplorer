<?php
require "fonctions.php";
require "head.php";
require "input.php";
 uploadFiles();
require "tableau.php";

// Si dir existe, donc qu'il y a un chemin qui existe

if (isset ( $_GET['dir'] )){
    
    $directory = $_GET['dir']; // Le chemin est celui affiché dans l'URL, le chemin de dir
} else {
    $directory = './'; // Sinon, c'est le chemin par défaut ./ qui est la racine du dossier
}


if (isset($_GET['delete']) && $_GET['delete'] == 1){ // si on clique sur delete, delete vaut quelque chose

    $fileToDelete = $_GET['file']; //$fileToDelete récupère le chemin du fichier à supprimer 

    if( is_dir($fileToDelete)){    //si le fichier est un dossier : rmdir, sinon unlink pour supprimer
        rrmdir($fileToDelete);   
    }
    else {
        unlink($fileToDelete);
    }
    $_GET['delete'] = 0;
}



// Pour chaque valeur (fichier) on créé une nouvelle itération de l'objet 'directory' : 

foreach (new DirectoryIterator($directory) as $result){
    
    // On récupère la méthode Filename : le nom du fichier, getSize : la taille du fichier et getMTime : la date de modification du fichier
    
    $fileName = $result->getFilename();
    $chemin = $directory  . '/' . $fileName;
    $sizeUnits=formatSizeUnits( $result->getSize() );
    $time=date("d F Y H:i:s", $result->getMTime());
    // Tableau généré tout seul par une variable 
    $table= $chemin . "'>" . $fileName . "</a></td><td>" . $sizeUnits . "</td>
    <td>". $time . "</td>
    <td><a href='?delete=1&file=".$chemin. "'>Delete Now!</a></td>
    </tr>";
    
    
    echo "<tr>";
    
    // Si la valeur du fichier est un . ou un .. on continue sans rien faire
    
    if($result->isDot()) continue;
    
    // Si le resultat est un dossier, on affiche le chemin avec le dir sinon sans le dir
    if ($result->isDir()){   
        
        echo "<td><a href='?dir=";    
    } else {
        echo "<td><a href='" ;
    }
    
    
    
    echo $table;
    echo "</tr>"; 
} 

require "footer.php";
?>
