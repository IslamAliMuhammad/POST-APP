<?php 
    class Post{
        private $db;

        public function __construct(){
            $this->db = new Database();
        }

        public function getPosts(){
            $this->db->query('SELECT *, posts.id as postID, users.id as userID, posts.created_at as postCreatedAt, users.created_at as userCreatedAt FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at');
            $posts = $this->db->resultSet();
            return $posts;
        }

        public function addPost($data){
            $this->db->query('INSERT INTO posts (user_id, title, body) VALUE (:user_id, :title, :body)');

            $this->db->bind(':user_id', $data['user_id']);
            $this->db->bind(':title', $data['title']);
            $this->db->bind(':body', $data['body']);

            return $this->db->execute();
        }   
    }
?>