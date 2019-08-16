<?php 
    namespace App\Controllers;
    use Core\Controller;
    use Core\Session;
    use Core\Router;

    /***
     * Logout any current user, either a User
     * or a store owner
     */
    class LogoutController extends Controller {

        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->loadModel('Users'); 
            $this->view->setLayout('default');
        }

        public function indexAction() {
            if(isLoggedIn()) {
                $this->UsersModel->logout();
                Router::redirect('');
            }
        }
    }
?> 