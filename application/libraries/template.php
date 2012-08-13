<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * 使 CI 支持 Smarty 第三方樣版引擎.
 * 用來取代內建 parser lib.
 */
require_once APPPATH . 'third_party/Smarty-3.1.11/libs/Smarty.class.php';

class Template extends Smarty {

	private $CI;
	
	public function __construct() {

		parent::__construct();

		$this->CI              =& get_instance();
		$this->left_delimiter  = '{';
		$this->right_delimiter = '}';
		$this->compile_dir     = APPPATH . 'cache/smarty_compile_dir';
		$this->cache_dir       = APPPATH . 'cache/smarty_cache_dir';
		$this->template_dir    = APPPATH . 'views';
		$this->caching         = false;

		if ( ! file_exists( $this->compile_dir ) ) {
			mkdir( $this->compile_dir, 0777, true );
		}
		if ( ! file_exists( $this->cache_dir ) ) {
			mkdir( $this->cache_dir, 0777, true );
		}
	}

	/**
	 * 透過 smarty lib 來取代 parser lib 的接口.
	 * 
	 * @param  string $template [description]
	 * @param  array  $params   [description]
	 * @return [type]           [description]
	 */
	public function parse( $template = '', $params = array(), $return = false ) {

		// 從控制器 assign 進來的變數, 也要一個一個 assign 至 smarty 樣版裡.
		foreach ( array_keys( $params ) as $index => $key_name ) {
			$this->assign( $key_name, $params[$key_name] );
		}

		// 輸出視圖
		$template_string = $this->fetch( $template . '.html' );

		if ( $return === false ) {
			$this->CI->output->set_output( $template_string );
		}
		else {
			return $template_string;
		}

		return $this;
	}
}

//