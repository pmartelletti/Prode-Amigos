<?php 

define('FACEBOOK_APP_ID', '124703570930710');
define('FACEBOOK_SECRET', '65bbcab7735438387d9e6ad80410cb93');

class FacebookRequest {	
	
	private $response;
	
	public function FacebookRequest(){
		
		$this->response = $this->parse_signed_request($_REQUEST['signed_request'], 
                                   FACEBOOK_SECRET);
		
	}
	
	private function parse_signed_request($signed_request, $secret) {
		  list($encoded_sig, $payload) = explode('.', $signed_request, 2); 
		
		  // decode the data
		  $sig = $this->base64_url_decode($encoded_sig);
		  $data = json_decode($this->base64_url_decode($payload), true);
		
		  if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
		    error_log('Unknown algorithm. Expected HMAC-SHA256');
		    return null;
		  }
		
		  // check sig
		  $expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
		  if ($sig !== $expected_sig) {
		    error_log('Bad Signed JSON signature!');
		    return null;
		  }
		
		  return $data;
	}
	
	private function base64_url_decode($input) {
	    return base64_decode(strtr($input, '-_', '+/'));
	}
	
	/**
	 * Decide si la registración se realizó a través de facebook, o si es una nueva
	 * @return: bool
	 */
	public function facebookRegister(){
		
		return ( isset($this->response['user_id']) );
		
	}
	
	
	public function getRequestData(){	
		
        return $this->response;
	}
	
	
	
	
	
}

?>