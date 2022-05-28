<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class User extends CI_Model {
	 
		public function reg_insert($data) {
			$this->db->insert('bz_user', $data);
			return $this->db->insert_id();
		}
		
		public function query_user() {
			$query = $this->db->order_by('user_id', 'desc');
			$query = $this->db->get('bz_user');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function check_by_username($user) {
			$query = $this->db->get_where('bz_user', array('username' => $user));
			return $query->num_rows();
		}
		
		public function check_by_email($email) {
			$query = $this->db->get_where('bz_user', array('email' => $email));
			return $query->num_rows();
		}
		
		public function check_user($email, $pass) {
			$query = $this->db->get_where('bz_user', array('email' => $email, 'password' => $pass));
			return $query->num_rows();
		}
		
		public function check_redundant($fname, $lname, $username) {
			$query = $this->db->get_where('bz_user', array('firstname' => $fname, 'lastname' => $lname, 'username' => $username));
			return $query->num_rows();
		}
		
		public function check_auth($user, $pass) {
			$query = $this->db->query("SELECT * FROM bz_user WHERE (username='$user' OR email='$user') AND password='$pass' LIMIT 1");
			if($query->num_rows() > 0) {
				return $query->result();
			}	
		}
		
		public function check_activation($stamp, $email) {
			$query = $this->db->get_where('bz_user', array('regstamp' => $stamp, 'email' => $email));
			return $query->num_rows();	
		}
		
		public function query_user_id($data) {
			$query = $this->db->where('user_id', $data);
			$query = $this->db->get('bz_user');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_search_all() {
			$query = $this->db->order_by('relevance', 'desc');
			$query = $this->db->get('bz_book');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_search($pub_id, $author_id, $dept_id, $data) {
			$query = $this->db->where('pub_id', $pub_id);
			$query = $this->db->or_where('author_id', $author_id);
			$query = $this->db->or_where('dept_id', $dept_id);
			$query = $this->db->or_where('title LIKE', '%'.$data.'%');
			$query = $this->db->or_where('details LIKE', '%'.$data.'%');
			$query = $this->db->or_where('doc LIKE', '%'.$data.'%');
			$query = $this->db->order_by('relevance', 'desc');
			$query = $this->db->get('bz_book');
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function activate($email, $data) {
			$this->db->where('email', $email);
			$this->db->update('bz_user', $data);
			return $this->db->affected_rows();	
		}
		
		public function update_user($id, $data) {
			$this->db->where('user_id', $id);
			$this->db->update('bz_user', $data);
			return $this->db->affected_rows();	
		}
		
		public function delete_user($id) {
			$this->db->where('user_id', $id);
			$this->db->delete('bz_user');
			return $this->db->affected_rows();
		}
		
		//GENERICS
		////////// create ////////
		public function reg_rec($table, $data) {
			$this->db->insert($table, $data);
			return $this->db->insert_id();
		}
		
		//////////// read /////////
		public function query_rec($table) {
			$query = $this->db->get($table);
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_rec_single($field, $value, $table) {
			$query = $this->db->where($field, $value);
			$query = $this->db->get($table);
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		public function query_rec_double($field, $value, $field2, $value2, $table) {
			$query = $this->db->where($field, $value);
			$query = $this->db->where($field2, $value2);
			$query = $this->db->get($table);
			if($query->num_rows() > 0) {
				return $query->result();
			}
		}
		
		///////////// update ////////////////
		public function update_rec($field, $value, $table, $data) {
			$this->db->where($field, $value);
			$this->db->update($table, $data);
			return $this->db->affected_rows();	
		}
		
		///////////// delete ///////////////////
		public function delete_rec($field, $value, $table) {
			$this->db->where($field, $value);
			$this->db->delete($table);
			return $this->db->affected_rows();	
		}
	}