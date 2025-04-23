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
        $model = new ModelloPrenotazioni();

        // 1. Aggiorna le prenotazioni scadute
        $model->where('stato', 'attiva')
            ->where('data_fine <', date('Y-m-d H:i:s'))
            ->set(['stato' => 'scaduta'])
            ->update();

        // 2. Recupera tutte le prenotazioni (attive e scadute)
        $prenotazioni = $model->getPrenotazioni();

        return $this->respond($prenotazioni);
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

        // Validazione base
        if (!isset($data['utente_id'], $data['risorsa_id'], $data['data_inizio'], $data['data_fine'])) {
            return $this->failValidationErrors('Dati mancanti');
        }

        // Controllo formato date
        if (strtotime($data['data_inizio']) >= strtotime($data['data_fine'])) {
            return $this->failValidationErrors('Intervallo date non valido');
        }

        // Verifica utente esiste
        $utenteModel = new \App\Models\ModelloUtenti();
        if (!$utenteModel->find($data['utente_id'])) {
            return $this->failNotFound('Utente non trovato');
        }

        // Verifica risorsa esiste e disponibile
        $risorsaModel = new \App\Models\ModelloRisorse();
        $risorsa = $risorsaModel->find($data['risorsa_id']);
        if (!$risorsa || !$risorsa['disponibilita']) {
            return $this->failNotFound('Risorsa non disponibile o non trovata');
        }

        // Controllo sovrapposizione
        if ($prenotationsModel->haSovrapposizione($data['risorsa_id'], $data['data_inizio'], $data['data_fine'])) {
            return $this->failValidationErrors('Esiste già una prenotazione attiva in quell’orario');
        }

        // Inserisci
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

    public function formPrenotazione($risorsa_id)
    {
        return view('form_prenotazione', ['risorsa_id' => $risorsa_id]);
    }

}