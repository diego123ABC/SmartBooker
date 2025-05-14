<?php
namespace App\Models;

use CodeIgniter\Model;

class ModelloUtenti extends Model
{
    protected $table = 'utenti';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'password', 'ruolo'];
    protected $useTimestamps = false;
}