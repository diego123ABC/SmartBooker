<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerRisorse extends BaseController
{
    public function index()
    {
        $resourceModel = new ModelloRisorse();
        $resources = $resourceModel->getRisorse();
        return $this->respond($resources);
    }

    // Mostra un singolo utente per ID
    public function show($id = null)
    {
        $resourceModel = new ModelloRisorse();
        $user = $resourceModel->getRisorsa($id);

        if (!$user) {
            return $this->failNotFound("Utente con ID $id non trovato");
        }

        return $this->respond($user);
    }

    // Aggiunge un nuovo utente
    public function create()
    {
        $resourceModel = new ModelloRisorse();
        $data = $this->request->getPost();

        if (!$resourceModel->insert($data)) {
            return $this->failValidationErrors($resourceModel->errors());
        }

        return $this->respondCreated(['message' => 'Utente creato con successo']);
    }

    // Aggiorna un utente esistente
    public function update($id = null)
    {
        $resourceModel = new ModelloRisorse();
        $data = $this->request->getRawInput();

        if (!$resourceModel->update($id, $data)) {
            return $this->failValidationErrors($resourceModel->errors());
        }

        return $this->respondUpdated(['message' => 'Utente aggiornato con successo']);
    }

    // Elimina un utente
    public function delete($id = null)
    {
        $resourceModel = new ModelloRisorse();
        
        if (!$resourceModel->getRisorsa($id)) {
            return $this->failNotFound("Utente con ID $id non trovato");
        }

        $resourceModel->delete($id);
        return $this->respondDeleted(['message' => 'Utente eliminato con successo']);
    }
}
