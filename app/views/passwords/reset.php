<?php require APPROOT . '/views/layouts/header.php'; ?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash('register_success'); ?>
            <h2>Code Verification</h2>
            <p>Enter the code sent to your email here.</p>
            <form action="<?php echo URLROOT; ?>/passwords/reset" method="post">
                <div class="form-group">
                    <label>Enter Code:<sup>*</sup></label>
                    <input type="number" name="code" class="form-control mb-4 <?php echo (!empty($data['code_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['code']; ?>">
                    <span class="invalid-feedback"><?php echo $data['code_err']; ?></span>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="submit" class="btn btn-success btn-block mt-4" value="Continue">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<?php require APPROOT . '/views/layouts/footer.php'; ?>