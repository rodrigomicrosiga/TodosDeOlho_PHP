<?php 
function U_PageQry($cFields,$cFrom,$cWhere,$cOrder,$nPageNum,$nPageSize)
{
	$nOffset = (($nPageNum-1) * $nPageSize);

	$cQuery = "Select " . $cFields;
	$cQuery = $cQuery . " from " . $cFrom ;
	$cQuery = $cQuery . " where " . $cWhere ;
	$cQuery = $cQuery . " order by " . $cOrder;
	$cQuery = $cQuery . " limit " . $nOffset . ',' . $nPageSize;

	return $cQuery;
}

?>

