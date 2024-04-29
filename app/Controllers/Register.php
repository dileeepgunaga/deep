<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Register extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function save()
{
    // Load the validation library
    $validation = \Config\Services::validation();

    // Define validation rules
    $rules = [
        'name' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'mobile' => 'required|numeric',
        'password' => 'required|min_length[6]',
        'profile_pic' => 'uploaded[profile_pic]|max_size[profile_pic,1024]|is_image[profile_pic]'
    ];

    // Set validation rules
    $validation->setRules($rules);

    // Validate the input
    if (!$validation->withRequest($this->request)->run()) {
        // Validation failed, redirect back with errors
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Validation passed, proceed with saving data
    $model = new UserModel();

    // Handle profile picture upload
    $profilePic = $this->request->getFile('profile_pic');
    $data = [
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'mobile' => $this->request->getPost('mobile'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
    ];

    if ($profilePic->isValid() && !$profilePic->hasMoved()) {
        $newName = $profilePic->getRandomName();
        $profilePic->move(ROOTPATH . 'public/uploads', $newName);
        $data['profile_pic'] = $newName;
    }

    $model->insert($data);

    return redirect()->to('/login')->with('success', 'Registration successful!');
}

    public function deleteAccount()
    {
        // Get the user ID of the logged-in user from session or any other method
        $userId = session('user_id'); // Adjust this according to your session data structure
    
        // Load the UserModel
        $model = new UserModel();
    
        // Delete the user by ID
        $model->delete($userId);
    
        // Redirect to the login page or any other desired page after deletion
        return redirect()->to('/login')->with('success', 'Your account has been deleted.');
    }
    public function ind()
    {
        return view('user_view');
    }

    public function edit()
    {
        return view('update');
    }
    public function update()
    {
        // Load necessary libraries and models
        $validation = \Config\Services::validation();
        $model = new UserModel();
    
        // Define validation rules
        $rules = [
            'name' => 'required',
            'email' => "required|valid_email|is_unique[users.email,id,{$this->request->getPost('id')}]",
            'mobile' => 'required|numeric',
            'profile_pic' => 'uploaded[profile_pic]|max_size[profile_pic,1024]|is_image[profile_pic]',
            'old_password' => 'required' // New rule for old password
        ];
    
        // Check if a new profile picture is uploaded
        $profilePic = $this->request->getFile('profile_pic');
        if ($profilePic->isValid()) {
            $rules['profile_pic'] = 'uploaded[profile_pic]|max_size[profile_pic,1024]|is_image[profile_pic]';
        }
    
        // Add validation rule for new password and confirm password
        $rules['new_password'] = 'matches[confirm_password]';
        $rules['confirm_password'] = 'matches[new_password]';
    
        $validation->setRules($rules);
    
        // Validate input
        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, redirect back with errors
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        // Validation passed, proceed with update
        $userId = session('user_id');
        $user = $model->find($userId);
    
        // Verify old password
        $oldPassword = $this->request->getPost('old_password');
        if (!password_verify($oldPassword, $user['password'])) {
            // Old password is incorrect, show error
            return redirect()->back()->withInput()->with('error', 'Old password is incorrect.');
        }
    
        // Prepare data for update
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'mobile' => $this->request->getPost('mobile'),
        ];
    
        // Handle profile picture upload
        if ($profilePic->isValid() && !$profilePic->hasMoved()) {
            $newName = $profilePic->getRandomName();
            $profilePic->move(ROOTPATH . 'public/uploads', $newName);
            $data['profile_pic'] = $newName;
        }
    
        // Update password if a new one is provided
        $newPassword = $this->request->getPost('new_password');
        if (!empty($newPassword)) {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }
    
        $model->update($userId, $data);
    
        return redirect()->to('/login')->with('success', 'User information updated successfully!');
    }
    
    
    
}
