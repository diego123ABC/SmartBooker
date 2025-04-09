<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelloPrenotazioni;

class ControllerPrenotazioni extends ResourceController
{
    protected $modelName = 'App\Models\ModelloPrenotazioni';
    protected $format    = 'json';

    // Mostra tutte le prenotazioni
    public function index()
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $prenotations = $prenotationsModel->getPrenotazioni();
        return $this->respond($prenotations);
    }

    // Mostra una singola prenotazione
    public function show($id = null)
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $prenotation = $prenotationsModel->getPrenotazioni($id);

        if (!$prenotation) {
            return $this->failNotFound("Prenotazione con ID $id non trovata");
        }

        return $this->respond($prenotation);
    }

    // Aggiunge una nuova prenotazione
    public function create()
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $data = $this->request->getPost();

        if (!$prenotationsModel->insert($data)) {
            return $this->failValidationErrors($prenotationsModel->errors());
        }

        return $this->respondCreated(['message' => 'Prenotazione creata con successo']);
    }

    // Aggiorna una prenotazione esistente
    public function update($id = null)
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $data = $this->request->getRawInput();

        if (!$prenotationsModel->update($id, $data)) {
            return $this->failValidationErrors($prenotationsModel->errors());
        }

        return $this->respondUpdated(['message' => 'Prenotazione aggiornata con successo']);
    }

    // Elimina una prenotazione
    public function delete($id = null)
    {
        $prenotationsModel = new ModelloPrenotazioni();

        // Assumiamo che tu abbia un metodo per controllare l’esistenza
        if (!$prenotationsModel->getPrenotazioni($id)) {
            return $this->failNotFound("Prenotazione con ID $id non trovata");
        }

        $prenotationsModel->delete($id);
        return $this->respondDeleted(['message' => 'Prenotazione eliminata con successo']);
    }
}