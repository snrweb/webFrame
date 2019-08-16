<?php
    namespace App\Models;
    use Core\Model;
    use Core\Session;
    use Core\Cookie;

    class Admin extends Model {
        public $terms, $about, $admin_id, $admin_username, $admin_name, $created_at, $csrf_token;

        public function __construct() {
            $table = 'admin';
            parent::__construct($table);
            
        }

        public function login() {
            Session::set(ADMIN_SESSION_NAME, $this->admin_id);
            Session::set('admin_username', $this->admin_username);
        }
        
        public function updateTerms() {
            return $this->update('id', 1, [
                'terms' => $this->terms
                ]
            );
        }

        public function getTerms() {
            return $this->findById('id', 1)->terms;
        }


        public function updateAbout() {
            return $this->update('id', 1, [
                'about' => $this->about
                ]
            );
        }

        public function getAbout() {
            return $this->findById('id', 1)->about;
        }
        
    }

?>