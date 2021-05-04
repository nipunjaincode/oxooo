<?php
	$CI = get_instance();
	$CI->load->database();
	$CI->load->dbforge();
	
	//update version
	$condition = array(
	    'title' => 'version'
	);
	if($CI->db->get_where('config', $condition)->num_rows() > 0):
		$data['value'] 	= 	'1.0.7';
		$CI->db->where($condition);
		$CI->db->update('config',$data);
	else:
		$data['title'] 	= 	'version';
		$data['value'] 	= 	'1.0.7';
		$CI->db->insert('config',$data);
	endif;
?>
