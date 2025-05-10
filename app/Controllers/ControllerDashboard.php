<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class DashboardController extends BaseController
{
    public function index()
    {
        $session = session();
        $ruolo = $session->get('ruolo');

        if (!$session->get('isLoggedIn')) {
            return redirect()->to('login');
        }

        switch ($ruolo) {
            case 'admin':
                return redirect()->to('admin/dashboard');
            case 'docente':
                return redirect()->to('docente/dashboard');
            case 'studente':
            default:
                return redirect()->to('studente/dashboard');
        }
    }

    public function adminDashboard()
    {
        return view('dashboard/admin');
    }

    public function docenteDashboard()
    {
        return view('dashboard/docente');
    }

    public function studenteDashboard()
    {
        return view('dashboard/studente');
    }
}