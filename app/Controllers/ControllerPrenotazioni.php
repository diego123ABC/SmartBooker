<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerPrenotazioni extends BaseController
{
    public function index()
    {
        $prenotationsModel = new ModelloRisorse();
        $prenotations = $prenotationsModel->getPrenotazioni();
        return $this->respond($prenotations);
    }

    // Mostra un singolo utente per ID
    public function show($id = null)
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $prenotation = $prenotationsModel->getPrenotazioni($id);

        if (!$prenotation) {
            return $this->failNotFound("Utente con ID $id non trovato");
        }

        return $this->respond($prenotation);
    }

    // Aggiunge un nuovo utente
    public function create()
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $data = $this->request->getPost();

        if (!$prenotationsModel->insert($data)) {
            return $this->failValidationErrors($prenotationsModel->errors());
        }

        return $this->respondCreated(['message' => 'Utente creato con successo']);
    }

    // Aggiorna un utente esistente
    public function update($id = null)
    {
        $prenotationsModel = new ModelloPrenotazioni();
        $data = $this->request->getRawInput();

        if (!$prenotationsModel->update($id, $data)) {
            return $this->failValidationErrors($prenotationsModel->errors());
        }

        return $this->respondUpdated(['message' => 'Utente aggiornato con successo']);
    }

    // Elimina un utente
    public function delete($id = null)
    {
        $prenotationsModel = new ModelloPrenotazioni();
        
        if (!$prenotationsModel->getRisorsa($id)) {
            return $this->failNotFound("Utente con ID $id non trovato");
        }

        $prenotationsModel->delete($id);
        return $this->respondDeleted(['message' => 'Utente eliminato con successo']);
    }
}
