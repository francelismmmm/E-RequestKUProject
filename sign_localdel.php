<?php
function fulldelete($location) {   
    if (is_dir($location)) {   
        $currdir = opendir($location);   
        while ($file = readdir($currdir)) {   
            if ($file  <> ".." && $file  <> ".") {   
                $fullfile = $location."/".$file;   
                if (is_dir($fullfile)) {   
                    if (!fulldelete($fullfile)) {   
                        return false;   
                    }   
                } else {   
                    if (!unlink($fullfile)) {   
                        return false;   
                    }   
                }   
            }   
        }   
        closedir($currdir);   
        if (! rmdir($location)) {   
            return false;   
        }   
    } else {   
        if (!unlink($location)) {   
            return false;   
        }   
    }   
    return true;   
} 
 ?>