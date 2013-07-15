<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * PT Gapura Angkasa
	 * Administration Management System.
	 * ver 1.0.0
	 *
	 * user controller
	 *
	 * url : http://ams.gapura.co.id/
	 * developer : www.studiokami.com
	 * phone : 0361 853 2400
	 * email : support@studiokami.com
	 */
	
	
# constuction ------------------------------	
	 function __construct()
	{
        parent::__construct();
		
		# load model, library and helper
		$this->load->model('user_model','', TRUE);
		
		# user restriction
		if ( ! $this->session->userdata('logged_in'))
    	{ 
        	# function allowed for access without login
			$allowed = array('index', 'login', 'do_login', 'pin_verification', 'do_pin_verification', 'registration', 'do_registration', 'select_unit');
        
			# other function need login
			if (! in_array($this->router->method, $allowed)) 
			{
    			redirect('user/login');
			}
   		 }
    }
# constuction ------------------------------	

# index ------------------------------------	 
	public function index()
	{
		redirect('user/login');
	}
# index ------------------------------------	
	
# login ------------------------------------
	public function login()
	{
		# view login form
		$data['message']='Masukan email anda dengan benar.';
		$this->load->view('template/header');
		$this->load->view('user/login', $data);
		$this->load->view('template/footer');
	}
	
	public function do_login()
	{
		# get email data from form		
		$email = $this->input->post('email');	
		
		#validate data
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		

		if ($this->form_validation->run() == FALSE)
		{
			# validation fail do re-login
			# send mesg to view
			$this->form_validation->set_message('required', 'Email wajib diisi !!!');
			$this->form_validation->set_message('valid_email', 'Email wajib diisi !!!');
			$this->form_validation->set_error_delimiters('<div class="alert alert-error">', '</div>');
			
			# validation false, force user to re-login
			$data['message']='Email anda salah.';
			$this->load->view('template/header');
			$this->load->view('user/login', $data);
			$this->load->view('template/footer');
		}
		else
		{
			
			# check email on local database 
			$result = $this->user_model->check_reg_email($email);
			
			# check email on ams database 
			#$result = $this->user_model->check_reg_email($email);
			
			if($result)
			{
					# if email found on database
					foreach($result as $row)
					{
						 $nama = $row->ui_nama; 
						 $nipp = $row->ui_nipp; 
						 $hp = $row->ui_hp; 
						 $email = $row->ui_email; 
						 $cabang = $row->ui_cabang; 
						 $unit = $row->ui_unit; 
						 $jabatan = $row->ui_jabatan; 
						 $app_level = $row->ui_app_level; 
						 $app_role = $row->ui_app_role; 
						 $verification = $row->ui_verification; 
						 $ver_date = $row->ui_ver_date;
						 $approval = $row->ui_approval;
					}
			 		
					# if user exist then check user approval by admin
					if($approval == 'n')
					{
						# if user exist but no approve yet, call admin
						$data['message'] = 'Profile anda belum di approve, hubungi Team Sigap';
						$this->load->view('template/header');
						$this->load->view('user/login', $data);
						$this->load->view('template/footer');
					}
					else
					{
						# send email to view
						$data['email'] = $email;
						
						# call models to delete previous verification duplicate data
						$this->user_model->del_dup_prev_ver_data($email);
						
						# create random pin
						$this->load->helper('pin');
						$pin = get_pin();
						$email_link = $email . '+' . $pin ;
						
						# encrypt email link to send via email
						$email_link = base64_encode($email_link);
						$email_link = urlencode($email_link);
						
						# set request date & expired date
						$request = mdate("%Y-%m-%d %H:%i:%s", time());
						$expired = mdate("%Y-%m-%d %H:%i:%s", time()+3600);
						
						# set verification type
						$type = 'login';
						
						# call models to save new pin and verification link
						$this->user_model->save_verification($email, $hp, $pin, $email_link, $request, $expired, $type);
						
						# send pin and link via sendemail
						$config['protocol'] = 'sendmail';
						$config['mailpath'] = '/usr/sbin/sendmail';
						$config['charset'] = 'iso-8859-1';
						$config['wordwrap'] = TRUE;
						$config['mailtype'] = 'html';
						$this->email->initialize($config);
						# send pin and link via sendemail
						
						# send pin and link via smtp
						/*$config['protocol'] = 'smtp';
						$config['smtp_host'] = 'ssl://smtp.googlemail.com';
						$config['smtp_port'] = 465;
						$config['smtp_user'] = 'xxx@gapura.co.id';
						$config['smtp_pass'] = 'xxxx';
						$config['charset'] = 'iso-8859-1';
						$config['wordwrap'] = TRUE;
						$config['mailtype'] = 'html';
						$this->load->library('email', $config);
						$this->email->set_newline("\r\n");*/
						# send pin and link via smtp
						
						$this->email->from('admin@gapura.co.id', 'Team Sigap');
						$this->email->to($email); 
						$this->email->subject('PT Gapura Angkasa AMS Registration');
						$this->email->message('
						
						<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
						<title>Untitled Document</title>
						</head>
						
						<body>
						<p>Your verification code : ' . $pin . '</p>
						<p>or</p>
						<p>Please click link below to verify your request :</p>
						<p>{unwrap}' . anchor("user/verification/" . $email_link, 'http://ams.dps.gapura.co.id/user/verification/' . $email_link) . '{/unwrap}</p>
						<p>Thank you</p>
						<p>Best regards</p>
						<p>SIGAP Team</p>
						<p>&nbsp;</p>
						</body>
						</html>
						
						');
						$this->email->send();
						
						# show link for develope mode only, please disable on run mode
						#echo $email . ' - ' . $pin . ' - ' . $email_link;
						
						# call views
						$data['message'] = 'masukan kode verifikasi yang anda terima di inbox email.';
						$this->load->view('template/header');
						$this->load->view('user/verification', $data);
						$this->load->view('template/footer');
					}
					
			}
			else
			{
				# send mesg to view
				$data['message']='silahkan melakukan registrasi';
				
				# not register user redirect to register page
				redirect('user/registration/', $data);
			}
		}
	}
# login ------------------------------------


# logout -----------------------------------
	public function logout()
	{
		session_start();
		$this->session->unset_userdata('logged_in');
   		session_destroy();
		redirect('dashboard', 'refresh');
	}
# logout -----------------------------------


# verification ------------------------------	
	public function pin_verification()
	{
		# set manual email from user
		$data['email'] = '';
		
		# call view
		$this->load->view('template/header');
		$this->load->view('user/verification', $data);
		$this->load->view('template/footer');
	}
	
	public function do_pin_verification()
	{
		# get data
		$email = $this->input->post('email');
		$pin = $this->input->post('pin');
		
		# call model
		$result = $this->user_model->do_verification($email, $pin);
		
		# check pin to verify
		if($result)
		   {
			 # if pin sucess prepare session
			 $sess_array = array();
			 foreach($result as $row)
			 {
			   $sess_array = array(
			     'ui_id' => $row->ui_id,
				 'ui_nama' => $row->ui_nama, 
				 'ui_nipp' => $row->ui_nipp, 
				 'ui_hp' => $row->ui_hp, 
				 'ui_email' => $row->ui_email, 
				 'ui_cabang' => $row->ui_cabang, 
				 'ui_unit' => $row->ui_unit, 
				 'ui_jabatan' => $row->ui_jabatan, 
				 'ui_function' => $row->ui_function,
				 'ui_app_level' => $row->ui_app_level, 
				 'ui_app_role' => $row->ui_app_role, 
				 'ui_verification' => $row->ui_verification, 
				 'ui_ver_date' => $row->ui_ver_date
			   );
			   # set session for auto login
			   $this->session->set_userdata('logged_in', $sess_array);
			 }
			 # redirect to dashboard after logged in
			 redirect('dashboard');
			 return TRUE;
		   }
		   else
		   {
			 # verification pin fail, force to try again
			 $data['email'] = $this->input->post('email');
			 $data['success_message'] = 'link yang anda klik salah, masukan kode verifikasi yang anda terima di inbox email.';
			 $this->load->view('template/header');
			 $this->load->view('user/verification', $data);
			 $this->load->view('template/footer');
			 return FALSE;
		   }
		
		
		
		$this->load->view('template/header');
		$this->load->view('user/dashboard');
		$this->load->view('template/footer');
	}
	
	public function verification()
	{
		# get data
		$email_link= $this->uri->segment(3, 0);
		$email_link = urldecode($email_link);
		$email_link = base64_decode($email_link);
		
		# split data			
		$url_result = explode("+", $email_link);
		$email = $url_result[0];
		$pin = $url_result[1];
		
		# call model
		$result = $this->login_model->do_verification($email, $pin);
		
		# check verification link
		if($result)
		   {
			 # if success prepare session
			 $sess_array = array();
			 foreach($result as $row)
			 {
			   $sess_array = array(
			     'ui_id' => $row->ui_id, 
				 'ui_nama' => $row->ui_nama, 
				 'ui_nipp' => $row->ui_nipp, 
				 'ui_hp' => $row->ui_hp, 
				 'ui_email' => $row->ui_email, 
				 'ui_cabang' => $row->ui_cabang, 
				 'ui_unit' => $row->ui_unit, 
				 'ui_jabatan' => $row->ui_jabatan, 
				 'ui_app_level' => $row->ui_app_level, 
				 'ui_app_role' => $row->ui_app_role, 
				 'ui_verification' => $row->ui_verification, 
				 'ui_ver_date' => $row->ui_ver_date
			   );
			   # set session
			   $this->session->set_userdata('logged_in', $sess_array);
			   
			 }
			 # logged in and redirect user to dashboard
			 redirect('team');
			 return TRUE;
		   }
		   else
		   {
			 # verification fail force user to input pin from email
			 $data['success_message'] = 'link yang anda klik salah, masukan kode verifikasi yang anda terima di inbox email.';
			 $nav['view_dashboard'] = 'class="active"';
			 $this->load->view('team/header', $nav);
			 $this->load->view('login/login_verification_view', $data);
			 $this->load->view('team/footer');
			 
			 
			 return FALSE;
		   }
		   
	}
# verification ------------------------------


# registration -----------------------------
	public function registration()
	{
		# get stn available
		$data['station'] = $this->user_model->get_station();
		
		# send mesg to view
		$data['message']='silahkan melakukan registrasi, silahkan mendaftar melalui supervisor on duty apabila tidak memiliki email corporate';
		# call view
		$this->load->view('user/header');
		$this->load->view('user/registration', $data);
		$this->load->view('template/footer');
	}
	
	
	
	
	
	public function do_registration()
	{
		# scenario :
		# get data from register form
		# do data validation
		# do save data to db
		# send pin or url verification via email
		# do inline verification
		
		# get data from register form
		$nama = $this->input->post('nama');
		$nipp = $this->input->post('nipp');
		$hp = $this->input->post('hp');
		$email = $this->input->post('email');
		$station = $this->input->post('station');
		$unit = $this->input->post('unit');
		$sub_unit = $this->input->post('sub_unit');
		$team = $this->input->post('team');
		$jabatan = $this->input->post('jabatan');
		echo $station . $unit . $sub_unit . $team . $jabatan . $nipp;
		/*# do validation rules
		$this->form_validation->set_rules('email', 'email', 'trim|required|min_length[3]|alpha_dash|xss_clean');
		$this->form_validation->set_rules('hp', 'hp', 'trim|required|min_length[3]|numeric|xss_clean');
		$this->form_validation->set_rules('nipp', 'nipp', 'trim|required|min_length[3]|numeric|xss_clean');
		
				if ($this->form_validation->run() == FALSE)
				{
					# if fail force to do registration again
					
					# get stn available
					$data['station'] = $this->user_model->get_station();
					
					# send mesg to view
					$data['message']='silahkan melakukan registrasi, bila anda tidak memiliki email perusahaan, silahkan mendaftar melalui supervisor on duty';
					
					# call view		
					$this->load->view('template/header');
					$this->load->view('user/registration', $data);
					$this->load->view('template/footer');			
				}
				else
				{
					# do registration
					# prepare data
					$user_email = $email;
				    $full_email = $email . '@gapura.co.id';
										
					# send view
					$data['email'] = $full_email;
					
					# call models to delete previous verification duplicate data
					$this->user_model->del_dup_prev_ver_data($full_email);
					
					# call models to delete unverify duplicate user data on user identity table
					$this->user_model->del_dup_prev_user_unver_data($full_email);
					
					# call models to save data
					$this->user_model->save_user($nama, $nipp, $hp, $full_email, $cabang, $unit, $jabatan);
					
					# create random pin
					$this->load->helper('pin');
					$pin = get_pin();
					$email_link = $full_email . '+' . $pin ;
					
					# encrypt email link to send via email
					$email_link = base64_encode($email_link);
					$email_link = urlencode($email_link);
					
					# set request date & expired date
					$request = mdate("%Y-%m-%d %H:%i:%s", time());
					$expired = mdate("%Y-%m-%d %H:%i:%s", time()+3600);
					
					# set verification type
					$type = 'register';
					
					# call models to save data
					$this->user_model->save_verification($full_email, $hp, $pin, $email_link, $type, $request, $expired);
					
					# send pin and link via email
					$config['protocol'] = 'sendmail';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$config['mailtype'] = 'html';
					$this->email->initialize($config);
					
					$this->email->from('admin@gapura.co.id', 'Team Sigap');
					$this->email->to($full_email); 
					$this->email->subject('PT Gapura Angkasa Registration Verification System');
					$this->email->message('
					
					<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
					<html xmlns="http://www.w3.org/1999/xhtml">
					<head>
					<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
					<title>Untitled Document</title>
					</head>
					
					<body>
					<p>Your verification code : ' . $pin . '</p>
					<p>or</p>
					<p>Please click link below to verify your request :</p>
					<p>{unwrap}' . anchor("user/verification/" . $email_link, 'http://ams.gapura.co.id/user/verification/' . $email_link) . '{/unwrap}</p>
					<p>Thank you</p>
					<p>Best regards</p>
					<p>SIGAP Team</p>
					<p>&nbsp;</p>
					</body>
					</html>
					
					');
					$this->email->send();
		
					# call views
					$data['success_message'] = 'masukan kode verifikasi yang anda terima di inbox email.';
					$this->load->view('template/header');
					$this->load->view('user/verification', $data);
					$this->load->view('template/footer');
				}
		#	}*/
			
	}
# registration -----------------------------

# level manager --------------------------
	public function manage_station()
	{
		try
		{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('user_station');
			$crud->set_subject('Station');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			$crud->display_as('us_code','Station Code');
			$crud->display_as('us_name','Station Name');
			$crud->order_by('us_id','asc');
			
			$output = $crud->render();
			
			#$this->_example_output($output);
			$data['nama']= '';
			$data['cabang']= '';
			$data['unit']= '';
			
			# call view
			$this->load->view('user/header', $output);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/breadcumb');
			$this->load->view('user/level_manager', $output);
			$this->load->view('template/footer');
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	public function manage_unit()
	{
		try
		{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('user_unit');
			$crud->set_subject('Unit');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			#$crud->display_as('us_code','Station Code');
			#$crud->display_as('us_name','Station Name');
			$crud->set_relation('uu_us_id','user_station','{us_code} [{us_id}] ');
			
			$output = $crud->render();
			
			#$this->_example_output($output);
			$data['nama']= '';
			$data['cabang']= '';
			$data['unit']= '';
			
			# call view
			$this->load->view('user/header', $output);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/breadcumb');
			$this->load->view('user/level_manager', $output);
			$this->load->view('template/footer');
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
	
	public function manage_sub_unit()
	{
		try
		{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('user_sub_unit');
			$crud->set_subject('Unit');
			#$crud->required_fields('city');
			#$crud->columns('city','country','phone','addressLine1','postalCode');
			#$crud->display_as('us_code','Station Code');
			#$crud->display_as('us_name','Station Name');
			
			$output = $crud->render();
			
			#$this->_example_output($output);
			$data['nama']= '';
			$data['cabang']= '';
			$data['unit']= '';
			
			# call view
			$this->load->view('user/header', $output);
			$this->load->view('template/sidebar', $data);
			$this->load->view('template/breadcumb');
			$this->load->view('user/level_manager', $output);
			$this->load->view('template/footer');
			
		}
		catch(Exception $e)
		{
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
		
	}
# level manager --------------------------
	
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */