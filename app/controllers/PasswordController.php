<?php
    namespace App\Controllers;
    use Core\Controller;
    use Core\Validation;
    use Core\Sanitise;
    use Core\Router;
    use App\Libs\Email;
    use App\Libs\EmailLayout;

    class PasswordController extends Controller {
        private $email; 
        public function __construct($controller, $action) {
            parent::__construct($controller, $action);
            $this->loadModel('users');
            $this->view->setLayout('user');
            $this->email = new Email();
        }

        public function forgotAction($userType) {
            $this->view->urlParams = $userType;
            $code = md5(uniqid(true));

            if($_POST) {
                $this->userForgotPassword($code);
            }

            $this->view->render('password/forgot');
        }

        private function userForgotPassword($code) {
            $validate = new Validation();
            $validate->check('$_POST', [
                'user_name' => ['display'=>'username', 'required'=>true, 'isuserName'=>true]
            ]);

            if($validate->passed()) {
                $this->UsersModel->username = sanitise::get('user_name');
                $result = $this->UsersModel->finduser();
                if(!empty($result) && $this->UsersModel->updateRetrieveCode($code) == true) {
                    $this->email->setEmailSubject('Password Reset Link');
                    $this->email->setRecipientEmail($result->email);
                    $content = EmailLayout::passwordLayout('user', $code, str_replace(' ', '-', sanitise::get('user_name')));
                    $this->email->setEmailContent($content);
                    
                    if($this->email->sendEmail()) return $this->view->success ='A reset link has been sent to your email';
                    return $this->view->danger ='There was connection error';
                } 
                return $this->view->danger ='user name does not exist in the database';
            } 
            return $this->view->danger ='Enter a valid user name';
        }

        public function ResetAction($userType, $code='', $email='') {
            $this->view->type = $userType; 
            $this->view->code = $code; 
            $this->view->email = $email; 
            if($_POST) {
                $validate = new Validation();
                $validate->check('$_POST', [
                    'password_one' => ['display' => 'Password', 'min' => 8, 'required' => true]
                ]);
                    
                if($validate->passed()) {
                    $password = Sanitise::get('password_one');
                    $confirm_password = Sanitise::get('password_two');

                    if($password === $confirm_password) {
                        $this->UsersModel->password = password_hash($password, PASSWORD_DEFAULT); 
                        $this->UsersModel->username = str_replace('-', ' ', $email); //$email = user name
                        $this->UsersModel->pwd_retrieve = '';
                        $registered = $this->UsersModel->resetPassword();    
                        
                        ($registered) ? Router::redirect('login') : $this->view->danger = 'Error encountered'; 
                    } 
                    $this->view->danger = 'Password does not match';
                }
                $this->view->danger = 'Password should not be less than 8 characters';
            }
            
            $this->view->render('password/reset');
        }


    }

?>