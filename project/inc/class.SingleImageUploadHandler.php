<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class
 *
 * @author Tony Li
 */
class UnknownImageExtensionException extends Exception {
    
}

class SingleImageUploadHandler {

    private $filename;
    private $extension;
    private $src;
    private $width;
    private $height;

    function __construct($name, $maxsize=10485760) {
        if ($_FILES[$name]['error'] > 0) {
            throw new Exception();
        }

        $this->filename = stripslashes($_FILES[$name]['name']);
        $this->extension = getExtension($this->filename);
        $this->extension = strtolower($this->extension);
        if (($this->extension != "jpg") && ($this->extension != "jpeg") && ($this->extension != "png") && ($this->extension != "gif")) {
            throw new UnknownImageExtensionException();
        }
        $uploadedfile = $_FILES[$name]['tmp_name'];
        if ($this->extension == "jpg" || $this->extension == "jpeg") {
            $this->src = imagecreatefromjpeg($uploadedfile);
        } else if ($this->extension == "png") {
            $this->src = imagecreatefrompng($uploadedfile);
        } else {
            $this->src = imagecreatefromgif($uploadedfile);
        }

        $imsize = getimagesize($uploadedfile);
        $this->width = $imsize[0];
        $this->height = $imsize[1];
    }

    function saveAs($path, $newwidth, $newheight) {
        if (!file_exists(dirname($path))) {
            mkdir(dirname($path), 0777, true);
        }
        $tmp = imagecreatetruecolor($newwidth, $newheight);
        if ($newwidth > $newheight) {
            $newheight = ($this->height / $this->width) * $newwidth;
        } else {
            $newwidth = ($this->width / $this->height) * $newheight;
        }
        imagecopyresampled($tmp, $this->src, 0, 0, 0, 0, $newwidth, $newheight, $this->width, $this->height);
        $filename = $path;

        imagejpeg($tmp, $filename, 100);
        imagedestroy($tmp);
    }

    function __destruct() {
        imagedestroy($src);
    }

}

?>
