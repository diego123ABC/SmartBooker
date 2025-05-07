<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ModelloRisorse;

class ControllerRisorse extends ResourceController
{
    protected $modelName = 'App\Models\ModelloRisorse';
    protected $format    = 'json';

    public function index()
    {
        $resourceModel = new ModelloRisorse();
        $resources = $resourceModel->getRisorse();
        return $this->respond($resources);
    }

    public function show($id = null)
    {
        $resourceModel = new ModelloRisorse();
        $resource = $resourceModel->getRisorsa($id);

        if (!$resource) {
            return $this->failNotFound("Risorsa con ID $id non trovata");
        }

        return $this->respond($resource);
    }

    public function create()
    {
        $resourceModel = new ModelloRisorse();
        $data = $this->request->getPost();

        if (!$resourceModel->insert($data)) {
            return $this->failValidationErrors($resourceModel->errors());
        }

        return $this->respondCreated(['message' => 'Risorsa creata con successo']);
    }

    public function update($id = null)
    {
        $resourceModel = new ModelloRisorse();
        $data = $this->request->getRawInput();

        if (!$resourceModel->update($id, $data)) {
            return $this->failValidationErrors($resourceModel->errors());
        }

        return $this->respondUpdated(['message' => 'Risorsa aggiornata con successo']);
    }

    public function delete($id = null)
    {
        $resourceModel = new ModelloRisorse();
        
        if (!$resourceModel->getRisorsa($id)) {
            return $this->failNotFound("Risorsa con ID $id non trovata");
        }

        $resourceModel->delete($id);
        return $this->respondDeleted(['message' => 'Risorsa eliminata con successo']);
    }

    public function risorsePerTipo($tipo = null)
    {
        $model = new ModelloRisorse();

        // Mappatura dei tipi per i dispositivi
        if ($tipo === 'dispositivi') {
            $risorse = $model->whereIn('tipo', ['PC', 'stampante', 'proiettore'])->findAll();
        } else {
            $risorse = $model->where('tipo', $tipo)->findAll();
        }

        // Se non sono state trovate risorse per quel tipo, mostra comunque la vista con lista vuota
        return view('lista_risorse', ['risorse' => $risorse, 'tipo' => $tipo]);
    }

}
