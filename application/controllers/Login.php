<?php

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

		$this->load->model('mLogin');
	}


	function index()
	{
		/*if ($this->session->userdata('email')) {
			redirect('user');
		}
		*/

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() == false) {
			$this->load->view('vLogin');
		} else {
			$this->_auth();
		}
	}


	function _auth()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->mLogin->auth($email, $password);

		if($user) {
			$data_ses = [
				'email' => $user['email'],
				'password' => $user['password']
			];

			$this->session->set_userdata($data_ses);

			if($user['role_id']== 1) {
				redirect('admin/Dashboard');
			} else {
				redirect('User');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
			redirect('Login');
		}
	}


	private function _sendEmail($token)
	{
		$config = [
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_user' => 'bondanchorisma.umrah@gmail.com',
			'smtp_pass' => 'bondanch2828',
			'smtp_port' => 465,
			'mailtype'  => 'html',
			'charset'   => 'utf-8',
			'newline'   => "\r\n"
		];

		$this->email->initialize($config);

		$this->email->from('bondanchorisma.umrah@gmail.com', 'Bondan Chorisma');
		$this->email->to($this->input->post('email'));

		$this->email->subject('Konfirmasi Pergantian Sandi');
		$this->email->message('Silahkan ganti sandi anda <br> tekan tautan berikut : <a href="' . base_url() . 'index.php/Login/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');


		if ($this->email->send()) {
			return true;
		} else {
			echo $this->email->print_debugger();
			die;
		}
	}


	public function forgotPassword()
	{

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run() == false) {
			$this->load->view('vForgot');
		} else {
			$email = $this->input->post('email');
			$user = $this->mLogin->_getEmail($email);

			if ($user) {
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date' => date("Y-m-d")
				];

				$this->db->insert('user_token', $user_token);
				$this->_sendEmail($token);

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Please check your email to reset your password!</div>');
				redirect('Login/forgotpassword');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered or activated!</div>');
				redirect('Login/forgotpassword');
			}
		}
	}





	public function resetPassword()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$userEmail = $this->mLogin->_getEmail($email);



		if ($userEmail) {
			$userToken = $this->mLogin->_getToken($token);

			if ($userToken) {
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong token.</div>');
				redirect('Login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Reset password failed! Wrong email.</div>');
			redirect('Login');
		}
	}


	public function changePassword()
	{
		if (!$this->session->userdata('reset_email')) {
			redirect('Login');
		}

		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[3]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[3]|matches[password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('vChange');
		} else {
			$password = sha1($this->input->post('password1'));
			$email = $this->session->userdata('reset_email');


			$this->mLogin->changePassword($email, $password);

			$this->session->unset_userdata('reset_email');

			$this->mLogin->deletePassword($email);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! Please login.</div>');
			redirect('Login');
		}
	}

}
