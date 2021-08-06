<?php require APPROOT . '/views/layouts/header.php'; ?>
<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">

                <form method="post" id="contact-form">
        
                    <div class="pt-5 px-5">
                        <h3 class="text-center mb-1">Contact</h3>
                        <p class="alert text-center form-message"></p>
                        <div class="mb-3">
                            <label for="name" class="form-label" class="text-light">Name</label>
                            <input type="text" name="name" class="form-control" id="contact-name" aria-describedby="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" class="text-light">Email</label>
                            <input type="email" name="mail" class="form-control" id="contact-mail" aria-describedby="email">

                        </div>
                        <div class="mb-3">
                            <label for="subject" class="form-label" class="text-light">Subject</label>
                            <input type="text" name="subject" class="form-control" id="contact-subject" aria-describedby="subject" id="contact-subject">

                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="contact-message" rows="3"></textarea>

                        </div>
                        <div class="">
                            <button type="submit" name="submit" id="contact-submit" class="btn btn-primary text-light">Submit</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/layouts/footer.php'; ?>