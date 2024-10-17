<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	function img_loading(){
		return base_url().'uploads/others/image_loading.gif';
	}
	function setnumberformetone($amount){
		return number_format(floor($amount*100)/100,1, '.', '');
	}
	function setnumberformet($amount){
		return number_format(floor($amount*100)/100,2, '.', '');
	}
	function setnumberformetthree($amount){
		return number_format(floor($amount*100)/100,3, '.', '');
	}
	function date_formate($date){
		$newdate = @explode("-",$date);
		$newdatey = $newdate[0];
		$newdatem = $newdate[1];
		$newdated = $newdate[2];
		$date_of_convert =  $newdated.'-'.$newdatem.'-'.$newdatey;
		return $date_of_convert;
	}

    function date_formate_database($date){
		$newdate = @explode("-",$date);
		$newdatey = $newdate[2];
		$newdatem = $newdate[1];
		$newdated = $newdate[0];
		$date_of_convert =  $newdatey.'-'.$newdatem.'-'.$newdated;
		return $date_of_convert;
	}
	
	function send_sms($mobile_number,$message,$template_id){
		//$url = "http://mobi1.blogdns.com/httpmsgid/SMSSenders.aspx?UserID=coalbharati&UserPass=India@@@123&Message=".$message."&MobileNo=".$mobile_number."&GSMID=COALBH";
		//$url = "http://login.blesssms.com/api/mt/SendSMS?user=demeanor11&password=Dstpl@12345&senderid=DEMEXI&channel=Trans&DCS=0&flashsms=0&number=".$mobile_number."&text=".$message."&route=10";
		$url = "https://onlysms.co.in/api/sms.aspx?UserID=vegtap&UserPass=vegtap@@@123&MobileNo=".$mobile_number."&GSMID=VEGTEP&PEID=1001705160000019283&Message=".$message."&TEMPID=".$template_id."&UNICODE=TEXT";
		
		$ch = curl_init(); 
		curl_setopt($ch,CURLOPT_URL,$url); 
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); 
		$result=curl_exec($ch);
		curl_close($ch);
		$data = json_decode($result, TRUE);
		return "1";
	}
	
	function check_sms(){
		$CI=& get_instance();
		$CI->load->database();
		return $social =  $CI->db->get_where('application_setting',array('application_setting_id'=>'2'))->row()->application_setting_value;
	}
	
/* PUSH NOTIFICATION */
	function sendPushNotification($to = '', $data = array()){
		$apikey = 'AAAAUd7DRIg:APA91bEUoTwNG4N_2ydGXrZ8pf8KpDkdtOwL3bA0hT1GGJNKw_usBrZeRs6r3uSfI-QogLWMkIgr6Ctk2zLRLmw-WxZQtvGY4MwGRwKHof07B26g0TBxA82BCMsS3tTu6gdU31pzGV-j';
		$fields = array('to'=>$to, 'data'=>$data);
		$headers = array('Authorization:key='.$apikey, 'Content-Type:application/json');
		$url = 'https://fcm.googleapis.com/fcm/send';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,true);
	}
	
	function PromotionsendPushNotification($data = array()){
		$apikey = 'AAAAUd7DRIg:APA91bEUoTwNG4N_2ydGXrZ8pf8KpDkdtOwL3bA0hT1GGJNKw_usBrZeRs6r3uSfI-QogLWMkIgr6Ctk2zLRLmw-WxZQtvGY4MwGRwKHof07B26g0TBxA82BCMsS3tTu6gdU31pzGV-j';
		$fields = array('to'=>'/topics/promotion', 'data'=>$data);
		$headers = array('Authorization:key='.$apikey, 'Content-Type:application/json');
		$ch = curl_init();
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
		$result = curl_exec($ch );
		curl_close( $ch );
	}
/* PUSH NOTIFICATION */
/* GET SOCIAL MEDIA */
	function get_social_media(){
		$CI = get_instance();
        $CI->db->select('*');
        $CI->db->from('social_media');
		$CI->db->where('status','yes');
		$res = $CI->db->get()->result_array();
		return $res;
	}
/* GET SOCIAL MEDIA */
/* DATE CONVERT */

	function get_orignal_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d M, Y h:i:s A', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_orignalss_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('Y-m-d H:i:s', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_orignalss_only_time($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('h:i a', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	function get_orignalss_live_only_time($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('h:i:s A', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	function get_indian_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('Y-m-d h:i:s A', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_orignal_app_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d M, Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_orignal_without_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d / m / Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	
	function get_orignal_edit_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d/m/Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_orignal_edit_ymd_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('Y-m-d', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_orignal_edit_app_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d-m-Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_utc_orignal_datetime($dates){
		date_default_timezone_set('UTC');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d M, Y h:i:s A', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_utc_orignal_app_datetime($dates){
		date_default_timezone_set('UTC');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d M, Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_utc_orignal_without_datetime($dates){
		date_default_timezone_set('UTC');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d / m / Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	
	function get_utc_orignal_edit_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d/m/Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	function get_utc_orignal_time_edit_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('H:i', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	function get_utc_orignal_edit_ymd_datetime($dates){
		date_default_timezone_set('UTC');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('Y-m-d', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	
	function get_utc_orignal_edit_app_datetime($dates){
		date_default_timezone_set('UTC');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('d-m-Y', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
	function get_utc_orignal_ymd_datetime($dates){
		date_default_timezone_set('Asia/Kolkata');
		if($dates != ''){
			$from_timess = $dates;
			$show_time = date('Y-m-d h:i:s', $from_timess); 
		}else{
			$show_time = ''; 
		}
		return $show_time;
	}
/* DATE CONVERT */
function get_all_country(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('country');
	$CI->db->where('country_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_state($country=''){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('state');
	if($country !='')
	{
		$CI->db->where('country_id',$country);
	}
	$CI->db->where('state_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_division($country='',$state=''){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('division');
	if($country !='')
	{
		$CI->db->where('country_id',$country);
	}
	if($state !='')
	{
		$CI->db->where('state_id',$state);
	}	
	$CI->db->where('division_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_district($country='',$state=''){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('district');
	if($country !='')
	{
		$CI->db->where('country_id',$country);
	}
	if($state !='')
	{
		$CI->db->where('state_id',$state);
	}	
	$CI->db->where('district_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_city($country,$state,$district){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('city');
	$CI->db->where('country_id',$country);
	$CI->db->where('state_id',$state);
	$CI->db->where('district_id',$district);
	$CI->db->where('city_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_city_data(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('city');
	$CI->db->where('city_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_taluka_data(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('taluka');
	$CI->db->where('taluka_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_taluka_m_data(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('taluka_m');
	$CI->db->where('taluka_m_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_our_range(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('our_range');
	$CI->db->where('our_range_status','Active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_all_area($country,$state,$city){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('area');
	$CI->db->where('area_status','Active');
	$CI->db->where('country_id',$country);
	$CI->db->where('state_id',$state);
	$CI->db->where('city_id',$city);
	$CI->db->order_by('area_id','desc');
	return $CI->db->get()->result_array();
}
function get_member_type($member_type_id = ''){
	$CI = get_instance();
	$CI->db->select('*');	
	$CI->db->from('member_type');
	if($member_type_id != '')
	{
		$CI->db->where('member_type_id',$member_type_id);
	}
	$CI->db->where('member_type_status','active');
	$CI->db->order_by('member_type_position','asc');
	return $CI->db->get()->result_array();
}
function imageResize($imageSrc,$imageWidth,$imageHeight) {
	$newImageWidth =200;
	$newImageHeight =200;
	$newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
	imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);
	return $newImageLayer;
}

function get_field_name($table_name,$field,$id){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from($table_name);
	$CI->db->where($table_name.'_id',$id);
	return $CI->db->get()->row()->$field;
}

function get_field_id_name($table_name,$field_id,$field,$id){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from($table_name);
	$CI->db->where($field_id,$id);
	$res = $CI->db->get()->result_array();
	if(!empty($res)){
	    return $res[0][$field];
	}else{
	    $return = '';
	    return $return;
	}
}

function get_field_array($table_name,$field_id,$field,$id){
	$CI = get_instance();
	$CI->db->select($field);
	$CI->db->from($table_name);
	$CI->db->where($field_id,$id);
	$res = $CI->db->get()->result_array();

	if (!empty($res)) {
	$output = [];
	foreach ($res as $row) {
	$output[] = $row[$field];
	}
	return array_unique($output);
	} else {
	return '';
	}
}

function get_category(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('category');
	$CI->db->where('category_status','Active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_search_sub_category($category){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('sub_category');
	$CI->db->where('category_id',$category);
	$CI->db->where('sub_category_status','Active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_sub_category($category){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('sub_category');
	$CI->db->where('category_id',$category);
	$CI->db->where('sub_category_status','Active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_brand(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('brand');
	$CI->db->where('brand_status','Active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function get_city(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('city');
	$CI->db->where('city_status','active');
	$res = $CI->db->get()->result_array();
	return $res;
}
function order_id_with_prefix($order_id){
	if(strlen($order_id) == 1){
		$order_id_with_prefix = '#DM1100000'.$order_id;
	}else if(strlen($order_id) == 2){
		$order_id_with_prefix = '#DM110000'.$order_id;
	}else if(strlen($order_id) == 3){
		$order_id_with_prefix = '#DM11000'.$order_id;
	}else if(strlen($order_id) == 4){
		$order_id_with_prefix = '#DM1100'.$order_id;
	}else if(strlen($order_id) == 5){
		$order_id_with_prefix = '#DM110'.$order_id;
	}else if(strlen($order_id) > 5){
		$order_id_with_prefix = '#DM11'.$order_id;
	}
	return $order_id_with_prefix;
}

function get_socia_media(){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('web_social_media');
	$CI->db->where('status','yes');
	$CI->db->order_by('w_s_id','desc');
	return $CI->db->get()->result_array();
}

function count_blog($category){
	$CI = get_instance();
	$CI->db->select('*');
	$CI->db->from('blog');
	$CI->db->where('blog_category',$category);
	$CI->db->where_not_in('blog_status','delete');
	return $CI->db->get()->num_rows();
}

function get_privous_id($blog_id){
	$CI = get_instance();
	$sql = "select * from blog where blog_id = (select max(blog_id) from blog where blog_id < $blog_id)";
	$next_sql = $CI->db->query($sql);
	return $next_sql->result();
}
function get_next_id($blog_id){
	$CI = get_instance();
	$sql = "select * from blog where blog_id = (select min(blog_id) from blog where blog_id > $blog_id)";
	$next_sql = $CI->db->query($sql);
	return $next_sql->result();
}
function number_to_words($number)
    {
        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'forty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if ($number < 0) {
            return $negative . number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $digit) {
                $words[] = $dictionary[$digit];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }