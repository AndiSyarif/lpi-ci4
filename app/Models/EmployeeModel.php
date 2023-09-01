<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $table = 'employees';
    protected $primaryKey = 'id_employee';
    protected $allowedFields = ['id', 'name', 'phone', 'address', 'position', 'join_date', 'salary', 'image'];
    protected $useTimestamps = true;
}
