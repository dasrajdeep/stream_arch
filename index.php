<?php
	
	session_start();
	
	define('SYSTEM_STARTED', TRUE);
	define('PRODUCTION', FALSE);
	
	require_once('core/bootstrap.php');
	
	$uriParams=getURIParameters();
	
	/**
	 * Handle static content separately.
	 */
	if(count($uriParams)>0) {
		$info=pathinfo($uriParams[count($uriParams)-1]);
		if(isset($info['extension'])) {
			$info['extension']=strtolower($info['extension']);
			if(in_array($info['extension'],array('js','css','jpg','jpeg','png','gif','bmp','svg','eot','ttf','woff','otf'))) require_once('core/static.php');
		}
	}
	
	/**
	 * Explicitly set command for default view.
	 */
	if(count($uriParams)==0) {
		$action='default';
	} else {
		$action=$uriParams[0];
		$uriParams=array_slice($uriParams,1);
	}
	
	/**
	 * Resolve URI request.
	 */
	resolve($action,$uriParams);

?>
