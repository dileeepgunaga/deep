<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $userData = [
                    'user_id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'mobile' => $user['mobile'],
                    'profile_pic' => $user['profile_pic'],
                    'isLoggedIn' => true,
                ];

                $session->set($userData);

              
                return redirect()->to('/user')->with('success', 'Login successful!');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        
        return redirect()->to('/login')->with('success', 'Logged out successfully');
    }
}
