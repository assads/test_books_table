# test_books_table
компонент, выводящий из инфоблока данные позволяющий удалять их через ajax<br><br>

&lt;? $APPLICATION->IncludeComponent(<br>
&emsp;"mv:books",<br>
&emsp;".default",<br>
&emsp;array(<br>
&emsp;&emsp;"IBLOCK_TYPE" => "news",<br>
&emsp;&emsp;"IBLOCK_ID" => "1",<br>
&emsp;&emsp;"COMPONENT_TEMPLATE" => ".default",<br>
&emsp;&emsp;"FIELD_CODE" => array(<br>
&emsp;&emsp;&emsp;0 => "NAME",<br>
&emsp;&emsp;&emsp;1 => "SHOW_COUNTER_START",<br>
&emsp;&emsp;&emsp;2 => "DATE_CREATE",<br>
&emsp;&emsp;&emsp;3 => "TIMESTAMP_X",<br>
&emsp;&emsp;&emsp;4 => "",<br>
&emsp;&emsp;),<br>
&emsp;&emsp;"PROPERTY_CODE" => array(<br>
&emsp;&emsp;&emsp;0 => "PICS_NEWS",<br>
&emsp;&emsp;&emsp;1 => "",<br>
&emsp;&emsp;)<br>
&emsp;),<br>
&emsp;false<br>
); ?&gt;<br>
