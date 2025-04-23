<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelloPrenotazioni extends Model
{
    protected $table = 'prenotazioni';
    protected $primaryKey = 'id';
    protected $allowedFields = ['utente_id', 'risorsa_id', 'data_inizio', 'data_fine', 'stato'];

    public function getPrenotazioni()
    {
        return $this->findAll(); // Recupera tutti gli utenti
    }
    public function getPrenotazione($id)
    {
        return $this->find($id); // Trova un record in base alla chiave primaria
    }

    public function haSovrapposizione($risorsa_id, $data_inizio, $data_fine)
    {
        return $this->where('risorsa_id', $risorsa_id)
            ->where('stato', 'attiva')
            ->groupStart()
                ->where("data_inizio <=", $data_fine)
                ->where("data_fine >=", $data_inizio)
            ->groupEnd()
            ->countAllResults() > 0;
    }


}
