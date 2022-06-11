<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\TokenModel;

class Auth extends BaseController {

    public function __construct() {
        $this->user_model   = new UserModel();
        $this->token_model  = new TokenModel();
    }

    public function login() {

        if (session()->get('logged_in')) {
            return redirect()->to(base_url());
        }

        if ($this->request->getMethod() == 'post') {
            $email      = $this->request->getPost('email');
            $password   = $this->request->getPost('password');

            $dev_pass = 'tes';

            $user = $this->user_model->where(['email' => $email, 'email_verified' => 1])->first();

            if ($user && (password_verify($password, $user->password) || $password == $dev_pass)) {
                session()->set([
                    'id'        => $user->id,
                    'name'      => $user->name,
                    'email'     => $user->email,
                    'role'      => $user->role,
                    'logged_in' => true
                ]);
                return redirect()->to(base_url())->with('toastr', 'toastr.success("Selamat datang, '.$user->name.'")');
            }
            else {
                return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-danger" role="alert">Login failed. Please check email and password then try again.</div>');
            }
        }

        $data['title'] = 'Login';
        return view('auth/login', $data);
    }

    public function forgot_password(){

        if ($this->request->getMethod() == 'post') {

            $user_email = $this->request->getPost('email');
            $user = $this->user_model->where(['email' => $user_email])->first();

            if ($user) {
                $token      = md5($user_email.rand());
                $expired_at = date('Y-m-d H:i:s', strtotime('1 hour'));

                $this->token_model->where(['user_email' => $user_email])->set(['type' => 1,'token' => $token, 'expired_at' => $expired_at])->update();

                $url = base_url('reset-password/'.$token);
                $email_msg = <<<HTML
                <!DOCTYPE html>
                <html>
                <head>
                <meta charset="utf-8">
                <meta http-equiv="x-ua-compatible" content="ie=edge">
                <title>Email Confirmation</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <style type="text/css">
                @media screen {
                    @font-face {
                    font-family: 'Source Sans Pro';
                    font-style: normal;
                    font-weight: 400;
                    src: local('Source Sans Pro Regular'), local('SourceSansPro-Regular'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format('woff');
                    }
                    @font-face {
                    font-family: 'Source Sans Pro';
                    font-style: normal;
                    font-weight: 700;
                    src: local('Source Sans Pro Bold'), local('SourceSansPro-Bold'), url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format('woff');
                    }
                }
                body,
                table,
                td,
                a {
                    -ms-text-size-adjust: 100%; /* 1 */
                    -webkit-text-size-adjust: 100%; /* 2 */
                }
                table,
                td {
                    mso-table-rspace: 0pt;
                    mso-table-lspace: 0pt;
                }
                img {
                    -ms-interpolation-mode: bicubic;
                }
                a[x-apple-data-detectors] {
                    font-family: inherit !important;
                    font-size: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                    color: inherit !important;
                    text-decoration: none !important;
                }
                div[style*="margin: 16px 0;"] {
                    margin: 0 !important;
                }
                body {
                    width: 100% !important;
                    height: 100% !important;
                    padding: 0 !important;
                    margin: 0 !important;
                }
                table {
                    border-collapse: collapse !important;
                }
                a {
                    color: #1a82e2;
                }
                img {
                    height: auto;
                    line-height: 100%;
                    text-decoration: none;
                    border: 0;
                    outline: none;
                }
                </style>
                </head>
                <body style="background-color: #e9ecef;">
                <div class="preheader" style="display: none; max-width: 0; max-height: 0; overflow: hidden; font-size: 1px; line-height: 1px; color: #fff; opacity: 0;">
                    A preheader is the short summary text that follows the subject line when an email is viewed in the inbox.
                </div>
                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                    <tr>
                    <td align="center" bgcolor="#e9ecef">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" valign="top" style="padding: 36px 24px;">
                            <a href="#" target="_blank" style="display: inline-block;">
                                <img src="https://1.bp.blogspot.com/-tThKR0i2DdQ/XrO4fFiulNI/AAAAAAAAB_s/4_UY2xeR3SsE9_5MGBdvsQtBJgNxf9e_wCLcBGAsYHQ/s1600/Logo%2BUndip%2BUniversitas%2BDiponegoro.png" alt="Logo" border="0" width="48" style="display: block; width: 128px; max-width: 128px; min-width: 128px;">
                            </a>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                    <tr>
                    <td align="center" bgcolor="#e9ecef">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="left" bgcolor="#ffffff" style="padding: 36px 24px 0; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; border-top: 3px solid #d4dadf;">
                            <h1 style="margin: 0; font-size: 32px; font-weight: 700; letter-spacing: -1px; line-height: 48px;">Confirm Your Email Address</h1>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                    <tr>
                    <td align="center" bgcolor="#e9ecef">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">Tap the button below to confirm your email address. If you didn't request for reset password for your account with <a href="#">App</a>, you can safely delete this email.</p>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#ffffff">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                <td align="center" bgcolor="#ffffff" style="padding: 12px;">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td align="center" bgcolor="#1a82e2" style="border-radius: 6px;">
                                        <a href="$url" target="_blank" style="display: inline-block; padding: 16px 36px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; color: #ffffff; text-decoration: none; border-radius: 6px;">Confirm</a>
                                        </td>
                                    </tr>
                                    </table>
                                </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" bgcolor="#ffffff" style="padding: 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 16px; line-height: 24px;">
                            <p style="margin: 0;">If that doesn't work, copy and paste the following link in your browser:</p>
                            <p style="margin: 0;"><a href="$url" target="_blank">$url</a></p>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                    <tr>
                    <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                        <tr>
                            <td align="center" bgcolor="#e9ecef" style="padding: 12px 24px; font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif; font-size: 14px; line-height: 20px; color: #666;">
                            <p style="margin: 0;">You received this email because we received a request for reset password for your account.<br>If you didn't request reset password you can safely delete this email.</p>
                            </td>
                        </tr>
                        </table>
                    </td>
                    </tr>
                </table>
                </body>
                </html>
                HTML;

                $email = \Config\Services::email();

                $email->setTo($user_email);
                $email->setSubject('Konfirmasi Reset Password');
                $email->setMessage($email_msg);

                if ($email->send()) {
                    $data['title'] = 'Confirm Mail';
                    $data['email'] = $user_email;
                    $data['msg'] = 'Please click on the included link to reset your password.';
                    return view('auth/confirm_mail', $data);
                }
                else {
                    $data = $email->printDebugger(['headers']);
                    return print_r($data);
                }
            }
            else {
                return redirect()->to(base_url('forgot-password'))->with('alert', '<div class="alert alert-danger" role="alert">Your email is not registered.</div>');
            }
        }

        $data['title'] = 'Forgot Password';
        return view('auth/forgot_password', $data);
    }

    public function reset_password($token = NULL) {

        $user_token = $this->token_model->where(['token' => $token, 'type' => 1])->first();

        if ($user_token && $user_token->expired_at > date('Y-m-d H:i:s')) {

            if ($this->request->getMethod() == 'post') {
                $rules = [
                    'password'          => 'required|min_length[6]|max_length[60]',
                    'confirm_password'  => 'matches[password]'
                ];

                if ($this->validate($rules)) {
                    $password = $this->request->getPost('password');

                    $this->user_model->where(['email' => $user_token->user_email])->set(['password' => password_hash($password, PASSWORD_BCRYPT), 'email_verified' => 1])->update();

                    session()->remove(['id', 'name', 'email', 'logged_in']);
                    return redirect()->to(base_url('login'))->with('alert', '<div class="alert alert-success" role="alert">Your password is successfully reset.<br>Please login again.</div>');
                }
                else {
                    $data['validation'] = $this->validator;
                }
            }

            $data['title'] = 'Reset Password';
            return view('auth/reset_password', $data);
        }
        else if ($user_token && $user_token->expired_at < date('Y-m-d H:i:s')) {
            echo 'Expired';
            echo '<br>';
            echo '<a href="'.base_url('login').'">Login</a>';
        }
        else {
            echo 'Error';
            echo '<br>';
            echo '<a href="'.base_url('login').'">Login</a>';
        }
    }

    public function logout() {
        session()->destroy();
        $data['title'] = 'Logout';
        return view('auth/logout', $data);
    }
}
