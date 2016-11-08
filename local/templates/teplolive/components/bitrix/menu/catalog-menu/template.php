<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?//echo "<pre>";print_r($arResult);echo "</pre>";?>
<?if (!empty($arResult)):?>
<div class='catalog-menu-wrapper'>
<div class='catalog-menu-bg'>
<div class='catalog-menu-inner-wrap'>
<p class='catalog-menu-title'>Каталог</p>
<ul class="catalog-menu">
<?
foreach($arResult as $arItem):
	if(/*$arParams["MAX_LEVEL"] == 1 && */$arItem["DEPTH_LEVEL"] <> 1)
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?endif?>
<?endforeach?>
</ul>

</div>
</div>
<div class='catalog-menu-footer'></div>
</div>

<div style="text-align:center; margin-bottom:40px;">
<!--  AdRiver code START. Type:200x200 Site: teplolive PZ: 0 BN: 0 -->

<script type="text/javascript">

var RndNum4NoCash = Math.round(Math.random() * 1000000000);

var ar_Tail='unknown'; if (document.referrer) ar_Tail = escape(document.referrer);

document.write(

'<iframe src="' + ('https:' == document.location.protocol ? 'https:' : 'http:') + '//ad.adriver.ru/cgi-bin/erle.cgi?'

+ 'sid=212425&target=top&bt=57&pz=0&rnd=' + RndNum4NoCash + '&tail256=' + ar_Tail

+ '" frameborder=0 vspace=0 hspace=0 width=200 height=200 marginwidth=0'

+ ' marginheight=0 scrolling=no></iframe>');

</script>

<noscript>

<a href="//ad.adriver.ru/cgi-bin/click.cgi?sid=212425&bt=57&pz=0&rnd=753426028" target=_top>

<img src="//ad.adriver.ru/cgi-bin/rle.cgi?sid=212425&bt=57&pz=0&rnd=753426028" alt="-AdRiver-" border=0 width=200 height=200></a>

</noscript>
</div>
<?endif?>