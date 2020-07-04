<?php require APPROOT . '/views/inc/header.php' ?>
    <?php require APPROOT . '/views/inc/navbar.php' ?>
    <div class='container'>
        <?php flash('post_message'); ?>
        <div class='row mb-4'>
            <div class='col-md-6'>
                <h1>Posts</h1>
            </div>
            <div class='col-md-6'>
                <a href="<?php echo URLROOT . '/posts/add'; ?>" class='btn btn-primary float-right'>
                    <i class="fas fa-pencil-alt">Add Post</i> 
                </a>
            </div>
        </div>
        <?php foreach ($data['posts'] as $post) { ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $post->title;?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Written by <?php echo $post->name; ?> on <?php echo $post->postCreatedAt; ?></h6>
                    <p class="card-text"><?php echo $post->body; ?></p>
                    <a href="<?php echo URLROOT . '/posts/show/' . $post->postID; ?>" class="card-link">More</a>
                </div>
            </div>
        <?php } ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>