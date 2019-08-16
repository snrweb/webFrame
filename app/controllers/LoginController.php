<?php 
    namespace App\Controllers;
    use Core\Controller;
    use Core\Router;
    use Core\Sanitise;
    use Core\Validation;
    use Core\Session;

    class LoginController extends Controller {

        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->loadModel('users');
            $this->loadModel('admin');
            $this->view->setLayout('default');
        }

        //Login to user admin area
        public function indexAction() {
            $this->view->user_name = $this->view->user_password = '';
            $this->view->user_name_error = $this->view->user_password_error = '';

            /** validate input*/
            if ($_POST) {

                $validate = new Validation();
                $validate->check('$_POST', [
                    'user_name' => ['display' => 'user name', 'required' => true],
                    'user_password' => ['display' => 'Password', 'required' => true]
                ]);

                /**Assign the input to values to the 
                 * corresponding Buyer class properties **/
                $this->UsersModel->assign($_POST);
                
                /**login user owner if vaidation is passed,
                 * user exist in the database and 
                 * password is correct**/
                if($validate->passed()) {
                    $user = $this->UsersModel->finduser();
                    
                    if(!empty($user)) {
                        if($user->user_name !== null && 
                            password_verify($this->UsersModel->user_password, $user->user_password)) {
                            $rememberMe = (isset($_POST['remember_me']) && Sanitise::get('remember_me')) ? true : false;

                            $this->UsersModel->user_id = $user->user_id; 
                            $this->UsersModel->login($rememberMe);
                            
                            Router::redirect('users/admin');
                        } else {
                            $this->view->password_error = '<span class="inputError">Password is incorrect</span>'; 
                        }
                    } else {
                        $this->view->user_name_error = 
                                '<span class="inputError">This user does not exist in the database</span>';
                    }
                } else {
                    $inputErrors = $validate->getErrors();
                    foreach($inputErrors as $inputError) {
                        $this->view->{$inputError[1].'_error'} = '<span class="inputError">'.$inputError[0].'</span>';
                    }
                }
            }

            $this->view->render('login/login');
        }

        
        public function adminLoginAction() {
            $this->view->csrf_token_error = '';
            if ($_POST) {
                $validate = new Validation();
                $validate->check('$_POST', [
                    'admin_password' => ['display' => 'Password', 'required' => true]
                ], true);
                if($validate->passed()) {
                    $result = $this->adminModel->findFirst(['conditions'=>'admin_username = ?', 'bind'=>[$_POST['admin_username']]]);
                    if(password_verify($_POST['admin_password'], $result->admin_password)) {
                        $this->adminModel->admin_id = $result->admin_id; 
                        $this->adminModel->admin_username = $result->admin_username; 
                        $this->adminModel->login();
                        Router::redirect('admin/');
                    } else {
                        Router::redirect('');
                    }
                } else {
                    $this->view->setFormErrors($validate->getErrors());
                }
            }
            $this->view->render('admin/login');
        }
    }
?> 