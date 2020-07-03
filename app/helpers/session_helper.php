<?php
    session_start();

    /**
     * FLASH - Consist of :
     *  - flashName stored in session and its corresponding message as a value
     *  - flashName_class stored in session and corresponding class as a value
     * 
     * How to use : 
     *  DECLARE AND initialize FLASH - flash('regiter_success', 'You are now registered and can log in', 'alert alert-danger' OPTIONAL)
     *  CALL FLASH - flash('regiter_success') return flash with proper message and proper class associated with flash name we passed to flash function 
     */
    function flash($name='', $message='', $class='alert alert-primary'){

        if(!empty($name) && !empty($message)){ // Declare and initalize flash in session
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;

        }elseif(!empty($name) && empty($message)){ // Call flash
            if(isset($_SESSION[$name]) && isset($_SESSION[$name . '_class'])){

                echo '<div class="' . $_SESSION[$name . '_class'] . '">' . $_SESSION[$name] . '</div>';
                unset($_SESSION[$name], $_SESSION[$name . '_class']);
            }   
        }
    }

    function isLoggedIn(){
        if(isset($_SESSION['user_id'])){
            return true;
        }else{
            return false;
        }
    }
?>