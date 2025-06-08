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
        $ionAuth = service('ionAuth');

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
            'showSpravaAuta' => $ionAuth->loggedIn(),
            'breadcrumbs' => [
                ['label' => 'Domů', 'url' => base_url('/')]
            ]
        ];

        $builder = (new TypAutaHasModelAuta())
            ->select('typ_auta_has_model_auta.*, model_auta.model, model_auta.palivo, znacka_auta.znacka, typ_auta.typ')
            ->join('model_auta', 'model_auta.id = typ_auta_has_model_auta.model_auta_id')
            ->join('znacka_auta', 'znacka_auta.id = model_auta.znacka_auta_id')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id')
            ->where('typ_auta_has_model_auta.deleted_at IS NULL');

        if (!empty($filter)) {
            if (!empty($filter['znacka_auta_id'])) {
                $builder->where('znacka_auta.id', $filter['znacka_auta_id']);
            }
            if (!empty($filter['model_auta_id'])) {
                $builder->where('model_auta.id', $filter['model_auta_id']);
            }
            if (!empty($filter['typ_auta_id'])) {
                $builder->where('typ_auta.id', $filter['typ_auta_id']);
            }
            if (!empty($filter['palivo'])) {
                $builder->where('model_auta.palivo', $filter['palivo']);
            }
        }

        // Načtení dat s použitím stránkování
        $data['auta'] = $builder->paginate(10, 'auta'); // změna na 10 položek na stránku
        $data['pager'] = $builder->pager;

        // Předání dat do pohledu
        return view('domovska_stranka', $data);
    }

    public function getModelsByBrand()
    {
        $json = $this->request->getJSON(true);
        $znackaId = $json['znacka_id'] ?? $this->request->getPost('znacka_id');
        $modelAutaModel = new ModelAuta();

        // Načtení modelů podle značky
        $modely = $modelAutaModel->where('znacka_auta_id', $znackaId)->findAll();

        return $this->response->setJSON($modely);
    }

    public function getTypesByModel()
    {
        $json = $this->request->getJSON(true);
        $modelId = $json['model_id'] ?? $this->request->getPost('model_id');
        $typAutaHasModelAutaModel = new TypAutaHasModelAuta();

        // Načtení typů podle modelu (join na typ_auta)
        $typy = $typAutaHasModelAutaModel
            ->select('typ_auta.id, typ_auta.typ')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id')
            ->where('typ_auta_has_model_auta.model_auta_id', $modelId)
            ->groupBy('typ_auta.id')
            ->findAll();

        return $this->response->setJSON($typy);
    }
    public function login()
    {
        // Zobrazit přihlašovací formulář
        return view('login');
    }

    
}