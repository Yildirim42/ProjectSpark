<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$this->load->view('login_view');
	}

	public function login_process()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('User_model');
		$user = $this->User_model->login($username, $password);

		if ($user) {
			$user_data = array(
				'user_id'   => $user->id,
				'username'  => $user->username,
				'full_name' => $user->full_name,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($user_data);
			redirect('feed');
		} else {
			$this->session->set_flashdata('error', 'Kullanıcı adı veya şifre hatalı!');
			redirect('auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	public function register()
	{
		$this->load->view('register_view');
	}

	public function register_process()
	{
		$this->form_validation->set_rules('username', 'Kullanıcı Adı', 'required|is_unique[users.username]|alpha_numeric');
		$this->form_validation->set_rules('full_name', 'Ad Soyad', 'required');
		$this->form_validation->set_rules('password', 'Şifre', 'required|min_length[6]');
		$this->form_validation->set_rules('passconf', 'Şifre Tekrarı', 'required|matches[password]');

		$this->form_validation->set_message(
            array(
                "required"    => "<b>{field}</b> alanı doldurulmalıdır.",
                "is_uniqe"    => "Böyle bir kullanıcı zaten var!",
                "matches"     => "Şifreler birbiri ile eşleşmiyor."
            )
        );



		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('auth/register');
		} else {
			$data = array(
				'username'  => $this->input->post('username'),
				'full_name' => $this->input->post('full_name'),
				// PHP 7.4 Güvenli Şifreleme
				'password'  => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'profile_pic' => 'default_avatar.png'
			);

			$this->load->model('User_model');
			if ($this->User_model->register($data)) {
				$this->session->set_flashdata('success', 'Kayıt başarılı! Şimdi giriş yapabilirsiniz.');
				redirect('auth');
			} else {
				$this->session->set_flashdata('error', 'Bir hata oluştu, lütfen tekrar deneyin.');
				redirect('auth/register');
			}
		}
	}
}
