<?php
require "fonctions.php";
require "head.php";
require "input.php";
 uploadFiles();
require "tableau.php";

// Si dir exist

if (isset ( $_GET['dir'] )){
    
    $directory = $_GET['dir']; 
} else {
    $directory = './'; 
}

        // if delete exist
if (isset($_GET['delete']) && $_GET['delete'] == 1){ 

    $fileToDelete = $_GET['file']; 

    //rmdir for delete directory or unlink for delete file

    if( is_dir($fileToDelete)){  
        rrmdir($fileToDelete);   
    }
    else {
        unlink($fileToDelete);
    }
    $_GET['delete'] = 0;
}



// for every value

foreach (new DirectoryIterator($directory) as $result){
    

    // some var for next step. 
    //getFilename, getSize and getMTime are Directory Methods.

    $fileName = $result->getFilename();
    $chemin = $directory  . '/' . $fileName;
    $sizeUnits=formatSizeUnits( $result->getSize() );
    $time=date("d F Y H:i:s", $result->getMTime());
    $table= $chemin . "'>" . $fileName . "</a></td><td>" . $sizeUnits . "</td>
    <td>". $time . "</td>
    <td><a href='?delete=1&file=".$chemin. "'>Delete Now!</a></td>
    </tr>";
    
    
    echo "<tr>";
    
    // skip directory '.' and '..'
    
    if($result->isDot()) continue;
    

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
