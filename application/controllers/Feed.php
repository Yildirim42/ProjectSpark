<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Feed extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Oturum kontrolü
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Post_model');
    }

    public function index()
    {
        $data['posts'] = $this->Post_model->get_all_posts();
        $this->load->view('feed_view', $data);
    }

    public function create_post()
    {
        $content = $this->input->post('content');
        $user_id = $this->session->userdata('user_id');


        $upload_path = FCPATH . 'uploads/posts/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0777, TRUE);
        }

        $media_path = NULL;
        $media_type = 'text';


        if (!empty($_FILES['userfile']['name'])) {

            // Upload Ayarları
            $config['upload_path']   = $upload_path;
            $config['allowed_types'] = 'jpg|jpeg|png|mp4|mov|avi|mkv';
            $config['max_size']      = 102400; // 100 MB
            $config['encrypt_name']  = TRUE; // Dosya ismini rastgele şifrele

            $this->load->library('upload');
            $this->upload->initialize($config); // Ayarları yükle

            if ($this->upload->do_upload('userfile')) {
                // Yükleme Başarılı
                $upload_data = $this->upload->data();
                $media_path = $upload_data['file_name'];

                // Dosya tipini belirle
                $ext = pathinfo($media_path, PATHINFO_EXTENSION);
                $video_exts = ['mp4', 'mov', 'avi', 'mkv'];

                if (in_array(strtolower($ext), $video_exts)) {
                    $media_type = 'video';
                } else {
                    $media_type = 'image';
                }
            } else {
                $this->session->set_flashdata('error', 'Dosya yüklenemedi: ' . $this->upload->display_errors('', ''));
                redirect('feed');
                return;
            }
        }

        $this->load->model('Post_model');
        $data = array(
            'user_id'    => $user_id,
            'content'    => $content,
            'media_path' => $media_path,
            'media_type' => $media_type
        );

        if ($this->Post_model->insert_post($data)) {
            redirect('feed');
        } else {
            $this->session->set_flashdata('error', 'Veritabanı hatası oluştu.');
            redirect('feed');
        }
    }
}
