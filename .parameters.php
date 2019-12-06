<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
if (!\Bitrix\Main\Loader::includeModule("iblock"))
{
    return;
}
$arIBlocks = [];
$resIblock = \Bitrix\Iblock\IblockTable::getList([
    "filter" => [
        "LID"            => $_REQUEST["src_site"],
        "IBLOCK_TYPE_ID" => ($arCurrentValues["IBLOCK_TYPE"] != "-" ? $arCurrentValues["IBLOCK_TYPE"] : "")
    ],
    "order" => [
        "SORT" => "ASC"
    ]
]);
while ($iblock = $resIblock->fetch())
{
    $arIBlocks[$iblock["ID"]] = "[".$iblock["ID"]."] ".$iblock["NAME"];
}
$arProperty  = [];
$resProperty = \Bitrix\Iblock\PropertyTable::getList([
    "filter" => [
        "ACTIVE"    => "Y",
        "IBLOCK_ID" => (isset($arCurrentValues["IBLOCK_ID"]) ? $arCurrentValues["IBLOCK_ID"] : $arCurrentValues["ID"])
    ],
    "order" => [
        "sort" => "asc",
        "name" => "asc"
    ]
]);
while ($arr = $resProperty->fetch())
{
    $arProperty[$arr["CODE"]] = "[".$arr["CODE"]."] ".$arr["NAME"];
}
$arComponentParameters = [
    "GROUPS" => [],
    "PARAMETERS" => [
        "IBLOCK_TYPE" => [
            "PARENT"  => "BASE",
            "NAME"    => GetMessage("MV_BOOKS_IBLOCK_TYPE"),
            "TYPE"    => "LIST",
            "VALUES"  => CIBlockParameters::GetIBlockTypes(array("-" => " ")),
            "DEFAULT" => "",
            "REFRESH" => "Y",
        ],
        "IBLOCK_ID" => [
            "PARENT"            => "BASE",
            "NAME"              => GetMessage("MV_BOOKS_IBLOCK_ID"),
            "TYPE"              => "LIST",
            "VALUES"            => $arIBlocks,
            "DEFAULT"           => "={$_REQUEST["ID"]}",
            "ADDITIONAL_VALUES" => "Y"
        ],
        "FIELD_CODE" => CIBlockParameters::GetFieldCode(
            GetMessage("MV_BOOKS_IBLOCK_FIELD"),
            "DATA_SOURCE"
        ),
        "PROPERTY_CODE" => [
            "PARENT"            => "DATA_SOURCE",
            "NAME"              => GetMessage("MV_BOOKS_IBLOCK_PROP"),
            "TYPE"              => "LIST",
            "MULTIPLE"          => "Y",
            "VALUES"            => $arProperty,
            "ADDITIONAL_VALUES" => "Y",
        ],
    ]
];
?>