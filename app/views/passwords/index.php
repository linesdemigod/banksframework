<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2>Forgot Password</h2>
            <p>Enter your email to reset password.</p>
            <form action="<?php echo URLROOT; ?>/passwords/index" method="post">
                <div class="form-group">
                    <label>Email:<sup>*</sup></label>
                    <input type="email" name="email" class="form-control mb-4 <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-block mt-4" value="Continue">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-light btn-block ">Do you have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php require APPROOT . '/views/layouts/footer.php'; ?>