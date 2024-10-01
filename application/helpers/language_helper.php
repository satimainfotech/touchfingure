<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	function make_proper($text){
		$text = rawurldecode($text);
		return $text;
	}
	
	if ( ! function_exists('translate'))
	{
		function translate($word){
			$return = ucwords(str_replace('_', ' ', $word));
			return $return;
		}
	}
	
	function content_replace($content){
		$first_content = str_replace('[startphp]', '<?php', $content);
		$second_content = str_replace('[endphp]', '?>', $first_content);
		$final_content = str_replace('&gt;', '>', $second_content);
		return $final_content;
	}
	
	if ( ! function_exists('currency'))
	{
		function currency($val='',$def=''){
			$CI=& get_instance();
			$CI->load->database();
			$symbol = $CI->db->get_where('currency_settings', array('currency_settings_id' => '27'))->row()->symbol;
			if($val == ''){
				return $symbol;
			}
		}
	}