<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
/**
 * Class MvBooksComponent
 *
 * @todo Тестовое задание
 */
class MvBooksComponent extends \CBitrixComponent
{
    /**
     * @param null $component
     *
     * @throws \Bitrix\Main\LoaderException
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->bxAjaxId            = \CAjax::GetComponentID($this->getName(), $this->getTemplateName(), $this->getName());
        $this->curPage             = $GLOBALS["APPLICATION"]->GetCurPage();
        $this->arResult["FORM_ID"] = "comp_" . $this->bxAjaxId;
        $this->request             = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
    }

    /**
     * @param $arParams
     *
     * @return mixed
     */
    public function onPrepareComponentParams($arParams)
    {
        if (strlen($arParams["IBLOCK_TYPE"]) <= 0)
        {
            $this->abortResultCache();
            ShowError(Loc::getMessage("MV_BOOKS_ERROR_IBLOCK_TYPE"));
            return;
        }
        if (intval($arParams["IBLOCK_ID"]) <= 0)
        {
            $this->abortResultCache();
            ShowError(Loc::getMessage("MV_BOOKS_ERROR_IBLOCK_ID"));
            return;
        }
        return $arParams;
    }

    /**
     * @param int $ID
     *
     * @return string
     */
    public function getDeletedLink($ID)
    {
        return "<a href='#' onclick=\"jsAjaxUtil.InsertDataToNode('".$this->curPage."?ID=".$ID."&action=deleted&bxajaxid=".$this->bxAjaxId."', 'comp_".$this->bxAjaxId."', true);return false;\">X</a>";
    }

    public function executeComponent()
    {
        if (!\Bitrix\Main\Loader::includeModule("iblock"))
        {
            $this->abortResultCache();
            ShowError(GetMessage("MV_BOOKS_IBLOCK_MODULE_NOT_INSTALLED"));
            return;
        }
        switch ($this->request->get("action"))
        {
            case "deleted":
                $GLOBALS["APPLICATION"]->RestartBuffer();
                $id = (int)$this->request->get("ID");
                if ($id > 0)
                {
                    (new CIBlockElement)->Update(
                        $id,
                        [
                            "ACTIVE" => "N"
                        ]
                    );
                }
                break;
            default:
                CJSCore::Init([
                    "jquery",
                    "ajax"
                ]);
                $GLOBALS["APPLICATION"]->AddHeadScript("/bitrix/js/main/ajax.js");
                break;
        }
        $this->arResult["COL"] = [
            "ID"   => "#",
            "NAME" => Loc::getMessage("MV_BOOKS_COL_NAME")
        ];
        $arSelect = [
            "ID",
            "IBLOCK_ID",
            "NAME"
        ];
        $bGetFields = count($this->arParams["FIELD_CODE"]) > 0;
        if ($bGetFields)
        {
            $arFieldsCode = CIBlockParameters::GetFieldCode(GetMessage("MV_BOOKS_IBLOCK_FIELDS"), "DATA_SOURCE")["VALUES"];
            $arSelect     = array_merge($arSelect, $this->arParams["FIELD_CODE"]);
        }
        $bGetProperty = count($this->arParams["PROPERTY_CODE"]) > 0;
        if ($bGetProperty)
        {
            $arSelect[] = "PROPERTY_*";
        }
        $rsElement = CIBlockElement::GetList(
            [],
            [
                "IBLOCK_ID"   => $this->arParams["IBLOCK_ID"],
                "IBLOCK_LID"  => SITE_ID,
                "ACTIVE"      => "Y"
            ],
            false,
            false,
            $arSelect
        );
        $header = false;
        $del    = $GLOBALS["APPLICATION"]->GetCurPage();
        while ($obElement = $rsElement->GetNextElement())
        {
            $arItem            = $obElement->GetFields();
            $arItem["DELETED"] = $this->getDeletedLink($arItem["ID"]);
            if ($bGetProperty)
            {
                $arItem["PROPERTIES"] = $obElement->GetProperties();
            }
            if (!$header)
            {
                if ($bGetFields)
                {
                    foreach($this->arParams["FIELD_CODE"] as $pid)
                    {
                        $prop = $arItem[$pid];
                        if (strlen($prop["VALUE"]) > 0 && isset($arFieldsCode[$pid]))
                        {
                            $this->arResult["COL"][$pid] = $arFieldsCode[$pid];
                        }
                        unset($pid, $prop);
                    }
                }
                if ($bGetProperty)
                {
                    foreach($this->arParams["PROPERTY_CODE"] as $pid)
                    {
                        $prop = &$arItem["PROPERTIES"][$pid];
                        if ((is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0) || (!is_array($prop["VALUE"]) && strlen($prop["VALUE"]) > 0))
                        {
                            $this->arResult["COL"][$prop["CODE"]] = $prop["NAME"];
                        }
                        unset($pid, $prop);
                    }
                }
                $header = true;
            }
            foreach($this->arParams["PROPERTY_CODE"] as $pid)
            {
                $prop = $arItem["PROPERTIES"][$pid];
                if ((is_array($prop["VALUE"]) && count($prop["VALUE"]) > 0) || (!is_array($prop["VALUE"]) && strlen($prop["VALUE"]) > 0))
                {
                    $arItem[$pid] = CIBlockFormatProperties::GetDisplayValue($arItem, $prop, "news_out")["VALUE"];
                }
                else
                {
                    $arItem[$pid] = false;
                }
                unset($pid, $prop);
            }
            $this->arResult["ITEMS"][] = $arItem;
        }
        $this->arResult["COL"]["DELETED"] = Loc::getMessage("MV_BOOKS_COL_DELETED");
        $this->includeComponentTemplate();
    }
}
?>