<?php
use Bitrix\Main\Loader;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!Loader::includeModule('clickon.pwa')){
    die();
}

$collector = new \ClickON\PWA\ManifestCollectors\OptionManifestCollector();
$saver = new ClickON\PWA\ManifestSaver\FileManifestSaver($_SERVER['DOCUMENT_ROOT'] . '/manifest.json');

$saver->save($collector->collect());
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

