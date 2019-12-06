# test_books_table
компонент, выводящий из инфоблока данные позволяющий удалять их через ajax<br><br>

&lt;? $APPLICATION->IncludeComponent(
&emsp;"mv:books",
&emsp;".default",
&emsp;array(
&emsp;&emsp;"IBLOCK_TYPE" => "news",
&emsp;&emsp;"IBLOCK_ID" => "1",
&emsp;&emsp;"COMPONENT_TEMPLATE" => ".default",
&emsp;&emsp;"FIELD_CODE" => array(
&emsp;&emsp;&emsp;0 => "NAME",
&emsp;&emsp;&emsp;1 => "SHOW_COUNTER_START",
&emsp;&emsp;&emsp;2 => "DATE_CREATE",
&emsp;&emsp;&emsp;3 => "TIMESTAMP_X",
&emsp;&emsp;&emsp;4 => "",
&emsp;&emsp;),
&emsp;&emsp;"PROPERTY_CODE" => array(
&emsp;&emsp;&emsp;0 => "PICS_NEWS",
&emsp;&emsp;&emsp;1 => "",
&emsp;&emsp;)
&emsp;),
&emsp;false
); ?&gt;
