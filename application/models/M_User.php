<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_User extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }
    
    function auth($username,$password)
    {
        $query = $this->db->get_where('user', array('username' => $username,'password' => $password));
        return $query->result();
    }

    function getDataDokumentasi($iduser)
    {
        $query = $this->db->get_where('dokumentasi', array('user_iduser' => $iduser));
        return $query->result();
    }

    function insertDataDokumentasi($data)
    {
        $query = $this->db->insert('dokumentasi', $data);
        return $query;
    }
    function insertDataMahasiswa($data)
    {
        $query = $this->db->insert('mahasiswa', $data);
        return $query;
    }
    function getDataMahasiswa($iduser)
    {
        $query = $this->db->get_where('mahasiswa', array('user_iduser' => $iduser));
        return $query->result();
    }

}
