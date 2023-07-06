<?php

namespace lib;

/**
 * Cette classe permet de charger les classes automatiquement 
 * sans les appeler à chaque utilisation. Elle devrait être 
 * utilisée comme argument de la fonction spl_autoload_register
 * spl_autoload_register([$autoload, 'loadClass']);
 */
class Autoload
{
    private $file;

    public function setFile(string $file): void
    {
        $this->file = $file;
    }

    public function getFile()
    {
        return $this->file;
    }


    public function loadClass($className)
    {
        $this->setFile(dirname(__DIR__) . '/' . str_replace('\\', '/', $className) . '.class.php');

        if (file_exists($this->file)) {
            require_once $this->file;
        } else {
            echo $className . " not exist";
        }
    }
}
