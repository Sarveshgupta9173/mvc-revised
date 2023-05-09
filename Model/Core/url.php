<?php 

class Model_Core_url{
	
	public function getCurrentUrl(){
		$url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		return $url;
	}

	public function getUrl($action = null ,$controller = null ,$params = null,$resetParams = false){
		$gcu = $this->getCurrentUrl();
		$qs = $_SERVER['QUERY_STRING'];
		$base = str_replace($qs, "", $gcu);
		parse_str($qs,$new);

		if($action == null && $controller == null && $params == null){
			$newurl = $this->getCurrentUrl();
		}

		if($action){
			$new["a"] = $action;
			$r = http_build_query($new);
			$newurl = $base.$r;
		}

		if($controller){
			$new["c"] = $controller ;
			$r = http_build_query($new);
			$newurl = $base.$r;

		}

		if($params){
			$s = http_build_query($params);
			$r = http_build_query($new);
			$newurl = $base.$r."&".$s;
		}

		if($resetParams == true){
			$params =array_merge($params);
			$newurl = $base.$r."&".$s;
		}

		return $newurl;	

	}
	



}

?>