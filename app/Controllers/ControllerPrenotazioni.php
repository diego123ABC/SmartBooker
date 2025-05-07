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
        $model = new ModelloPrenotazioni();
        $prenotazione = $model->getPrenotazione($id);

        if (!$prenotazione) {
            return $this->failNotFound("Prenotazione con ID $id non trovata");
        }

        return $this->respond($prenotazione);
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
        $model = new ModelloPrenotazioni();

        if (!$model->getPrenotazione($id)) {
            return $this->failNotFound("Prenotazione con ID $id non trovata");
        }

        $model->delete($id);
        return $this->respondDeleted(['message' => 'Prenotazione eliminata con successo']);
    }

    public function formPrenotazione($risorsa_id)
    {
        return view('form_prenotazione', ['risorsa_id' => $risorsa_id]);
    }

    public function creaRicorrente()
    {
        $giorni = $this->request->getPost('giorni');
        $settimane = (int)$this->request->getPost('settimane');
        $risorsa_id = $this->request->getPost('risorsa_id');
        $utente_id = session()->get('id'); // Assicurati che la sessione sia attiva

        if (!in_array($giorni, ['lunedì','martedì','mercoledì','giovedì','venerdì']) || $settimane <= 0) {
            return $this->failValidationErrors('Parametri non validi');
        }

        $model = new \App\Models\ModelloPrenotazioni();

        for ($i = 0; $i < $settimane; $i++) {
            $inizio = strtotime("next $giorni +{$i} week 10:00");
            $fine = strtotime("+1 hour", $inizio);

            $data_inizio = date('Y-m-d H:i:s', $inizio);
            $data_fine = date('Y-m-d H:i:s', $fine);

            if (!$model->haSovrapposizione($risorsa_id, $data_inizio, $data_fine)) {
                $model->insert([
                    'utente_id' => $utente_id,
                    'risorsa_id' => $risorsa_id,
                    'data_inizio' => $data_inizio,
                    'data_fine' => $data_fine,
                    'stato' => 'attiva'
                ]);
            }
        }

        return $this->respond(['message' => 'Prenotazioni ricorrenti create']);
    }
}