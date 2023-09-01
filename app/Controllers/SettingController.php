<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SettingController extends BaseController
{
    public function edit($id_user)
    {
        $model = new UserModel();
        $user = $model->where('id_user', $id_user)->first();
        $title  = 'Setting User';

        return view('setting/setting', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    public function update($id_user)
    {
        //validate
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|max_length[100]',
            'image' => 'max_size[image,300]|is_image[image]|mime_in[image,image/jpg,image/jpeg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
        ];

        if ($this->request->getFile('image')->isValid()) {

            $image = $this->request->getFile('image');
            $image->move('img/user');
            $nameImage = $image->getName();
            $data['image'] = $nameImage;

            // Remove the old image file
            $oldImage = $this->request->getPost('oldImage');
            if (!empty($oldImage)) {
                unlink('img/user/' . $oldImage);
            }
        }

        $model = new userModel();

        $model->update($id_user, $data);

        $updatedUser = $model->find($id_user);

        session()->set('userName', $updatedUser['name']);
        session()->set('userImage', $updatedUser['image']);

        session()->setFlashdata('update', 'User has been updated !');

        return redirect()->to('/setting/' . $updatedUser['id_user'] . '/edit');
    }

    public function security($userId)
    {

        $validation = \Config\Services::validation();
        $validation->setRules([
            'oldpassword' => 'required|min_length[6]',
            'password' => 'required|min_length[6]|differs[oldpassword]',
            'password_confirmation' => 'required|min_length[6]|matches[password]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $model = new UserModel();

        $user = $model->find($userId);

        if (!$user) {
            session()->setFlashdata('error', 'User not found !');
            return redirect()->to('/setting/' . $userId . '/edit?tab=custom-content-below-profile');
        }

        if (!password_verify($this->request->getVar('oldpassword'), $user['password'])) {
            session()->setFlashdata('error', 'Current password is incorrect.');
            return redirect()->to('/setting/' . $userId . '/edit?tab=custom-content-below-profile');
        }

        // If the old password is correct, proceed to update the password
        $newPassword = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        $model->update($userId, ['password' => $newPassword]);

        session()->setFlashdata('update', 'User password has been updated !');
        return redirect()->to('/setting/' . $userId . '/edit?tab=custom-content-below-profile');
    }
}
