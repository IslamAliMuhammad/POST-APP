<?php require APPROOT . '/views/inc/header.php' ?>
<?php require APPROOT . '/views/inc/navbar.php' ?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class='card card-body bg-light'>
                <a href="<?php echo URLROOT . '/posts/index';?>" class="mb-4">
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
                <h1 class='card-title'><?php echo $data['post']->title; ?></h1>
                <p class='card-subtitle text-muted mb-2 lead'>
                    <?php echo 'Written by ' . $data['user']->name . ' on ' . $data['post']->created_at;  ?></p>
                <p><?php echo $data['post']->body; ?></p>

                <?php if($data['post']->user_id == $_SESSION['user_id']) { ?>
                <div class="row mt-5">
                    <div class="col-6">
                        <a class="btn btn-primary" href="<?php echo URLROOT . '/posts/edit/' . $data['post']->id; ?>">
                            <i class="fas fa-edit fa-lg"> Edit</i>
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-primary float-right" href="<?php echo URLROOT . '/posts/delete/' . $data['post']->id; ?>">
                            <i class="fas fa-trash-alt fa-lg"> Delete</i>
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>