<?php
namespace App\Controllers;

use App\Models\ModelloUtenti;

class ControllerAutenticazione extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nome' => 'required|min_length[3]',
                'email' => 'required|valid_email|is_unique[utenti.email]',
                'password' => 'required|min_length[8]',
                'ruolo' => 'in_list[studente,docente,admin]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            // Solo utenti loggati e admin possono creare admin/docenti
            $ruoloScelto = $this->request->getPost('ruolo');
            if (in_array($ruoloScelto, ['admin', 'docente']) && session()->get('ruolo') !== 'admin') {
                return redirect()->back()->with('error', 'Non hai i permessi per assegnare questo ruolo.');
            }

            $userModel = new ModelloUtenti();
            $userModel->insert([
                'nome' => $this->request->getPost('nome'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'ruolo' => $ruoloScelto ?? 'studente'
            ]);

            return redirect()->to('/login')->with('success', 'Registrazione completata!');
        }

        return view('register');
    }

    public function login()
    {
        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $userModel = new ModelloUtenti();
            $utente = $userModel->where('email', $email)->first();

            if ($utente && password_verify($password, $utente['password'])) {
                $this->session->set([
                    'id' => $utente['id'],
                    'nome' => $utente['nome'],
                    'email' => $utente['email'],
                    'ruolo' => $utente['ruolo'],
                    'isLoggedIn' => true
                ]);

                // Redirect per ruolo
                switch ($utente['ruolo']) {
                    case 'admin':
                        return redirect()->to('/admin/dashboard');
                    case 'docente':
                        return redirect()->to('/docente/dashboard');
                    default:
                        return redirect()->to('/studente/dashboard');
                }
            }

            return redirect()->back()->withInput()->with('error', 'Email o password non corretti.');
        }

        return view('login');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}