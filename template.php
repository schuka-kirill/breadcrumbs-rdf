<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string

__IncludeLang(dirname(__FILE__).'/lang/'.LANGUAGE_ID.'/'.basename(__FILE__));

$curPage = $GLOBALS['APPLICATION']->GetCurPage($get_index_page=false);

if ($curPage != SITE_DIR)
{
	if (empty($arResult) || (!empty($arResult[count($arResult)-1]['LINK']) && $curPage != urldecode($arResult[count($arResult)-1]['LINK'])))
		$arResult[] = array('TITLE' =>  htmlspecialcharsback($GLOBALS['APPLICATION']->GetTitle(false, true)), 'LINK' => $curPage);
}

if(empty($arResult))
	return "";

$strReturn = '<div  class="bread_crumbs"> <div xmlns:v="http://rdf.data-vocabulary.org/#"> <span typeof="v:Breadcrumb"><a title="'.GetMessage('BREADCRUMB_MAIN').'" href="'.SITE_DIR.'" rel="v:url" property="v:title">Главная</a></span>';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
    $strReturn .= ' → ';

    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if( ($arResult[$index]["LINK"] <> "") && ($index !== ($itemSize-1)))
        $strReturn .= '<span typeof="v:Breadcrumb"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" rel="v:url" property="v:title">'.$title.'</a></span>';

    else
        $strReturn .= '<span typeof="v:Breadcrumb">'.$title.'</span>';
}

$strReturn .= '</div></div>';

return $strReturn;
?>
