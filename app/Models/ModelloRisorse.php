<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelloRisorse extends Model
{
    protected $table = 'risorse';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nome', 'tipo', 'disponibilita', 'descrizione'];

    public function getRisorse()
    {
        return $this->findAll(); // Recupera tutti gli utenti
    }
    public function getRisorsa($id)
    {
        return $this->find($id); // Trova un record in base alla chiave primaria
    }
}
