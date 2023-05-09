<?php
if(!empty($_GET['file'])){
    $file_upload  = basename($_GET['file']);
    $filePath  = "../web/".$file_upload;

    echo $filePath;
    
    if(!empty($file_upload) && file_exists($filePath)){
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; file_upload=$file_upload");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        //read file 
        readfile($filePath);
        exit;
    }
    else{
        echo "file does not exist";
    }
}
