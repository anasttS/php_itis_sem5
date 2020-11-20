<?php

class FileHandler
{
    private $file;

    public function __construct($filename)
    {
        $this->file = fopen($filename, 'a');
    }

    public function writeString($string)
    {
        fwrite($this->file, $string);
    }

    function __destruct()
    {
        fclose($this->file);
    }
}