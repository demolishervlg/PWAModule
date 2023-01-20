<?php

namespace Clickon\Pwa;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

class Main {
    public function appendScriptsToPage(){

            $module_id = pathinfo(dirname(__DIR__))["basename"];
            if(Option::get($module_id, "switch_on", "N") == "Y"){
                Asset::getInstance()->addString('<link rel="manifest" href="manifest.json">');
                Asset::getInstance()->addString('<script type="module" src="/clickon.pwa/pwabuilder-sw-register.js"></script>');
            }
        return false;
    }
}
