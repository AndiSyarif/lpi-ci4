<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmployeeModel;

class EmployeeController extends BaseController
{
    public function index()
    {
        $model = new EmployeeModel();
        $employee = $model->findAll();
        $title  = 'Employee';

        return view('employee/employee', [
            'employee' => $employee,
            'title' => $title
        ]);
    }

    public function new()
    {
        $title  = 'Add Employee';

        return view('employee/employee-add', [
            'title' => $title,
        ]);
    }

    public function create()
    {
        //validate
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required|max_length[10]|is_unique[employees.id]',
            'name' => 'required|max_length[100]',
            'phone' => 'required|max_length[15]',
            'address' => 'required|max_length[200]',
            'position' => 'required|max_length[50]',
            'join_date' => 'required',
            'salary' => 'required|max_length[10]',
            'image' => 'max_size[image,300]|is_image[image]|mime_in[image,image/jpg,image/jpeg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $password = $this->request->getPost('password');

        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'position' => $this->request->getPost('position'),
            'join_date' => $this->request->getPost('join_date'),
            'salary' => $this->request->getPost('salary'),
        ];

        if ($this->request->getFile('image')->isValid()) {
            $image = $this->request->getFile('image');
            $image->move('img/employee');
            $nameImage = $image->getName();
            $data['image'] = $nameImage;
        }

        $model = new EmployeeModel();
        $model->insert($data);

        session()->setFlashdata('save', 'Employee has been saved !');

        return redirect()->to('/employee');
    }

    public function show($id_employee)
    {
        $model = new EmployeeModel();
        $employee = $model->where('id_employee', $id_employee)->first();
        $title  = 'Detail Employee';

        return view('employee/employee-detail', [
            'title' => $title,
            'employee' => $employee,
        ]);
    }

    public function edit($id_employee)
    {
        $model = new EmployeeModel();
        $employee = $model->where('id_employee', $id_employee)->first();
        $title  = 'Edit Employee';

        return view('employee/employee-edit', [
            'title' => $title,
            'employee' => $employee,
        ]);
    }

    public function update($id_employee)
    {
        //validate
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id' => 'required|max_length[10]|is_unique[employees.id,id_employee,' . $id_employee . ']',
            'name' => 'required|max_length[100]',
            'phone' => 'required|max_length[15]',
            'address' => 'required|max_length[200]',
            'position' => 'required|max_length[50]',
            'join_date' => 'required',
            'salary' => 'required|max_length[10]',
            'image' => 'max_size[image,300]|is_image[image]|mime_in[image,image/jpg,image/jpeg]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'id' => $this->request->getPost('id'),
            'name' => $this->request->getPost('name'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
            'position' => $this->request->getPost('position'),
            'join_date' => $this->request->getPost('join_date'),
            'salary' => $this->request->getPost('salary'),
        ];

        if ($this->request->getFile('image')->isValid()) {

            $image = $this->request->getFile('image');
            $image->move('img/employee');
            $nameImage = $image->getName();
            $data['image'] = $nameImage;

            // Remove the old image file
            $oldImage = $this->request->getPost('oldImage');
            if (!empty($oldImage)) {
                unlink('img/employee/' . $oldImage);
            }
        }

        $model = new EmployeeModel();

        $model->update($id_employee, $data);

        session()->setFlashdata('update', 'Employee has been updated !');

        return redirect()->to('/employee');
    }

    public function delete($id_employee)
    {
        $model = new EmployeeModel();

        $deletedemployee = $model->where('id_employee', $id_employee)->first();

        if (!$deletedemployee) {
            session()->setFlashdata('error', 'Employee not found !');
            return redirect()->to('/employee');
        }

        // Get the image if exist
        $imageFileName = $deletedemployee['image'];

        if (!empty($imageFileName)) {
            unlink('img/employee/' . $imageFileName);
        }

        $model->delete($id_employee);

        session()->setFlashdata('delete', 'Employee has been deleted !');

        return redirect()->to('/employee');
    }
}
