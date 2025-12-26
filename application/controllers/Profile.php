<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Giriş yapmayan kullanıcıyı koru
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Post_model');
        $this->load->model('User_model');
    }

    // Profil Sayfası Ana Görünümü
    public function index($username = NULL)
    {

        // 1. Eğer URL'den bir isim gelmediyse giriş yapan kullanıcının adını al
        if ($username === NULL) {
            $username = $this->session->userdata('username');
        }

        // 2. Kullanıcıyı veritabanında ara
        $user = $this->User_model->get_user_by_username($username);

        // Kullanıcı bulunamazsa 404 göster
        if (!$user) {
            show_404();
        }

        // 3. Bu profil oturum açan kişiye mi ait?
        $data['is_mine'] = ($user->id == $this->session->userdata('user_id'));

        // 4. Verileri hazırla
        $data['user'] = $user;
        $data['is_mine'] = ($user->id == $this->session->userdata('user_id')); // Ben miyim kontrolü
        $data['posts'] = $this->Post_model->get_posts_by_user($user->id);

        $this->load->view('profile_view', $data);
    }
    // Profil Fotoğrafı Güncelleme İşlemi
    public function update_photo()
    {
        $user_id = $this->session->userdata('user_id');

        // Feed.php'de çalışan yapının aynısı
        $upload_path = FCPATH . 'uploads/profiles/';

        // Klasör kontrolü ve oluşturma
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        // Upload ayarları
        $config['upload_path']   = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048; // 2MB
        $config['encrypt_name']  = TRUE;

        // Kütüphaneyi yükle ve ayarları zorla tanıt (initialize)
        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload('profile_image')) {
            $upload_data = $this->upload->data();
            $new_image = $upload_data['file_name'];

            // Eski fotoğrafı sil (varsayılan değilse)
            $old_image = $this->session->userdata('profile_pic');
            if ($old_image && $old_image != 'default_avatar.png') {
                $old_file_path = $upload_path . $old_image;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
            }

            // Veritabanı ve Session güncelleme
            $this->load->model('User_model');
            $this->User_model->update_profile_pic($user_id, $new_image);
            $this->session->set_userdata('profile_pic', $new_image);

            $this->session->set_flashdata('success', 'Profil fotoğrafınız başarıyla güncellendi.');
        } else {
            // Hata durumunda mesajı gönder
            $error_msg = $this->upload->display_errors('', '');
            $this->session->set_flashdata('error', 'Yükleme Hatası: ' . $error_msg);
        }

        redirect('profile');
    }
}
