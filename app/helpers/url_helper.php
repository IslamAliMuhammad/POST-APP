<?php 

    /**
     * Redirect to page passed as an argument
     * Input Parameter Format - 'controller/method'
     */
    function redirect($page){
        header('location: ' . URLROOT . '/' . $page);
    }
    
?>