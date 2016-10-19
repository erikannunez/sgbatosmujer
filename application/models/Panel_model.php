<?php
class Panel_model extends CI_Model {
   public function __construct() {
      parent::__construct();
   }
   public function userLogin($username, $password){

      $this->db->select('id, username, roleID');
      $this->db->from('system_users');
      $this->db->where('username', $username);
      $this->db->where('pass', $password);

      $query = $this->db->get();

      return $query->row();
   }

   public function userRecover($email){
      $this->db->select('id, username, roleID');
      $this->db->from('system_users');
      $this->db->where('mail', $email);

      $query = $this->db->get();

      return $query->row();
   }
}