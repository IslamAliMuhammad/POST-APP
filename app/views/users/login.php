<?php require APPROOT . '/views/inc/header.php' ?>
    <?php require APPROOT . '/views/inc/navbar.php' ?>
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                <form action="<?php echo URLROOT;?>/users/login" method="post">
                    <?php flash('register_success'); ?>
                    <div class="form-group">
                        <label for="emailInput">Email address *</label>
                        <input type="email" name="email" value="<?php echo $data['email']; ?>" class="form-control  <?php echo(!empty($data['emailError']) ? 'is-invalid' : '') ?>" id="emailInput">
                        <span class="invalid-feedback"><?php  echo(!empty($data['emailError']) ? $data['emailError'] : '') ?></span>
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">Password *</label>
                        <input type="password" name="password" value="<?php echo $data['password']; ?>" class="form-control  <?php echo(!empty($data['passwordError']) ? 'is-invalid' : '') ?>" id="passwordInput">
                        <span class="invalid-feedback"><?php  echo(!empty($data['passwordError']) ? $data['passwordError'] : '') ?></span>
                    </div>
        
                   <div class="container">
                       <div class="row">
                            <button type="submit" class="btn btn-primary col">Login</button>
                            <a class="col text-center" href="<?php echo URLROOT;?>/users/register">No account? Register</a>
                       </div>
                   </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>