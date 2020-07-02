<?php 
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // Sanitize form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $formData = [
                    'userName' => trim($_POST['userName']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirmPassword' => trim($_POST['confirmPassword']),
                    'userNameError' => '',
                    'emailError' => '',
                    'passwordError' => '',
                    'confirmPasswordError' => '',
                ];

                // Validate form inputs
                if(empty($formData['userName'])){
                    $formData['userNameError'] = 'Please enter user name';
                }

                if(empty($formData['email'])){
                    $formData['emailError'] = 'Please enter your email';
                }else{
                    $user = $this->userModel->findUserByEmail($formData['email']);
                    $formData['emailError'] = $user ? 'Email is already taken' : '';
                }

                if(empty($formData['password'])){
                    $formData['passwordError'] = 'Please enter password';
                }elseif(strlen($formData['password']) < 6){
                    $formData['passwordError'] = 'Password must be at least 6 characters';
                }

                if(empty($formData['confirmPassword'])){
                    $formData['confirmPasswordError'] = 'Please enter confirm passworm';
                }elseif($formData['password'] != $formData['confirmPassword']){
                    $formData['confirmPasswordError'] = 'Passwords do not match';
                }
                
                if(empty($formData['userNameError']) && empty($formData['emailError']) && empty($formData['passwordError']) && empty($formData['confirmPasswordError'])){


                    $formData['password'] = password_hash($formData['password'], PASSWORD_DEFAULT);
                    $isRegistered = $this->userModel->registerUser($formData);
                    if($isRegistered){
                        flash('register_success', 'You are now registered and can log in');
                        redirect('users/login');
                    }

                }else {
                    $this->view('users/register', $formData);
                }
            }else{
                $formData = [
                    'userName' => '',
                    'email' => '',
                    'password' => '',
                    'confirmPassword' => '',
                ];
                $this->view('users/register', $formData);
            }

        } 

        public function login(){
            // Sanitize form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $formData = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passwordError' => '',
                ];

                // Validate form inputs

                if(empty($formData['email'])){
                    $formData['emailError'] = 'Please enter your email';
                }else{
                    $user = $this->userModel->findUserByEmail($formData['email']);
                    if(!$user){
                        $formData['emailError'] = 'No user found';
                    }
                }

                if(empty($formData['password'])){
                    $formData['passwordError'] = 'Please enter password';
                }
              
                if(empty($formData['emailError']) && empty($formData['passwordError'])){
                    $userLoggedIn = $this->userModel->loginUser($formData['email'], $formData['password']);
                    if($userLoggedIn){
                        $this->createUserSession($userLoggedIn);
                        redirect('pages/index');
                    }else{
                        $formData['passwordError'] = 'Password incorrect';
                        $this->view('users/login', $formData);
                    }
                }else {
                    $this->view('users/login', $formData);
                }
            }else{
                $formData = [
                    'email' => '',
                    'password' => '',
                ];
                $this->view('users/login', $formData);
            }

        } 

        public function createUserSession($user){
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_name'] = $user->name;
            $_SESSION['user_email'] = $user->email;
        }
        
        public function logout(){
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();
            redirect('users/login');
        }
    }
?>