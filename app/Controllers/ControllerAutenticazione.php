<?php
namespace App\Controllers;

use App\Models\ModelloUtenti;
use CodeIgniter\Controller;

class ControllerAutenticazione extends BaseController
{
    public function register()
    {
        dd($this->request->getMethod());

        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            // Validazione semplice
            $rules = [
                'nome'     => 'required|min_length[3]',
                'email'    => 'required|valid_email|is_unique[utenti.email]',
                'password' => 'required|min_length[5]',
                'ruolo'    => 'required|in_list[studente,docente,admin]'
            ];

            if (!$this->validate($rules)) {
                return view('register', [
                    'validation' => $this->validator
                ]);
            }

            $model = new \App\Models\ModelloUtenti();
            $data = [
                'nome'     => $this->request->getPost('nome'),
                'email'    => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'ruolo'    => $this->request->getPost('ruolo')
            ];
            
            if ($model->insert($data)) {
                dd('Utente registrato correttamente');
            } else {
                dd($model->errors()); // <-- QUI vedrai gli errori del Model
            }
            
        }

        return view('register');
    }

    public function test()
    {
        dd('controller OK');
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