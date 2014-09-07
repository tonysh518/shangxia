<?php

class FuelTest {
  private $ci;
  private $server_url = "http://lily.local/admin/index.php/api";
  
  public function __construct() {
    //TODO::
  }
  
  /**
   * 发送数据到接口
   * @param type $api 接口地址， 如 shop/add
   * @param type $data 传递数据， 如 array("address" => "", "lat" => "")
   * @return type
   */
  public function post($api, $data) {
    // 初始化 请求对象
    $ci = $this->initRequest("POST", $api);
    
    // 设置请求数据
		curl_setopt($ci, CURLOPT_POSTFIELDS, $data);
    
    // 执行请求
		$response = curl_exec($ci);

		curl_close ($ci);
		return $response;
  }
  
  // TODO::
  public function get($api, $query) {
    
  }
  
  public function initRequest($method, $api) {
		$ci = curl_init();
		/* Curl settings */
		curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
		curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ci, CURLOPT_ENCODING, "");

		switch ($method) {
			case 'POST':
				curl_setopt($ci, CURLOPT_POST, TRUE);
				break;
			case 'DELETE':
				curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
		}
    
    $url = "{$this->server_url}/{$api}";
		curl_setopt($ci, CURLOPT_URL, $url );
		curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );
    
    $this->ci = $ci;
    
    return $ci;
  }
}

