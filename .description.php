<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
$arComponentDescription = array(
    "NAME"        => GetMessage("MV_BOOKS_NAME"),
    "DESCRIPTION" => GetMessage("MV_BOOKS_DESCRIPTION"),
    "ICON"        => "/images/mv_books.gif",
    "CACHE_PATH"  => "Y",
    "PATH"        => array(
        "ID"    => "content",
        "NAME"  => GetMessage("MV_BOOKS_NAME"),
        "CHILD" => array(
            "ID"   => "mv_books",
            "NAME" => GetMessage("MV_BOOKS_NAME"),
        )
    ),
);
?>