<?php

namespace ClickON\PWA\ManifestSaver;

use Bitrix\Main\Error;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Result;


class FileManifestSaver implements IManifestSaver {

    /** @var string Путь к сохранению манифеста */
    private $pathToSave;

    public function __construct(string $pathToSave) {
        $this->pathToSave = $pathToSave;
    }

    public function save(array $manifest): Result {
        $result = new Result();
        if(strlen($this->pathToSave) === 0) {
            return $result->addError(new Error(Loc::getMessage("__FILE__")));
        }
        file_put_contents($this->pathToSave,json_encode($manifest));
        return $result;
    }
}
