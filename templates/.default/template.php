<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
    die();
}
$this->setFrameMode(true);
if ($arResult["ITEMS"]) : ?>
    <form method="POST" id="<?=$arResult["FORM_ID"];?>">
        <?=bitrix_sessid_post();?>
        <table width="100%" class="table">
            <thead>
                <tr>
                    <? foreach ($arResult["COL"] as $colKey => $colValue) : ?>
                        <th><?=$colValue;?></th>
                    <? endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <? foreach ($arResult["ITEMS"] as $itemKey => $itemAr) : ?>
                    <tr>
                        <? foreach ($itemAr as $rowKey => $rowValue) :
                            if (!isset($arResult["COL"][$rowKey]))
                            {
                                continue;
                            }
                            ?>
                            <td>
                                <? if (is_array($rowValue)) : ?>
                                    <?=explode(', ', $rowValue); ?>
                                <? else : ?>
                                    <?=$rowValue;?>
                                <? endif;?>
                            </td>
                        <? endforeach; ?>
                    </tr>
                <? endforeach; ?>
            </tbody>
        </table>
    </form>
<? endif; ?>