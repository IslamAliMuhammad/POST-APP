<?php 
    class Posts extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }
        public function index(){
            $posts = $this->postModel->getPosts();
            $data = [
                'posts' => $posts,
            ]; 
            $this->view('posts/index', $data);
        }

        public function add(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'user_id' => $_SESSION['user_id'],
                    'title_error' => '',
                    'body_error' => '',
                ];

                // VALIDATE DATA INPUTS
                if(empty($data['title'])){
                    $data['title_error'] = 'Please enter title';
                }

                if(empty($data['body'])){
                    $data['body_error'] = 'Please enter body text';
                }

                if(empty($data['title_error']) && empty($data['body_error'])){
                    $isPostAdded = $this->postModel->addPost($data);
                    if($isPostAdded){
                        flash('post_message', 'Post Added');
                        redirect('posts/index');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                    $this->view('posts/add', $data);
                }


            }else {
                $data = [
                    'title' => '',
                    'body' => ''
                ];
                $this->view('posts/add', $data);
            }
           
        }

        public function show($id){

            $post = $this->postModel->getPostByID($id);
            $user = $this->userModel->getUserByID($post->user_id);

            $data = [
                'post' => $post,
                'user' => $user,
            ];

            $this->view('posts/show', $data);
        }

        public function edit($id){
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'id' => $id,
                    'title' => trim($_POST['title']),
                    'body' => trim($_POST['body']),
                    'title_error' => '',
                    'body_error' => '',
                ];

                // VALIDATE DATA INPUT

                if(empty($data['title'])){
                    $data['title_error'] = 'Please enter title';
                }

                if(empty($data['body'])){
                    $data['body_error'] = 'Please enter body text';
                }

                if(empty($data['title_error']) && empty($data['body_error'])){
                    // update database
                    $isPostUpdated = $this->postModel->updatePost($data);

                    if($isPostUpdated){
                        flash('post_message', 'Post Updated');
                        redirect('post/index');
                    }else{
                        die('Somthing went wrong');
                    }
                }else{
                    $this->view('posts/edit', $data);
                }

            }else{
                $post = $this->postModel->getPostByID($id);

                if($_SESSION['user_id'] == $post->user_id){
                    $data = [
                        'id' => $id,
                        'title' => $post->title,
                        'body' => $post->body,
                    ];
                    $this->view('posts/edit', $data);
                }else{
                    redirect('posts/index');
                }
                
            }
           
        }

        public function delete($id){
            $post = $this->postModel->getPostByID($id);

            if($_SESSION['user_id'] != $post->user_id){
                redirect('posts/index');
            }
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                $isDeleted = $this->postModel->deletePost($id);

                if($isDeleted){
                    flash('post_message', 'Post Successfully Deleted');
                    redirect('posts/index');
                }else{
                    die('Something went wrong');
                }

            }else{
                redirect('posts/index');
            }
        }
    }
?>