<?php

/**
 * The base class for shopServerApi.
 */
class shopServerApi {
	/* @var modX $modx */
	public $modx;


	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()) {
		$this->modx =& $modx;

		$corePath = $this->modx->getOption('shopserverapi_core_path', $config, $this->modx->getOption('core_path') . 'components/shopserverapi/');
		$assetsUrl = $this->modx->getOption('shopserverapi_assets_url', $config, $this->modx->getOption('assets_url') . 'components/shopserverapi/');

		$connectorUrl = $assetsUrl . 'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $connectorUrl,

			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);

		$this->modx->addPackage('shopserverapi', $this->config['modelPath']);
		$this->modx->lexicon->load('shopserverapi:default');
	}

	function curl_post($post = null, array $options = array()) {
		$url = $this->modx->getOption('shopserverapi_url_server');
		$defaults = array(
							CURLOPT_POST => 1,
							CURLOPT_HEADER => 0,
							CURLOPT_URL => $url,
							CURLOPT_FRESH_CONNECT => 1,
							CURLOPT_RETURNTRANSFER => 1,
							CURLOPT_FORBID_REUSE => 1,
							CURLOPT_SSL_VERIFYHOST =>0,//unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
							CURLOPT_SSL_VERIFYPEER=>0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
							CURLOPT_POSTFIELDS => $post
						);
		$ch = curl_init();
		curl_setopt_array($ch, ($options + $defaults));
		if( ! $result = curl_exec($ch)){
			trigger_error(curl_error($ch));
		}
		curl_close($ch);
		return $result;
	}

	function GetProccess($name, $property){
		$processorProps = array(
		    'name' => $name,
		    'test' => $this->modx->getOption('shopserverapi_type_server'),
		    'property' => $property,
		);

		$otherProps = array(
		    'processors_path' => $this->config['processorsPath']
		);
		$response = $this->modx->runProcessor('mgr/api/params', $processorProps, $otherProps);
		$params = $response->response;
		$result = json_decode($this->curl_post($response->response));
		return $result;
		//return $params;
	}


	function authUser ($username, $password){
		$user = $this->modx->getObject('modUser', array('username' => $username));
		$userData = $this->GetProccess('get_user_data', array('phone' => $username));
		if(!$user){
			$user = $this->saveUser($username, $password);
			//return $user;
		}

		$user->set('password', $password);
		$user->save();

		$profile = $user->getOne('Profile');

		$profile->set('fullname', $userData->name);

		$profile->save();

			$response = $this->modx->runProcessor('/security/login', array(
				'username' => $username
				,'password' => $password
				,'rememberme' => 1
				,'login_context' => 'web'
				,'add_contexts' => 'web'
			));
			if ($response->isError()) {
			    $this->modx->log(modX::LOG_LEVEL_ERROR, 'login error. Username: '.$username.', Message: '.$response->getMessage());
			    $output['success'] = 'error';
			    $output['message'] = $response->getMessage();
			}else{
				$output['type'] = 'singin';
		 		$output['success'] = 'ok'. $user->get('id');
			}
		return $output;
		
	}

	function saveUser ($username, $password){

		$userProfile = array(
			'phone' => $username,
			'email' => $username.'@dostaevsky.ru'
		);

		$user = $this->modx->newObject('modUser', array('username' => $username, 'password' => $password ));
		$profile = $this->modx->newObject('modUserProfile', $userProfile);
		$user->addOne($profile);					
	
		if($user->save()){
			return $user;
		}
	}

	function newPasswordUser($username, $password){

	}

	public function test() {
		$params = array(
			'func' => 'get_actions',
			'test' => 1
		);
		$params = json_encode($params);
		return $this->curl_post($params);
	}

}