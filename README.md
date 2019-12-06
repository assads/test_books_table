# test_books_table
компонент, выводящий из инфоблока данные позволяющий удалять их через ajax<br><br>

<? $APPLICATION->IncludeComponent(
    "mv:books",
    ".default",
    array(
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "1",
        "COMPONENT_TEMPLATE" => ".default",
        "FIELD_CODE" => array(
            0 => "NAME",
            1 => "SHOW_COUNTER_START",
            2 => "DATE_CREATE",
            3 => "TIMESTAMP_X",
            4 => "",
        ),
        "PROPERTY_CODE" => array(
            0 => "PICS_NEWS",
            1 => "",
        )
    ),
    false
); ?>
