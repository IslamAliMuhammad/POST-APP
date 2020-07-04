<?php require APPROOT . '/views/inc/header.php' ?>
    <?php require APPROOT . '/views/inc/navbar.php' ?>
    <div class='container'>
        <div class='card card-body bg-light'>
            <a href="<?php echo URLROOT . '/posts/index';?>" class="mb-4">
                <i class="fas fa-arrow-circle-left fa-2x"></i>
            </a>
            <h2 class='card-title'>Add Post</h5>
            <p class='card-subtitle mb-2 text-muted'>Create a post with this form</p>
            <form action="<?php echo URLROOT . '/posts/add'; ?>" method="post">
                <div class="form-group">
                    <label for="inputTitle">Title <sup>*</sup></label>
                    <input name='title' type="text" class="form-control <?php echo(!empty($data['title_error']) ? 'is-invalid' : '');?>" id="inputTitle" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"><?php echo(!empty($data['title_error']) ? $data['title_error'] : ''); ?></span>
                </div>
                <div class="form-group">
                    <label for="inputBody">Body <sup>*</sup></label>
                    <textarea name="body" id="inputBody" class="form-control <?php echo(!empty($data['body_error']) ? 'is-invalid' : '');?>"><?php echo $data['body']; ?></textarea>
                    <span class="invalid-feedback"><?php echo(!empty($data['body_error']) ? $data['body_error'] : ''); ?></span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>