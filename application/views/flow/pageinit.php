<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Current .....
$controller = $this->router->fetch_class();
$action = $this->router->fetch_method();

// View
ob_start();
include APPPATH.'views/page/'.$view.'.php';
$contentOutput = ob_get_clean();

$layoutParent = isset($layoutParent) ? $layoutParent : 'default';
$pageTitle = !isset($title) ? '' : $title.' - ';
$boxColWidth = !isset($boxColWidth) ? 'col col-md-8 col-lg-7 col-xl-6 col-xxl-5' : $boxColWidth;

// Link Tag for css (in head)
$linkSourceTags = "\r\n";
if(isset($linkSources) && is_array($linkSources)) {
	foreach ($linkSources as $item) {
		if(!is_array($item)) {
			$itemArr = explode('?', $item);
			$ext = pathinfo($itemArr[0], PATHINFO_EXTENSION);
			if(strtolower($ext) == 'css') {
				$rel = 'rel="stylesheet"';
			}
			else {
				$rel = '';
			}	
			$linkSourceTags .= "	<link $rel href=\"$item\" /> \n";
		}
		else {
			$linkSourceTag = '';
			foreach($item as $keyTag => $valTag) {
				$linkSourceTag .= $keyTag.'="'.$valTag.'" ';
			}
			$linkSourceTags .= "	<link $linkSourceTag /> \n";
		}
	}
}


// Script tag for script (in body)
$scriptSourceTags = "\r\n";
if(isset($scriptSources) && is_array($scriptSources)) {
	foreach ($scriptSources as $item) {
		if(!is_array($item)) {
			$scriptSourceTags .= "	<script src=\"$item\"></script> \n";
		}
		else {
			$scriptSourceTag = '';
			foreach($item as $keyTag => $valTag) {
				$scriptSourceTag .= $keyTag.'="'.$valTag.'" ';
			}
			$scriptSourceTags .= "	<link $scriptSourceTag /> \n";
		}
	}
}
