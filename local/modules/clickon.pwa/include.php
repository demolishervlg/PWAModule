<?php
$pathToModule = "/clickon.pwa";
CJSCore::RegisterExt('clickon.manifestgenerator', [
    'js' => [
        $pathToModule.'/generateScript.js'
    ],
]);

?>
