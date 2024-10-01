<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class deal_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
		$this->table_name = 'deal_master';
		$this->deal_transcation_table_name = 'deal_transaction';
		$this->agent_table_name = 'agent_master';
		$this->investor_table_name = 'investor_master';
		$this->agent_products_table_name = 'agent_products';
    }
	
	public function get_total_deal_data_count($name,$agent_id,$company_id){
	    if($agent_id != ''){
			$this->db->where('dm.agent_id',$agent_id);
		}
		if($company_id != ''){
			$this->db->where('dm.investor_id',$company_id);
		}
	
		$this->db->select('*');
		$this->db->from($this->table_name . ' AS dm');
		$this->db->join($this->agent_table_name . ' AS at', 'dm.agent_id = at.agent_id', 'inner');
		$this->db->join($this->investor_table_name . ' AS inv', 'dm.investor_id = inv.investor_id', 'inner');
		$this->db->where_not_in('dm.deal_status', 'delete');
		$this->db->order_by('dm.deal_id', 'desc');
		return $this->db->get()->result_array();

	}
	
	public function get_total_deal_data($name,$agent_id,$company_id,$limit,$start){
	    
	    
	    if($agent_id != ''){
			$this->db->where('dm.agent_id',$agent_id);
		}
		if($company_id != ''){
			$this->db->where('dm.investor_id',$company_id);
		}
		
		$this->db->select('*');
		$this->db->from($this->table_name . ' AS dm');
		$this->db->where_not_in('dm.deal_status', 'delete');
		$this->db->order_by('dm.deal_id', 'desc');
		$this->db->limit($limit, $start);
		return $this->db->get()->result_array();
		echo $this->db->last_query(); 

	}	
	
	
	public function get_deal_details($deal_id,$deal_token){
		$this->db->select('*');
		$this->db->from($this->table_name);
		$this->db->where('deal_id',$deal_id);
		$this->db->where('deal_token',$deal_token);
		return $this->db->get()->result_array();
	}
	
	public function get_total_deal_transactions_data_count($deal){
		
		$this->db->select('*');
		$this->db->from($this->deal_transcation_table_name);
		$this->db->join($this->table_name, $this->table_name.'.deal_id = ' . $this->deal_transcation_table_name . '.deal_id', 'inner');
		$this->db->where($this->deal_transcation_table_name . '.deal_id', $deal);
		$this->db->where_not_in($this->deal_transcation_table_name . '.deal_status', 'delete');
		$this->db->order_by($this->deal_transcation_table_name . '.deal_transaction_id ', 'desc');
		return $query = $this->db->get()->result_array();
		
		$this->db->select('*');
		$this->db->from($this->deal_transcation_table_name);
		$this->db->where('deal_id',$deal);
		$this->db->where_not_in('deal_status','delete');
		$this->db->order_by('deal_id','desc');
		return $this->db->get()->result_array();
	}
	public function get_total_deal_transactions_data($deal,$limit,$start){
		
		$this->db->select('*, ' . $this->deal_transcation_table_name . '.deal_status as transaction_status');
		$this->db->from($this->deal_transcation_table_name);
		$this->db->join($this->table_name, $this->table_name . '.deal_id = ' . $this->deal_transcation_table_name . '.deal_id', 'inner');
		$this->db->where($this->deal_transcation_table_name . '.deal_id', $deal);
		$this->db->where_not_in($this->deal_transcation_table_name . '.deal_status', 'delete');
		$this->db->order_by($this->deal_transcation_table_name . '.deal_transaction_id', 'desc');
		$this->db->limit($limit, $start);
		$query = $this->db->get();
		return $query->result_array();
		
		$this->db->select('*');
		$this->db->from($this->deal_transcation_table_name);
		$this->db->where('deal_id',$deal);
		$this->db->where_not_in('deal_status','delete');
		$this->db->order_by('deal_id','desc');
		$this->db->limit($limit,$start);
		return $this->db->get()->result_array();
	}	
	
	
	public function get_agent_products($agent_id){
		/*$this->db->select('product_id');
		$this->db->from($this->agent_products_table_name);
		$this->db->where('agent_id', $agent_id);
		$subquery = $this->db->get_compiled_select(); // Compiles the query without executing it

		// Step 2: Use the compiled subquery in the main query
		$this->db->select('*');
		$this->db->from('products');
		$this->db->where("products_id IN ($subquery)", NULL, FALSE);*/
		$this->db->select('*');
		$this->db->from($this->agent_products_table_name);
		$this->db->where('agent_id', $agent_id);		
		return $result = $this->db->get()->result_array();
	}
	public function get_agent_product_details($agent_product_details_id)
	{
		$this->db->select('*');
		$this->db->from($this->agent_products_table_name);
		$this->db->where('id', $agent_product_details_id);		
		return $result = $this->db->get()->result_array();
	}
	public function get_investor_details($investor_id)
	{
		
		$this->db->select('*');
		$this->db->from($this->investor_table_name);
		$this->db->where('investor_id', $investor_id);		
		return $result = $this->db->get()->result_array();
	}
		
	
	
}