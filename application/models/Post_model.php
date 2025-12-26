<?php
class Post_model extends CI_Model
{

    public function get_all_posts()
    {
        $this->db->select('posts.*, users.username, users.full_name, users.profile_pic');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->order_by('posts.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function insert_post($data)
    {
        return $this->db->insert('posts', $data);
    }

    // Sadece belirli bir kullanıcının postlarını getirir (Profil Sayfası için)
    public function get_posts_by_user($user_id)
    {
        $this->db->select('posts.*, users.username, users.full_name, users.profile_pic');
        $this->db->from('posts');
        $this->db->join('users', 'users.id = posts.user_id');
        $this->db->where('posts.user_id', $user_id); // Filtreleme burada yapılıyor
        $this->db->order_by('posts.created_at', 'DESC');
        return $this->db->get()->result();
    }
}
