<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelloUtenti extends Model
{
    protected $table = 'utenti';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'email', 'password', 'ruolo'];

    public function getUtenti()
    {
        return $this->findAll(); // Recupera tutti gli utenti
    }
    public function getUtente($id)
    {
        return $this->find($id); // Trova un record in base alla chiave primaria
    }
}