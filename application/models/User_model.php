<?php
class User_model extends CI_Model
{

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');

        if ($query->num_rows() == 1) {
            $user = $query->row();
            // PHP 7.4 güvenli şifre kontrolü
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }

    public function register($data)
    {
        return $this->db->insert('users', $data);
    }

    public function is_username_unique($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('users');
        return $query->num_rows() == 0; // Eğer 0 ise kullanıcı adı uygundur
    }
    // Kullanıcının profil fotoğrafı ismini günceller
    public function update_profile_pic($user_id, $image_name)
    {
        $this->db->where('id', $user_id);
        return $this->db->update('users', ['profile_pic' => $image_name]);
    }
    public function get_user_by_username($username)
    {
        return $this->db->get_where('users', array('username' => $username))->row();
    }
}
