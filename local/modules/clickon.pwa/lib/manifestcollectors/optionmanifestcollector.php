<?php

namespace ClickON\PWA\ManifestCollectors;

use Bitrix\Main\Config\Option;

class OptionManifestCollector implements IManifestCollector {
    public function collect(): array {
        $module_id = "clickon.pwa";
        Option::get($module_id, "icon", "normal");

        $arrManifest = array(
            "theme_color" => Option::get($module_id, "theme_color", "10"),
            "background_color" => Option::get($module_id, "background_color", "10"),
            "display" => Option::get($module_id, "display", "browser"),
            "scope" => Option::get($module_id, "application_scope", "#bf3030"),
            "start_url" => Option::get($module_id, "start_URL", "left"),
            "description" => Option::get($module_id, "description", "50"),
            "short_name" => Option::get($module_id, "name", "50"),
            "name" => Option::get($module_id, "name", "50"),
            "icons" => array(
                array(
                    "src" => Option::get($module_id, "icon", "normal"),
                    "sizes" => "512x512",
                    "type" => "image/png"
                )
            )
        );

        return $arrManifest;
    }
}
?>