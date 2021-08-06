<?php
class Passwords extends Controller
{

    public function __construct()
    {
        $this->userModel = $this->model('User');
        $this->passwordModel = $this->model('Password');
    }


    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'email_err' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter an email';
            } else {
                // Check Email
                if ($this->userModel->findUserEmailExist($data['email'])) {

                    //User exist
                } else {
                    $data['email_err'] = 'Email does not exit.';
                }
            }

            if (empty($data['email_err'])) {
                $code = rand(999999, 111111);
                $insert_code = $this->passwordModel->updateCode($data['email'], $code);

                if ($insert_code) {
                    $subject = "Password Reset Code";
                    $message = "Your password reset code is $code";
                    $sender = "info@officiallife.com";
                    if (mail($data['email'], $subject, $message, $sender)) {
                        flash('register_success', 'We have sent a password reset otp to your email');
                        $this->createEmailSession($insert_code);
                        redirect('passwords/reset');
                    } else {
                        $data['email_err'] = "Failed while sending code!";
                        $this->view('passwords/index', $data);
                    }
                } else {
                    $data['email'] = "Something went wrong!";
                    $this->view('passwords/index', $data);
                }
            } else {
                // Load view with errors
                $this->view('passwords/index', $data);
            }
        } else {
            $data = [
                'email' => '',
                'email_err' => ''
            ];


            $this->view('passwords/index', $data);
        }
    }

    // Load the reset view
    public function reset()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('passwords/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'code' => trim($_POST['code']),
                'code_err' => ''
            ];

            // Validate code
            if (empty($data['code'])) {
                $data['code_err'] = 'Please enter the verification code';
            }

            if (empty($data['code_err'])) {

                $code_verification = $this->passwordModel->reset($data['code']);

                if ($code_verification) {
                    flash('register_success', 'Please Reset your password');
                    $this->createEmailSession($code_verification);
                    redirect('passwords/newPassword');
                } else {
                    $data['code_err'] = "You've entered incorrect code!";
                    $this->view('passwords/reset', $data);
                }
            } else {
                //load view with error
                $this->view('passwords/reset', $data);
            }
        } else {

            $data = [
                'code' => '',
                'code_err' => ''
            ];

            $this->view('passwords/reset', $data);
        }
    }

    // view for the changing the password
    public function newPassword()
    {
        if (!isset($_SESSION['user_email'])) {
            redirect('passwords/index');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter a password.';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must have atleast 6 characters.';
            }

            // Validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password.';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Password do not match.';
                }
            }



            if (empty($data['password_err']) && empty($data['confirm_password_err'])) {

                // hash the password if the password and confirm password is the same
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $code = 0;
                $email = $_SESSION['user_email'];


                //getting this email using session
                if ($this->passwordModel->updatePassword($data['password'], $code, $email)) {
                    flash('register_success', 'Your password changed. Now you can login with your new password.');
                    redirect('users/login');
                } else {
                    $data['password_err'] = "Failed to change your password!";
                }
            } else {
                $this->view('passwords/new-password', $data);
            }
        } else {
            $data = [
                'password' => '',
                'confirm_password' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('passwords/new-password', $data);
        }
    }

    // Create Session With User Info
    public function createEmailSession($user)
    {
        // $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        // $_SESSION['user_name'] = $user->name;
        $_SESSION['user_code'] = $user->code;
    }
}
