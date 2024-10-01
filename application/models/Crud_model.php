<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
	function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $type . '_id' => $type_id
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
	function get_type_vendor_name_by_id($type, $type_id = '', $field = 'name', $m_field = '')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $m_field => $type_id
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
	function get_type_diff_name_by_id($type, $type_id = '', $field = 'name', $m_field = '')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $m_field => $type_id
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
	function get_type_section_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array('id' => $type_id));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
	function get_settings_value($type, $type_name = '', $field = 'value')
    {
        if ($type_name != '') {
            return $this->db->get_where($type, array('type' => $type_name))->row()->$field;       
		}
    }
	
    // FILE_UPLOAD
    function img_thumb($type, $id, $ext = '.jpg', $width = '400', $height = '400')
    {
        $this->load->library('image_lib');
        ini_set("memory_limit", "-1");
        
        $config1['image_library']  = 'gd2';
        $config1['create_thumb']   = TRUE;
        $config1['maintain_ratio'] = TRUE;
        $config1['width']          = $width;
        $config1['height']         = $height;
        $config1['source_image']   = 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
        
        $this->image_lib->initialize($config1);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    
    // FILE_UPLOAD
    function file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->crud_model->img_thumb($type, $id, $ext);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }
    function category_file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg', $token)
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' .$token.''.$type . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->crud_model->category_img_thumb($type, $id, $ext,  '', '', $token);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' .$token.''.$type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->crud_model->category_img_thumb($type, $id . '_' . $ib, $ext, '', '', $token);
                }
            }
        }
    }
	
	function category_img_thumb($type, $id, $ext = '.jpg', $width = '400', $height = '400', $token)
    {
        $this->load->library('image_lib');
        ini_set("memory_limit", "-1");
        
        $config1['image_library']  = 'gd2';
        $config1['create_thumb']   = TRUE;
        $config1['maintain_ratio'] = TRUE;
        $config1['width']          = $width;
        $config1['height']         = $height;
        $config1['source_image']   = 'uploads/' . $type . '_image/' .$token.''.$type . '_' . $id . $ext;
        
        $this->image_lib->initialize($config1);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    // FILE_UPLOAD : EXT :: FILE EXISTS
    function file_exist_ret($type, $id, $ib, $ext = '.jpg')
    {
        if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext)) {
            $ib = $ib + 1;
            $ib = $this->file_exist_ret($type, $id, $ib);
            return $ib;
        } else {
            return $ib;
        }
    }
    
    function file_image($type, $id, $num_of_imgs, $ext = '.jpg')
    {
        $num    = $num_of_imgs;
		$i      = 0;
		$p      = 0;
		$q      = 0;
		$return = array();
		while ($p < $num) {
			$i++;
			if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
				$return[] = $type . '_' . $id . '_' . $i . $ext;
				$p++;
			} else {
				$q++;
				if ($q == 10) {
					break;
				}
			}
		}
		return $return;
    }
	function file_thumb_image($type, $id, $num_of_imgs, $ext = '.jpg')
    {
        $num    = $num_of_imgs;
		$i      = 0;
		$p      = 0;
		$q      = 0;
		$return = array();
		while ($p < $num) {
			$i++;
			if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
				$return[] = $type . '_' . $id . '_' . $i. '_thumb' . $ext;
				$p++;
			} else {
				$q++;
				if ($q == 10) {
					break;
				}
			}
		}
		return $return;
    }
    // FILE_VIEW
    function file_view($type, $id, $width = '100', $height = '100', $thumb = 'no', $src = 'no', $multi = '', $multi_num = '', $ext = '.jpg')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                if ($thumb == 'no') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
                } elseif ($thumb == 'thumb') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_thumb' . $ext;
                }
                
                if ($src == 'no') {
                    return '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                } elseif ($src == 'src') {
                    return $srcl;
                }
            }
			else{
				return base_url() . 'uploads/'. $type.'_image/default.jpg';
			}
            
        } else if ($multi == 'multi') {
            $num    = $this->crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            //$num = 2;
            $i      = 0;
            $p      = 0;
            $q      = 0;
            $return = array();
            while ($p < $num) {
                $i++;
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                    if ($thumb == 'no') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext;
                    } elseif ($thumb == 'thumb') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . '_thumb' . $ext;
                    }
                    
                    if ($src == 'no') {
                        $return[] = '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                    } elseif ($src == 'src') {
                        $return[] = $srcl;
                    }
                    $p++;
                } else {
                    $q++;
                    if ($q == 10) {
                        break;
                    }
                }
                
            }
            if (!empty($return)) {
                if ($multi_num == 'one') {
                    return $return[0];
                } else if ($multi_num == 'all') {
                    return $return;
                } else {
                    $n = $multi_num - 1;
                    unset($return[$n]);
                    return $return;
                }
            } else {
                if ($multi_num == 'one') {
                    return base_url() . 'uploads/'. $type.'_image/default.jpg';
                } else if ($multi_num == 'all') {
                	return array(base_url() . 'uploads/'. $type.'_image/default.jpg');
                } else {
                	return array(base_url() . 'uploads/'. $type.'_image/default.jpg');
                }
            }
        }
    }
    
    // FILE_VIEW
    function file_dlt($type, $id, $ext = '.jpg', $multi = '', $m_sin = '')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . $ext);
            }
            if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext);
            }
            
        } else if ($multi == 'multi') {
            $num = $this->crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            if ($m_sin == '') {
                $i = 0;
                $p = 0;
                while ($p < $num) {
                    $i++;
                    if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . $ext);
                        $p++;
                        $data['num_of_imgs'] = $num - 1;
                        $this->db->where($type . '_id', $id);
                        $this->db->update($type, $data);
                    }
                    
                    if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext);
                    }
                    if ($i > 50) {
                        break;
                    }
                }
            } else {
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $m_sin . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . $ext);
                }
                if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext);
                }
                $data['num_of_imgs'] = $num - 1;
                $this->db->where($type . '_id', $id);
                $this->db->update($type, $data);
            }
        }
    }
    function proof_file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $name . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->crud_model->img_thumb($name, $id, $ext);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $name . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->crud_model->img_thumb($name, $id . '_' . $ib, $ext);
                }
            }
        }
    }
    //DELETE MULTIPLE ITEMS	
    function multi_delete($type, $ids_array)
    {
        foreach ($ids_array as $row) {
            $this->file_dlt($type, $row);
            $this->db->where($type . '_id', $row);
            $this->db->delete($type);
        }
    }
    function delivery_file_dlt($type, $type_name, $id, $ext = '.jpg')
    {
        if (file_exists('uploads/' . $type . '_image/' . $type_name . '_' . $id . $ext)) {
			unlink("uploads/" . $type . "_image/" . $type_name . "_" . $id . $ext);
		}
		if (file_exists("uploads/" . $type . "_image/" . $type_name . "_" . $id . "_thumb" . $ext)) {
			unlink("uploads/" . $type . "_image/" . $type_name . "_" . $id . "_thumb" . $ext);
		}
    }
    //DELETE SINGLE ITEM	
    function single_delete($type, $id)
    {
        $this->file_dlt($type, $id);
        $this->db->where($type . '_id', $id);
        $this->db->delete($type);
    }
    
    /////////SELECT HTML/////////////
    function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single')
    {
        $return = '';
        $other  = '';
        $multi  = 'no';
        $phrase = 'Choose a ' . $name;
        if ($class == 'demo-cs-multiselect') {
            $other = 'multiple';
            $name  = $name . '[]';
            if ($type == 'edit') {
                $e_match = json_decode($e_match);
                if ($e_match == NULL) {
                    $e_match = array();
                }
                $multi = 'yes';
            }
        }
        $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" id="'.$name.'">';
        if (!is_array($from)) {
            if ($condition == '') {
                $all = $this->db->get($from)->result_array();
            } else if ($condition !== '') {
				if($condition_type=='single'){
					$all = $this->db->get_where($from, array(
						$condition => $c_match
					))->result_array();
				}else if($condition_type=='multi'){
					$this->db->where_in($condition,$c_match);
					$all = $this->db->get($from)->result_array();
				}
            }
            
            $return .= '<option value="">Choose one</option>';
            
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row[$from . '_id'] . '">' . $row[$field] . '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row[$from . '_id'] . '" ';
                    if ($multi == 'no') {
                        if ($row[$from . '_id'] == $e_match) {
                            $return .= 'selected=."selected"';
                        }
                    } else if ($multi == 'yes') {
                        if (in_array($row[$from . '_id'], $e_match)) {
                            $return .= 'selected=."selected"';
                        }
                    }
                    $return .= '>' . $row[$field] . '</option>';
                }
            endforeach;
        } else {
            $all = $from;
            $return .= '<option value="">Choose one</option>';
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row . '">';
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    $return .= '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row . '" ';
                    if ($row == $e_match) {
                        $return .= 'selected=."selected"';
                    }
                    $return .= '>';
                    
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    
                    $return .= '</option>';
                }
            endforeach;
        }
        $return .= '</select>';
        return $return;
    }
	function select_name_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single')
    {
        $return = '';
        $other  = '';
        $multi  = 'no';
        $phrase = 'Choose a ' . $name;
        if ($class == 'demo-cs-multiselect') {
            $other = 'multiple';
            $name  = $name . '[]';
            if ($type == 'edit') {
                $e_match = json_decode($e_match);
                if ($e_match == NULL) {
                    $e_match = array();
                }
                $multi = 'yes';
            }
        }
        $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" id="'.$name.'">';
        if (!is_array($from)) {
            if ($condition == '') {
                $all = $this->db->get($from)->result_array();
            } else if ($condition !== '') {
				if($condition_type=='single'){
					$all = $this->db->get_where($from, array(
						$condition => $c_match
					))->result_array();
				}else if($condition_type=='multi'){
					$this->db->where_in($condition,$c_match);
					$all = $this->db->get($from)->result_array();
				}
            }
            
            $return .= '<option value="">Choose one</option>';
            
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row[$field] . '" disabled>' . $row[$field] . '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row[$field] . '" ';
                    if ($multi == 'no') {
                        if ($row[$field] == $e_match) {
                            $return .= 'selected="selected"';
                        }
                    } else if ($multi == 'yes') {
                        if (in_array($row[$field], $e_match)) {
                            $return .= 'selected="selected"';
                        }
                    }
                    $return .= ' disabled>' . $row[$field] . '</option>';
                }
            endforeach;
        } else {
            $all = $from;
            $return .= '<option value="">Choose one</option>';
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row . '">';
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    $return .= '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row . '" ';
                    if ($row == $e_match) {
                        $return .= 'selected=."selected"';
                    }
                    $return .= '>';
                    
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    
                    $return .= '</option>';
                }
            endforeach;
        }
        $return .= '</select>';
        return $return;
    }
	
	function select_country_code_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single',$with_name = '')
    {
        $return = '';
        $other  = '';
        $multi  = 'no';
        $phrase = 'Choose a ' . $name;
        if ($class == 'demo-cs-multiselect') {
            $other = 'multiple';
            $name  = $name . '[]';
            if ($type == 'edit') {
                $e_match = json_decode($e_match);
                if ($e_match == NULL) {
                    $e_match = array();
                }
                $multi = 'yes';
            }
        }
        $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" id="'.$name.'">';
        if (!is_array($from)) {
            if ($condition == '') {
                $all = $this->db->get($from)->result_array();
            } else if ($condition !== '') {
				if($condition_type=='single'){
					$all = $this->db->get_where($from, array(
						$condition => $c_match
					))->result_array();
				}else if($condition_type=='multi'){
					$this->db->where_in($condition,$c_match);
					$all = $this->db->get($from)->result_array();
				}
            }
            
            $return .= '<option value="">Choose one</option>';
            
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row[$field] . '">' . $row[$with_name].' (+'.$row[$field].') </option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row[$field] . '" ';
                    if ($multi == 'no') {
                        if ($row[$field] == $e_match) {
                            $return .= 'selected=."selected"';
                        }
                    } else if ($multi == 'yes') {
                        if (in_array($row[$field], $e_match)) {
                            $return .= 'selected=."selected"';
                        }
                    }
                    $return .= '>' . $row[$with_name].' (+'.$row[$field].') </option>';
                }
            endforeach;
        } else {
            $all = $from;
            $return .= '<option value="">Choose one</option>';
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row . '">';
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    $return .= '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row . '" ';
                    if ($row == $e_match) {
                        $return .= 'selected=."selected"';
                    }
                    $return .= '>';
                    
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    
                    $return .= '</option>';
                }
            endforeach;
        }
        $return .= '</select>';
        return $return;
    }
    //CHECK IF PRODUCT EXISTS IN TABLE
    function exists_in_table($table, $field, $val)
    {
        $ret = '';
        $res = $this->db->get($table)->result_array();
        foreach ($res as $row) {
            if ($row[$field] == $val) {
                $ret = $row[$table . '_id'];
            }
        }
        if ($ret == '') {
            return false;
        } else {
            return $ret;
        }
    }
    
    // PAGINATION
    function pagination($type, $per, $link, $f_o, $f_c, $other, $current, $seg = '3', $ord = 'desc')
    {
        $t   = explode('#', $other);
        $t_o = $t[0];
        $t_c = $t[1];
        $c   = explode('#', $current);
        $c_o = $c[0];
        $c_c = $c[1];
        
        $this->load->library('pagination');
        $this->db->order_by($type . '_id', $ord);
        $config['total_rows']  = $this->db->count_all_results($type);
        $config['base_url']    = base_url() . $link;
        $config['per_page']    = $per;
        $config['uri_segment'] = $seg;
        
        $config['first_link']      = '&laquo;';
        $config['first_tag_open']  = $t_o;
        $config['first_tag_close'] = $t_c;
        
        $config['last_link']      = '&raquo;';
        $config['last_tag_open']  = $t_o;
        $config['last_tag_close'] = $t_c;
        
        $config['prev_link']      = '&lsaquo;';
        $config['prev_tag_open']  = $t_o;
        $config['prev_tag_close'] = $t_c;
        
        $config['next_link']      = '&rsaquo;';
        $config['next_tag_open']  = $t_o;
        $config['next_tag_close'] = $t_c;
        
        $config['full_tag_open']  = $f_o;
        $config['full_tag_close'] = $f_c;
        
        $config['cur_tag_open']  = $c_o;
        $config['cur_tag_close'] = $c_c;
        
        $config['num_tag_open']  = $t_o;
        $config['num_tag_close'] = $t_c;
        $this->pagination->initialize($config);
        
        $this->db->order_by($type . '_id', $ord);
        return $this->db->get($type, $config['per_page'], $this->uri->segment($seg))->result_array();
    }
    
    //GETTING BOOTSTRAP COLUMN VALUE
    function boot($num)
    {
        return (12 / $num);
    }
    
    //GETTING LIMITING CHARECTER
    function limit_chars($string, $char_limit)
    {
        $length = 0;
        $return = array();
        $words  = explode(" ", $string);
        foreach ($words as $row) {
            $length += strlen($row);
            $length += 1;
            if ($length < $char_limit) {
                array_push($return, $row);
            } else {
                array_push($return, '...');
                break;
            }
        }
        
        return implode(" ", $return);
    }
    
    //GETTING LOGO BY TYPE
    function logo($type)
    {
        $logo = $this->db->get_where('general_settings', array('type' => $type))->row()->value;
        return base_url() . 'uploads/logo_image/logo_' . $logo . '.png';
    }
    
    //GETTING ADMIN PERMISSION
    function admin_permission($codename)
    {
       if ($this->session->userdata('admin_login') != 'yes') {
            return false;
        }
		$admin_id   = $this->session->userdata('admin_id');
		if($admin_id == '1'){
			return true;
		}else{
			$admin      = $this->db->get_where('admin', array('admin_id' => $admin_id))->row();
			$permission = $this->db->get_where('permission', array('codename' => $codename))->row()->permission_id;
			$role = $admin->role;
			$role_permissions = json_decode($this->crud_model->get_type_name_by_id('role', $role, 'permission'));
			if (in_array($permission, $role_permissions)) {
				return true;
			} else {
				return false;
			}
		}
        
    }
	
	function app_file_view($type, $id, $width = '100', $height = '100', $thumb = 'no', $src = 'no', $multi = '', $multi_num = '', $ext = '.jpg')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                if ($thumb == 'no') {
                    $srcl = $type . '_' . $id . $ext;
                } elseif ($thumb == 'thumb') {
                    $srcl = $type . '_' . $id . '_thumb' . $ext;
                }
                
                if ($src == 'no') {
                    return '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                } elseif ($src == 'src') {
                    return $srcl;
                }
            }
			else{
				return 'default.jpg';
			}
            
        } else if ($multi == 'multi') {
            $num    = $this->crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            //$num = 2;
            $i      = 0;
            $p      = 0;
            $q      = 0;
            $return = array();
            while ($p < $num) {
                $i++;
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                    if ($thumb == 'no') {
                        $srcl = $type . '_' . $id . '_' . $i . $ext;
                    } elseif ($thumb == 'thumb') {
                        $srcl = $type . '_' . $id . '_' . $i . '_thumb' . $ext;
                    }
                    
                    if ($src == 'no') {
                        $return[] = '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                    } elseif ($src == 'src') {
                        $return[] = $srcl;
                    }
                    $p++;
                } else {
                    $q++;
                    if ($q == 10) {
                        break;
                    }
                }
                
            }
            if (!empty($return)) {
                if ($multi_num == 'one') {
                    return $return[0];
                } else if ($multi_num == 'all') {
                    return $return;
                } else {
                    $n = $multi_num - 1;
                    unset($return[$n]);
                    return $return;
                }
            } else {
                if ($multi_num == 'one') {
                    return 'default.jpg';
                } else if ($multi_num == 'all') {
                	return array('default.jpg');
                } else {
                	return array('default.jpg');
                }
            }
        }
    }
}
