<?php
namespace App\Controllers;

use App\Models\ModelloUtenti;

class ControllerAutenticazione extends BaseController {
    public function register() {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nome' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[utenti.email]',
                'password' => 'required|min_length[8]'
            ];
    
            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }
    
            $userModel = new \App\Models\ModelloUtenti();
            $userModel->insert([
                'nome' => $this->request->getPost('nome'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'ruolo' => 'studente' // Default
            ]);
    
            return redirect()->to('/login')->with('success', 'Registrazione completata!');
        }
        return view('auth/register');
    }
    
    public function logout() {
        $this->session->destroy();
        return redirect()->to('/');
    }
}