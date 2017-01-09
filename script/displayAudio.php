<?php


$dir_path = "../uploads";
$extensions_array = array('mp3','wav');

if(is_dir($dir_path))
{
    $files = scandir($dir_path);
	
    for($i = 0; $i < count($files); $i++)
    {
        if($files[$i] !='.' && $files[$i] !='..')
        {
            // get file name
            echo "File Name -> $files[$i]<br>";
            
            // get file extension
            $file = pathinfo($files[$i]);
            $extension = $file['extension'];
            echo "File Extension-> $extension<br>";
            
           // check file extension
            if(in_array($extension, $extensions_array))
            {
            // show image
            echo "<img src='$dir_path$files[$i]' style='width:100px;height:100px;'><br>";
            }
        }
	}
}

?>