<?php

namespace App\Controllers;

use App\Models\ModelloUtenti;
use CodeIgniter\RESTful\ResourceController;

class ControllerUtenti extends ResourceController
{
    protected $modelName = 'App\Models\ModelloUtenti';
    protected $format    = 'json';

    // Mostra tutti gli utenti
    public function index()
    {
        $userModel = new ModelloUtenti();
        $users = $userModel->getUtenti();
        return $this->respond($users);
    }

    // Mostra un singolo utente per ID
    public function show($id = null)
    {
        $userModel = new ModelloUtenti();
        $user = $userModel->getUtente($id);

        if (!$user) {
            return $this->failNotFound("Utente con ID $id non trovato");
        }

        return $this->respond($user);
    }

    // Aggiunge un nuovo utente
    public function create()
    {
        $userModel = new ModelloUtenti();
        $data = $this->request->getPost();

        if (!$userModel->insert($data)) {
            return $this->failValidationErrors($userModel->errors());
        }

        return $this->respondCreated(['message' => 'Utente creato con successo']);
    }

    // Aggiorna un utente esistente
    public function update($id = null)
    {
        $userModel = new ModelloUtenti();
        $data = $this->request->getRawInput();

        if (!$userModel->update($id, $data)) {
            return $this->failValidationErrors($userModel->errors());
        }

        return $this->respondUpdated(['message' => 'Utente aggiornato con successo']);
    }

    // Elimina un utente
    public function delete($id = null)
    {
        $userModel = new ModelloUtenti();
        
        if (!$userModel->getUtente($id)) {
            return $this->failNotFound("Utente con ID $id non trovato");
        }

        $userModel->delete($id);
        return $this->respondDeleted(['message' => 'Utente eliminato con successo']);
    }
}