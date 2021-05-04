<?php
	$CI = get_instance();
	$CI->load->database();
	$CI->load->dbforge();
	
	//update version
	$condition = array(
	    'title' => 'version'
	);
	if($CI->db->get_where('config', $condition)->num_rows() > 0):
		$data['value'] 	= 	'1.0.6';
		$CI->db->where($condition);
		$CI->db->update('config',$data);
	else:
		$data['title'] 	= 	'version';
		$data['value'] 	= 	'1.0.6';
		$CI->db->insert('config',$data);
	endif;

	//fix site name
	$condition = array(
	    'title' => 'site_name'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'site_name';
		$data['value'] 	= 	'My Site';
		$CI->db->insert('config',$data);
	endif;

	// preroll_ads_enable
	$condition = array(
	    'title' => 'preroll_ads_enable'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'preroll_ads_enable';
		$data['value'] 	= 	'0';
		$CI->db->insert('config',$data);
	endif;

	// preroll_ads_video
	$condition = array(
	    'title' => 'preroll_ads_video'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'preroll_ads_video';
		$data['value'] 	= 	'';
		$CI->db->insert('config',$data);
	endif;

	// admob_ads_enable
	$condition = array(
	    'title' => 'admob_ads_enable'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'admob_ads_enable';
		$data['value'] 	= 	'0';
		$CI->db->insert('config',$data);
	endif;


	// admob_app_id
	$condition = array(
	    'title' => 'admob_publisher_id'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'admob_publisher_id';
		$data['value'] 	= 	'pub-xxxxxxxxxxxxxxxxx';
		$CI->db->insert('config',$data);
	endif;


	// admob_app_id
	$condition = array(
	    'title' => 'admob_app_id'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'admob_app_id';
		$data['value'] 	= 	'xxxxxxxxxxxxxxxxx';
		$CI->db->insert('config',$data);
	endif;


	// admob_banner_ads_id
	$condition = array(
	    'title' => 'admob_banner_ads_id'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'admob_banner_ads_id';
		$data['value'] 	= 	'xxxxxxxxxxxx';
		$CI->db->insert('config',$data);
	endif;


	// admob_interstitial_ads_id
	$condition = array(
	    'title' => 'admob_interstitial_ads_id'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'admob_interstitial_ads_id';
		$data['value'] 	= 	'xxxxxxxxxxxxxxxxx';
		$CI->db->insert('config',$data);
	endif;


	// total_movie_in_slider
	$condition = array(
	    'title' => 'total_movie_in_slider'
	);
	if($CI->db->get_where('config', $condition)->num_rows() == 0):
		$data['title'] 	= 	'total_movie_in_slider';
		$data['value'] 	= 	'5';
		$CI->db->insert('config',$data);
	endif;

	// create subtitle table if not exist
	$fields = array(
        'subtitle_id' => array(
                'type' => 'INT',
                'constraint' => 200,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
        ),
        'videos_id' => array(
                'type' => 'INT',
                'constraint' => '200',
                'null' => FALSE,
        ),
        'video_file_id' => array(
                'type' =>'INT',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'language' => array(
                'type' =>'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'kind' => array(
                'type' =>'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'src' => array(
                'type' =>'TEXT',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'srclang' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'common' => array(
                'type' => 'INT',
                'constraint' => '200',
                'null' => TRUE,
                'default' => '0',
        ),
        'status' => array(
                'type' => 'INT',
                'constraint' => '200',
                'null' => TRUE,
                'default' => '1',
        ),
	);
	$CI->dbforge->add_field($fields);
	$CI->dbforge->add_key('subtitle_id', TRUE);
	$CI->dbforge->create_table('subtitle', TRUE);

	// create tvseries subtitle table if not exist
	
	$fields2 = array(
        'tvseries_subtitle_id' => array(
                'type' => 'INT',
                'constraint' => 200,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
        ),
        'videos_id' => array(
                'type' => 'INT',
                'constraint' => '200',
                'null' => FALSE,
        ),
        'episodes_id' => array(
                'type' =>'INT',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'language' => array(
                'type' =>'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'kind' => array(
                'type' =>'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'src' => array(
                'type' =>'TEXT',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'srclang' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => TRUE,
        ),
        'common' => array(
                'type' => 'INT',
                'constraint' => '200',
                'null' => TRUE,
                'default' => '0',
        ),
        'status' => array(
                'type' => 'INT',
                'constraint' => '200',
                'null' => TRUE,
                'default' => '1',
        ),
	);
	$CI->dbforge->add_field($fields2);
	$CI->dbforge->add_key('tvseries_subtitle_id', TRUE);
	$CI->dbforge->create_table('tvseries_subtitle', TRUE);

	$CI->db->where('is_tvseries !=','1');
	$CI->db->update('videos',array('enable_download'=>'1'));
?>
