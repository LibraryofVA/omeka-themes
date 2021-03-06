<?php 
/**
 * Use this file to define customized helper functions, filters or 'hacks'
 * defined specifically for use in your Omeka theme. Ideally, you should
 * namespace these with your theme name to avoid conflicts with functions
 * in Omeka and any plugins.
 */

/*
NOTE: you must first create a theme setting called 'Collection Order' that collects a simple comma-separated list of collection IDs (e.g. "2,1,3,5,4")
If you don't want to do that, you can just remove get_theme_option('Collection Order') and set $commaSeparatedList manually below 
*/

function collection_order_array() {
    $commaSeparatedList = get_theme_option('Collection Order');
    
    if ($commaSeparatedList == NULL) {
    	$collections = get_collections();
    	$num_collections = count($collections);
    	$commaSeparatedList = '';
	    
    	for ($i=0; $i < $num_collections; $i++) { 
    		$commaSeparatedList .= $collections[$i]->id;
    		$commaSeparatedList .= ',';
    	}

    	$commaSeparatedList = rtrim($commaSeparatedList, ",");    	
    } 

    $arrayList=explode(",",$commaSeparatedList);
    return $arrayList;
}

?>