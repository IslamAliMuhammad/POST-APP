<?php
    /* 
     * App Core Class
     * Extract controller, method, params from URL then load the controller and execute the method with the params
     * URL FORMAT - /controller/method/params
     */
    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct(){
            
            // Extract Controller from URL
            $url = $this->getUrl();
            if(isset($url[0])){
                if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
                    $this->currentController = ucwords($url[0]);
                    unset($url[0]);
                }
            }

            require_once '../app/controllers/' . $this->currentController . '.php';
            
            $this->currentController = new $this->currentController();

              // Extract method from URL
              if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // Extract params from 
            $this->params = $url ? array_values($url) : [];
        
            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                $url = filter_var($url, FILTER_SANITIZE_URL);
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>