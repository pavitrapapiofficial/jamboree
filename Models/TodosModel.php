<?php namespace App\Models;
  
use CodeIgniter\Model;
  
class TodosModel extends Model{
    protected $table = 'todo';
    protected $allowedFields = [
        'title', 'description', 'todo_status',
    ];
    protected $fields = ['title', 'description','todo_status'];
}