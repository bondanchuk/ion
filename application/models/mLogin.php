<?php

class mLogin extends CI_Model
{

	function auth($email, $password)
	{
		$data = array(
			'email' => $email,
			'password' => sha1($password)
		);
		return $this->db->get_where('tmst_user', $data)->row_array();
	}


	function _getEmail($email)
	{
		$data = array('email' => $email);
		return $this->db->get_where('tmst_user', $data)->row_array();
	}

	function _getToken($token)
	{
		$data = array('token' => $token);
		return $this->db->get_where('user_token', $data)->row_array();
	}

	function changePassword($email, $password)
	{
		$this->db->set('password', $password);
		$this->db->where('email', $email);
		$this->db->update('tmst_user');
	}

	function deletePassword($email)
	{
		$this->db->delete('user_token', ['email' => $email]);
	}
}
