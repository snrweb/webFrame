<?php 
    namespace App\Controllers;
    use Core\Controller;
    use Core\Session;

    class HomeController extends Controller {
        
        /********************
         * Call the extended controller construct to 
         * instatiate the view object
         */
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);

            $this->loadModel('Admin');
        }

        /***********
         * The default action if no action is provided
         */
        public function indexAction() {

            
            $this->view->render('home/index');
        }
    }
?>