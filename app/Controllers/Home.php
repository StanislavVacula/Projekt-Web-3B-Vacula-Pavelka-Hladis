<?php

namespace App\Controllers;

use App\Models\ModelAuta;
use App\Models\TypAutaHasModelAuta;
use App\Models\TypAuta;
use App\Models\ZnackaAuta;

class Home extends BaseController
{
    public function index()
    {
        // Inicializace modelů
        $typAutaModel = new TypAuta();
        $znackaAutaModel = new ZnackaAuta();
        $modelAutaModel = new ModelAuta();
        $typAutaHasModelAutaModel = new TypAutaHasModelAuta();

        // Získání parametrů z GET požadavku
        $filter = $this->request->getGet();

        // Načtení dat pro filtr
        $data = [
            'typy' => $typAutaModel->findAll(),
            'znacky' => $znackaAutaModel->findAll(),
            'modely' => isset($filter['znacka_auta_id']) ? 
                $modelAutaModel->where('znacka_auta_id', $filter['znacka_auta_id'])->findAll() : 
                $modelAutaModel->findAll(),
            'selectedFilters' => $filter, // Zachování vybraných filtrů
        ];

        // Zpracování filtru
        $typAutaHasModelAutaModel->select('typ_auta_has_model_auta.*, model_auta.model, model_auta.palivo, znacka_auta.znacka, typ_auta.typ')
            ->join('model_auta', 'model_auta.id = typ_auta_has_model_auta.model_auta_id')
            ->join('znacka_auta', 'znacka_auta.id = model_auta.znacka_auta_id')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id');

        if (!empty($filter)) {
            if (!empty($filter['znacka_auta_id'])) {
                $typAutaHasModelAutaModel->where('znacka_auta.id', $filter['znacka_auta_id']);
            }
            if (!empty($filter['model_auta_id'])) {
                $typAutaHasModelAutaModel->where('model_auta.id', $filter['model_auta_id']);
            }
            if (!empty($filter['typ_auta_id'])) {
                $typAutaHasModelAutaModel->where('typ_auta.id', $filter['typ_auta_id']);
            }
            if (!empty($filter['palivo'])) {
                $typAutaHasModelAutaModel->where('model_auta.palivo', $filter['palivo']);
            }
        }

        // Načtení dat s použitím stránkování
        $data['auta'] = $typAutaHasModelAutaModel->paginate(12);
        $data['pager'] = $typAutaHasModelAutaModel->pager;

        // Předání dat do pohledu
        return view('domovska_stranka', $data);
    }

    public function getModelsByBrand()
    {
        $znackaId = $this->request->getPost('znacka_id');
        $modelAutaModel = new ModelAuta();

        // Načtení modelů podle značky
        $modely = $modelAutaModel->where('znacka_auta_id', $znackaId)->findAll();

        return $this->response->setJSON($modely);
    }

    public function getTypesByModel()
    {
        $modelId = $this->request->getPost('model_id');
        $typAutaHasModelAutaModel = new TypAutaHasModelAuta();

        // Načtení typů podle modelu
        $typy = $typAutaHasModelAutaModel->select('typ_auta.id, typ_auta.typ')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id')
            ->where('model_auta_id', $modelId)
            ->findAll();

        return $this->response->setJSON($typy);
    }
    public function login()
    {
        // Zobrazit přihlašovací formulář
        return view('login');
    }

    
}