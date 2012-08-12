<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * 使 CI 支持 Smarty 第三方樣版引擎.
 */
class Template {

	public function __construct() {}

	/**
	 * 同等 $smarty->fetch();
	 * 
	 * @param  string $template [description]
	 * @param  array  $data     [description]
	 * @return [type]           [description]
	 */
	public function fetch( $template = '', $data = array() ) {
		$smarty = $this->_create_smarty_lib();

		// 一個一個 將data 變量 assign 至 smarty 樣版裡.
		foreach ( array_keys( $data ) as $index => $key_name ) {
			$smarty->assign( $key_name, $data[$key_name] );
		}

		$smarty->assign( 'CI', $CI =& get_instance() );

		return $smarty->fetch( $template . '.html' );
	}

	/**
	 * 同等 $smarty->display();
	 * 
	 * @param  string $template [description]
	 * @param  array  $params   [description]
	 * @return [type]           [description]
	 */
	public function display( $template = '', $params = array() ) {
		// 初始化 smarty
		$smarty = $this->_create_smarty_lib();
		// 基本配置
		$smarty->assign( 'TEMPLATE', $params );
		$smarty->assign( 'CI', $CI =& get_instance() );

		// 從控制器 assign 進來的變數, 也要一個一個 assign 至 smarty 樣版裡.
		foreach ( array_keys( $params['data'] ) as $index => $key_name ) {
			$smarty->assign( $key_name, $params['data'][$key_name] );
		}

		// 輸出視圖
		$static_template = $smarty->fetch( $template . '.html' );
		$CI->output->set_output( $static_template );

		return $this;
	}

	/**
	 * 實例化 Smarty
	 * 
	 * @return [type] [description]
	 */
	private function _create_smarty_lib() {
		require_once APPPATH . 'third_party/Smarty-3.1.11/libs/Smarty.class.php';

		$smarty = new Smarty();
		$smarty->left_delimiter  = '{';
		$smarty->right_delimiter = '}';
		$smarty->compile_dir     = APPPATH . 'cache/smarty_compile_dir';
		$smarty->cache_dir       = APPPATH . 'cache/smarty_cache_dir';
		$smarty->template_dir    = APPPATH . 'views';
		$smarty->caching         = FALSE;

		if ( ! file_exists( $smarty->compile_dir ) ) {
			mkdir( $smarty->compile_dir, 0777, true );
		}
		if ( ! file_exists( $smarty->cache_dir ) ) {
			mkdir( $smarty->cache_dir, 0777, true );
		}

		return $smarty;
	}
}

//
