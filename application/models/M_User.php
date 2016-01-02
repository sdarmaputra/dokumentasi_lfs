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
    function deleteDataDokumentasi($idDokumentasi)
    {
        $this->db->where('idDokumentasi', $idDokumentasi);
        $query = $this->db->delete('dokumentasi');
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
    function deleteDataMahasiswa($nrp)
    {
        $this->db->where('nrp', $nrp);
        $query = $this->db->delete('mahasiswa');
        return $query;   
    }
    function getDaftarKelas() {
        $this->db->select('kelas');
        $this->db->group_by('kelas');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }

    function getUserByKelas($kelas) {
        $this->db->select('iduser, username');
        $query = $this->db->get_where('user', array('kelas' => $kelas));
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else return false;
    }
    function getById($iduser) {
        $this->db->limit(1);
        $query = $this->db->get_where('user', array('iduser' => $iduser));
        if ($query) {
            return $query->row_array();
        }
    }

}
