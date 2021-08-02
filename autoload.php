<?php

require_once ("config/settings.php");
require_once (CONTROLLER_PATH."controller.php");


// Array für die geladenen Klassen erstellen
$arrayFilesToLoad['file'] = array();
$arrayFilesToLoad['path'] = array();

// Unterordner mit einbeziehen (CLASSES_PATH in settings.php)
$fileinfos = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator(CLASSES_PATH)
);

// Ordner (Klassen) durchgehen
foreach($fileinfos as $pathname => $fileinfo) {
    if (!$fileinfo->isFile()) continue;

    // Files (Klassen) in ein Array speichern
    array_push($arrayFilesToLoad['file'], $fileinfo->getFileName());
    array_push($arrayFilesToLoad['path'], $pathname);

    // Klasse einbinden (File)
    require_once $pathname;
}


?>