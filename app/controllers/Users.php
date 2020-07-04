<?php 
    class Users extends Controller {
        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // Sanitize form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = [
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
                if(empty($data['userName'])){
                    $data['userNameError'] = 'Please enter user name';
                }

                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter your email';
                }else{
                    $user = $this->userModel->findUserByEmail($data['email']);
                    $data['emailError'] = $user ? 'Email is already taken' : '';
                }

                if(empty($data['password'])){
                    $data['passwordError'] = 'Please enter password';
                }elseif(strlen($data['password']) < 6){
                    $data['passwordError'] = 'Password must be at least 6 characters';
                }

                if(empty($data['confirmPassword'])){
                    $data['confirmPasswordError'] = 'Please enter confirm passworm';
                }elseif($data['password'] != $data['confirmPassword']){
                    $data['confirmPasswordError'] = 'Passwords do not match';
                }
                
                if(empty($data['userNameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])){


                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                    $isRegistered = $this->userModel->registerUser($data);
                    if($isRegistered){
                        flash('register_success', 'You are now registered and can log in');
                        redirect('users/login');
                    }

                }else {
                    $this->view('users/register', $data);
                }
            }else{
                $data = [
                    'userName' => '',
                    'email' => '',
                    'password' => '',
                    'confirmPassword' => '',
                ];
                $this->view('users/register', $data);
            }

        } 

        public function login(){
            // Sanitize form data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'emailError' => '',
                    'passwordError' => '',
                ];

                // Validate form inputs

                if(empty($data['email'])){
                    $data['emailError'] = 'Please enter your email';
                }else{
                    $user = $this->userModel->findUserByEmail($data['email']);
                    if(!$user){
                        $data['emailError'] = 'No user found';
                    }
                }

                if(empty($data['password'])){
                    $data['passwordError'] = 'Please enter password';
                }
              
                if(empty($data['emailError']) && empty($data['passwordError'])){
                    $userLoggedIn = $this->userModel->loginUser($data['email'], $data['password']);
                    if($userLoggedIn){
                        $this->createUserSession($userLoggedIn);
                        redirect('posts/index');
                    }else{
                        $data['passwordError'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }
                }else {
                    $this->view('users/login', $data);
                }
            }else{
                $data = [
                    'email' => '',
                    'password' => '',
                ];
                $this->view('users/login', $data);
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