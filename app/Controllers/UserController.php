<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $user = $model->findAll();
        $title  = 'Users';

        return view('user/user', [
            'user' => $user,
            'title' => $title
        ]);
    }

    public function new()
    {
        $title  = 'Add User';

        return view('user/user-add', [
            'title' => $title,
        ]);
    }

    public function create()
    {
        //validate
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name' => 'required|max_length[100]',
            'email' => 'required|max_length[100]|is_unique[users.email]',
            'password' => 'required|max_length[100]',
            'level' => 'required|max_length[2]',
            'image' => 'max_size[image,300]|is_image[image]|mime_in[image,image/jpg,image/jpeg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $password = $this->request->getPost('password');

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level'),
        ];

        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $image->move('img/user');
            $nameImage = $image->getName();
            $data['image'] = $nameImage;
        }

        $model = new UserModel();
        $model->insert($data);

        session()->setFlashdata('save', 'User has been saved !');

        return redirect()->to('/user');
    }

    public function show($id_user)
    {
        $model = new UserModel();
        $user = $model->where('id_user', $id_user)->first();
        $title  = 'Detail User';

        return view('user/user-detail', [
            'title' => $title,
            'user' => $user,
        ]);
    }

    public function edit($id_user)
    {
        $model = new UserModel();
        $user = $model->where('id_user', $id_user)->first();
        $title  = 'Edit User';

        return view('user/user-edit', [
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
            'email' => 'required|max_length[100]|is_unique[users.email,id_user,' . $id_user . ']',
            'level' => 'required|max_length[2]',
            'image' => 'max_size[image,300]|is_image[image]|mime_in[image,image/jpg,image/jpeg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'level' => $this->request->getPost('level'),
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

        return redirect()->to('/user');
    }

    public function delete($id_user)
    {
        $model = new userModel();

        $deleteduser = $model->where('id_user', $id_user)->first();

        if (!$deleteduser) {
            session()->setFlashdata('error', 'User not found !');
            return redirect()->to('/user');
        }

        if ($deleteduser['islogin'] == 1) {
            session()->setFlashdata('error', 'Cannot delete when user log in !');
            return redirect()->to('/user');
        }

        // Get the image if exist
        $imageFileName = $deleteduser['image'];

        if (!empty($imageFileName)) {
            unlink('img/user/' . $imageFileName);
        }

        $model->delete($id_user);

        session()->setFlashdata('delete', 'User has been deleted !');

        return redirect()->to('/user');
    }
}
