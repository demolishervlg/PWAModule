<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;
Loc::loadMessages(__FILE__);

Loader::includeModule('clickon.pwa');
use \ClickON\PWA\FileManifestSaver;

CJSCore::Init(['clickon.manifestgenerator']);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialcharsbx($request["mid"] != "" ? $request["mid"] : $request["id"]);

Loader::includeModule($module_id);

$aTabs = array(
    array(
        "DIV"       => "edit",
        "TAB"       => Loc::getMessage("CLICKON_PWA_OPTIONS_TAB_NAME"),
        "TITLE"   => Loc::getMessage("CLICKON_PWA_OPTIONS_TAB_NAME"),
        "OPTIONS" => array(
            Loc::getMessage("CLICKON_PWA_OPTIONS_TAB_COMMON"),
            array(
                "switch_on",
                Loc::getMessage("CLICKON_PWA_OPTIONS_TAB_SWITCH_ON"),
                "N",
                array("checkbox")
            ),
            array(
                "display",
                Loc::getMessage("CLICKON_PWA_DISPLAY_OPTIONS"),
                "browser",
                array("selectbox", array(
                    "browser"   => Loc::getMessage("CLICKON_PWA_DISPLAY_BROWSER_OPTIONS"),
                    "standalone"   => Loc::getMessage("CLICKON_PWA_DISPLAY_STANDALONE_OPTIONS"),
                    "minimal-ui" => Loc::getMessage("CLICKON_PWA_DISPLAY_MINIMAL_UI_OPTIONS"),
                    "fullscreen"   => Loc::getMessage("CLICKON_PWA_DISPLAY_FULLSCREEN_OPTIONS")
                ))
            ),
            array(
                "name",
                Loc::getMessage("CLICKON_PWA_NAME_OPTIONS"),
                "",
                array("text", 10)
            ),
            array(
                "description",
                Loc::getMessage("CLICKON_PWA_DESCRIPTION_OPTIONS"),
                "",
                array("text", 60)
            ),
            array(
                "application_scope",
                Loc::getMessage("CLICKON_PWA_APPLICATION_SCOPE_OPTIONS"),
                "/",
                array("text", 5)
            ),
            array(
                "start_URL",
                Loc::getMessage("CLICKON_PWA_START_URL_OPTIONS"),
                "/",
                array("text", 5)
            ),
            array(
                "theme_color",
                Loc::getMessage("CLICKON_PWA_THEME_COLOR_OPTIONS"),
                "#ff0000",
                array("text", 5)
            ),
            array(
                "background_color",
                Loc::getMessage("CLICKON_PWA_BACKGROUND_COLOR_OPTIONS"),
                "#ff0000",
                array("text", 5)
            ),
            array(
                "icon",
                Loc::getMessage("CLICKON_PWA_ICON_OPTIONS"),
                "/",
                array("text", 45)
            ),
        )
    )
);

if($request->isPost() && check_bitrix_sessid()){

    foreach($aTabs as $aTab){

        foreach($aTab["OPTIONS"] as $arOption){

            if(!is_array($arOption)){

                continue;
            }

            if($arOption["note"]){

                continue;
            }

            if($request["apply"]){

                $optionValue = $request->getPost($arOption[0]);

                if($arOption[0] == "switch_on"){

                    if($optionValue == ""){

                        $optionValue = "N";
                    }
                }

                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(",", $optionValue) : $optionValue);
            }elseif($request["default"]){

                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }

    LocalRedirect($APPLICATION->GetCurPage()."?mid=".$module_id."&lang=".LANG);
}

$tabControl = new CAdminTabControl(
    "tabControl",
    $aTabs
);

$tabControl->Begin();
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>?mid=<? echo($module_id); ?>&lang=<? echo(LANG); ?>" method="post">

    <?
    foreach($aTabs as $aTab){

        if($aTab["OPTIONS"]){

            $tabControl->BeginNextTab();

            __AdmSettingsDrawList($module_id, $aTab["OPTIONS"]);
        }
    }

    $tabControl->Buttons();
    ?>

    <input type="submit" name="apply" value="<? echo(Loc::GetMessage("CLICKON_PWA_OPTIONS_INPUT_APPLY")); ?>" class="adm-btn-save" />
    <input type="submit" name="default" value="<? echo(Loc::GetMessage("CLICKON_PWA_OPTIONS_INPUT_DEFAULT")); ?>" />
    <input type="submit" onclick="startGenerate();" name="default" value="<? echo(Loc::GetMessage("CLICKON_PWA_OPTIONS_INPUT_GENERATE")); ?>" />

    <?
    echo(bitrix_sessid_post());
    ?>

</form>

<?$tabControl->End();?>

