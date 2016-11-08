<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";
$count=count($arResult);
$strReturn = '<ul class="scrumbs">';

for($index = 0, $itemSize = count($arResult); $index < $itemSize; $index++)
{
	if($index > 0)
		$strReturn .= '<li><span>&nbsp;/&nbsp;</span></li>';

	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
    if($index==$count-1)
    {$strReturn .= '<li><span>'.$title.'</span></li>';}
    else{
        if($arResult[$index]["LINK"] <> "")
            $strReturn .= '<li><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'">'.$title.'</a></li>';
        else
            $strReturn .= '<li><span>'.$title.'</span></li>';
    }}

$strReturn .= '</ul>';
return $strReturn;
?>
