<?php

namespace ClickON\PWA\ManifestSaver;

use Bitrix\Main\Result;

interface IManifestSaver {
    public function save(array $manifest): Result;
}