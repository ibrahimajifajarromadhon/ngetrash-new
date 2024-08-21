<?php

class Madmin extends CI_Model{

    public function save_admin($data) {
        $this->db->insert('tbl_admin', $data);
    }

	public function save_user($data) {
        $this->db->insert('tbl_user', $data);
    }

	public function save_petugas($data) {
        $this->db->insert('tbl_petugas', $data);
    }

	public function cek_login_admin($u, $p){
		$query = $this->db->get_where('tbl_admin', array('userName' => $u ));
		$check = $query->num_rows();
		$account = $query->row_object();
		$hash = $account->password;
			if($check == 1){
				if(password_verify($p, $hash)){
					return array(
						'loggedIn' => true, 
						'idAdmin' => $account->idAdmin
					);
				}
			}
			return array(
				'loggedIn' => false, 
				'idAdmin' => $account->idAdmin
			);
	}

	public function cek_login_petugas($u, $p){
		$query = $this->db->get_where('tbl_petugas', array('userName' => $u ));
		$check = $query->num_rows();
		$account = $query->row_object();
		$hash = $account->password;
			if($check == 1){
				if(password_verify($p, $hash)){
					return array(
						'loggedIn' => true, 
						'idPetugas' => $account->idPetugas,
						'name' => $account->name
					);
				}
			}
			return array(
				'loggedIn' => false, 
				'idPetugas' => $account->idPetugas
			);
	}

	public function cek_login_user($u, $p){
		$query = $this->db->get_where('tbl_user', array('userName' => $u, 'statusAktif' => 'Y' ));
		$check = $query->num_rows();
		$account = $query->row_object();
		$hash = $account->password;
			if($check == 1){
				if(password_verify($p, $hash)){
					return array(
						'loggedIn' => true, 
						'idUser' => $account->idUser
					);
				}
			}
			return array(
				'loggedIn' => false, 
				'idUser' => $account->idUser
			);
	}

	public function get_all_data($tabel){
		$q=$this->db->get($tabel);
		return $q;
	}

	public function count_all_data($table) {
		return $this->db->count_all($table);
	}

	public function get_data_paginated($table, $limit, $offset, $sort) {
		$this->db->order_by($sort, 'DESC');
		$this->db->limit($limit, $offset);
		return $this->db->get($table);
	}

	public function get_by_id($tabel, $id){
		return $this->db->get_where($tabel, $id);
	}

	public function insert($tabel, $data){
		$this->db->insert($tabel, $data);
	}

	public function update($tabel, $data, $pk, $id){
		$this->db->where($pk, $id);
		$this->db->update($tabel, $data);
	}

	public function delete($tabel, $id, $val){
		$this->db->delete($tabel, array($id => $val));
	}

	public function get_petugas($petugas) {
        $this->db->where('idPetugas', $petugas);
        return $this->db->get('tbl_petugas')->result();
    }

	public function check_existing_scan($idUser, $date)
    {
        $this->db->where('idUser', $idUser);
        $this->db->where('DATE(tanggal)', $date);
        $query = $this->db->get('tbl_status_pengambilan');
        return $query->num_rows() > 0;
    }
}
?>