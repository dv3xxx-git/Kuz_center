<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<div class="press-center__articles press-center__articles--wide-list" data-target="view-more.container">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
<?$i=0?>  <!-- индекс важной новости -->
<?foreach($arResult["ITEMS"] as $arItem):?>
<?if ($i > 0):?>

    <article class="news news--wide">
        <div class="news__publication-info">
<?else:?>
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                <article class="news-important" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);">
            <?else:?>
            <?endif;?>
        <?endif?>
        <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="news-important__link">
        	<h2 class="news-important__title">
<?endif;?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<?if ($i > 0):?>
    <a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="news__link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <h3 class="news__title content-block">
        	<?endif;?>
            <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                    <?if ($i > 0):?>
                    <mark>
                    <?endif;?>
                    	<?echo $arItem["NAME"]?>
                    <?if ($i > 0):?>
                    </mark>
                    <?endif;?>
                <?else:?>
                    <?echo $arItem["NAME"]?>
                <?endif;?>
            <?endif;?>
            <?if ($i == 0):?>
            </h2>
      </a>
      		<?endif;?>
            <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
            <?if ($i > 0):?>
                <span>
			<?echo $arItem["PREVIEW_TEXT"];?>
            </span>
            <?endif;?>
            <?endif;?>
        </h3>
    </a>

		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>

		<?if ($i > 0):?>
            <time class="news__publication-date" datetime="2019-10-24">
                <?=strtolower(FormatDate("d F Y", MakeTimeStamp($arItem["DATE_CREATE"]))) ?>
            </time>
        
		</div>
		
        <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
            <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>

                <div class="news__illustration" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);"></div>
            <?else:?>
            <?endif;?>
        <?endif?>
        <?endif;?>
        <?if ($i == 0):?>
        <time class="news-important__publication-date" datetime="2019-10-24">
        	<?=strtolower(FormatDate("d F Y", MakeTimeStamp($arItem["DATE_CREATE"]))) ?>
        </time>
        <?endif;?>


        
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>

		<?endif?>

		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>

		<?endforeach;?>
    </article>
    <?$i++?>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?>
<?endif;?>

</div>