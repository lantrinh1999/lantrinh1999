<?php 
/**
 * summary
 */
class LHelper 
{

	public function __construct()
	{

	}

	public function createLog($fileLogName = 'listfiles.log', $dir = './'){
		$a = fopen($dir . $fileLogName, "w");
		return $a;
	}

	public function existFileLog($fileLogName = 'listfiles.log', $dir = './'){
		if(file_exists($dir . $fileLogName)){
			return true;
		} else {
			return false;
		}
	}

	public function getLogContents($fileLogName = 'listfiles.log', $dir = './')
	{
		return trim(trim(file_get_contents($dir . $fileLogName), '|'));
	}

	public function getLogData($fileLogName = 'listfiles.log', $dir = './'){
		$data = [];
		if ($this->existFileLog($fileLogName, $dir)) {
			$contents = $this->getLogContents($fileLogName, $dir);
			$data = explode('|', $contents);
		} else {
			$this->createLog($fileLogName, $dir);
		}
		return $data;
	}

	public function writeLog($data = [], $fileLogName = 'listfiles.log', $dir = './') {
		if (count($data) > 0) {
			$contents = $this->getLogContents($fileLogName, $dir);
			$text = implode("|",$data);
			$contents = $contents . '|' . trim(trim($text, '|'));
			$myfile = $this->createLog($fileLogName, $dir);
			fwrite($myfile, $contents);
			fclose($myfile);
			return true;
		} else {
			return false;
		}
	}

	public function existFile($dir, $start, $ext){
		return count(glob($dir . $start . '.' . $ext)) > 0 ? true : false;
	}

	public function changeExt($item)
	{
		if (strlen($item) > 5 && preg_match( '/.+\.webp/i',$item)) {
			$item_new = str_replace('/home/ytuvann80nv/public_html', '..', $item);
			$im = imagecreatefromwebp($item_new);
			$new_file = trim($item_new, '.webp') . '.jpg';
			if ($im) {
				$result = imagejpeg($im, $new_file , 100);
				$done = $helper->writeLog([$item]);
				// echo '<br>';
				// echo 'DONE => ' . $item;
			} else {
				$result = copy($item, trim($item, '.webp') . '.jpg');
				if ($result) {
					$done = $helper->writeLog([$item]);
					// echo '<br>';
					// echo 'DONE => '. $item;
				} else {
					// echo 'FAILED => '. $item;
				}
			}
		} else {
			var_dump('Đã tồn tại file');
		}
	}

	public     function curl($url){
		// require_once ( './simple_html_dom.php' );
		$user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

		$options = array(

            CURLOPT_CUSTOMREQUEST => "GET",        //set request type post or get
            CURLOPT_POST => false,        //set to GET
            CURLOPT_USERAGENT => $user_agent, //set user agent
            CURLOPT_COOKIEFILE => "cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR => "cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING => "",       // handle all encodings
            CURLOPT_AUTOREFERER => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT => 120,      // timeout on response
            CURLOPT_MAXREDIRS => 10,       // stop after 10 redirects
        );

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$header = curl_getinfo($ch);
		curl_close($ch);

		$header['errno'] = $err;
		$header['errmsg'] = $errmsg;
		$header['content'] = $content;
		return $header['content'];
	}
	public function get_dom_2($url, $param){
		
		$user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

		$options = array(

            CURLOPT_CUSTOMREQUEST => "POST",        //set request type post or get
            CURLOPT_POST => true,        //set to GET
            CURLOPT_USERAGENT => $user_agent, //set user agent
            CURLOPT_COOKIEFILE => "cookie.txt", //set cookie file
            CURLOPT_COOKIEJAR => "cookie.txt", //set cookie jar
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING => "",       // handle all encodings
            CURLOPT_AUTOREFERER => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT => 120,      // timeout on response
            CURLOPT_MAXREDIRS => 10,       // stop after 10 redirects
        );

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		curl_setopt($ch, CURLOPT_POST, count($param));

// Thiết lập các dữ liệu gửi đi
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param); 
		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$header = curl_getinfo($ch);
		curl_close($ch);

		$header['errno'] = $err;
		$header['errmsg'] = $errmsg;
		$header['content'] = $content;
		return $header['content'];





	}



}
?>
