<?php
/**
 * Created by PhpStorm.
 * User: Toole
 * Date: 30.03.2019
 * Time: 9:34
 */

namespace app\models;


class ScanDir
{
    private $root_path;
    private $array_files;

    public function scan()
    {
        $this->root_path = $_SERVER['DOCUMENT_ROOT'];
        $this->array_files = scandir($this->root_path);
        $array_all = [];

        for ($i = 0; $i < count($this->array_files); $i++) {
            $array_all[$i] = [
                'filename' => pathinfo($this->root_path . "/" . $this->array_files[$i])['filename'],
                'filesize' => (string)((filetype($this->root_path . "/" . $this->array_files[$i]) == "dir") ? "dir" : filesize($this->root_path . "/" . $this->array_files[$i])),
                'filetype' => (filetype($this->root_path . "/" . $this->array_files[$i]) != "dir") ? pathinfo($this->root_path . "/" . $this->array_files[$i])['extension'] : "",
                'filetime' => date('Y.m.d H:i:s', filemtime($this->root_path . "/" . $this->array_files[$i]))
            ];
        }

        return $array_all;
    }
}