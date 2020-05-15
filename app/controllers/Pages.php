<?php
    class Pages extends Controller {
        public function __construct(){
            $this->postModel = $this->model('Post');
        }

        public function index(){
            $data = [
                'title'=> 'Welcome to title index'
            ];
            $this->view('pages/index', $data);
        }

        public function about(){
            $data = [
                'title'=> 'Welcome to title about'
            ];
            $this->view('pages/about', $data);
        }
    }
?>

