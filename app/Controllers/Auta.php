<?php
namespace App\Controllers;

use App\Models\ModelAuta;
use App\Models\ZnackaAuta;
use App\Models\TypAuta;
use App\Models\TypAutaHasModelAuta;
use CodeIgniter\Controller;

class Auta extends BaseController
{
    /**
     * Zobrazí seznam aut s možností přidání, editace a mazání (pouze pro přihlášené)
     */
    public function index()
    {
        $ionAuth = service('ionAuth');
        if (!$ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }
        $builder = (new TypAutaHasModelAuta())
            ->select('typ_auta_has_model_auta.*, model_auta.model, model_auta.palivo, znacka_auta.znacka, typ_auta.typ')
            ->join('model_auta', 'model_auta.id = typ_auta_has_model_auta.model_auta_id')
            ->join('znacka_auta', 'znacka_auta.id = model_auta.znacka_auta_id')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id');
        $auta = $builder->paginate(9, 'auta');
        $pager = $builder->pager;
        // Agregační funkce: počet aut
        $celkemAut = (new TypAutaHasModelAuta())->countAllResults();
        return view('auta/index', ['auta' => $auta, 'pager' => $pager, 'celkemAut' => $celkemAut]);
    }

    /**
     * Formulář pro přidání auta
     */
    public function create()
    {
        $ionAuth = service('ionAuth');
        if (!$ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }
        $znacky = (new ZnackaAuta())->findAll();
        $typy = (new TypAuta())->findAll();
        return view('auta/create', [
            'znacky' => $znacky,
            'typy' => $typy
        ]);
    }

    /**
     * Uloží nové auto do databáze
     */
    public function store()
    {
        $ionAuth = service('ionAuth');
        if (!$ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }
        $modelAutaModel = new \App\Models\ModelAuta();
        $typAutaModel = new \App\Models\TypAuta();
        $typAutaHasModelAutaModel = new TypAutaHasModelAuta();

        // 1. Získání/vložení typu auta
        $typText = $this->request->getPost('typ');
        $typAuta = $typAutaModel->where('typ', $typText)->first();
        if (!$typAuta) {
            $typAutaId = $typAutaModel->insert(['typ' => $typText], true);
        } else {
            $typAutaId = $typAuta['id'];
        }

        // 2. Vložení modelu auta (bez pole 'popis')
        $modelData = [
            'model' => $this->request->getPost('model'),
            'palivo' => $this->request->getPost('palivo'),
            'znacka_auta_id' => $this->request->getPost('znacka_auta_id'),
            'typ' => $typText,
        ];
        unset($modelData['id']);
        $modelAutaId = $modelAutaModel->insert($modelData, true);

        // 3. Připrav data pro typ_auta_has_model_auta (bez popisu)
        $data = [
            'typ_auta_id' => $typAutaId,
            'model_auta_id' => $modelAutaId,
        ];
        // Upload obrázku pouze pokud je nahrán
        $img = $this->request->getFile('obrazek');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(WRITEPATH . 'uploads', $imgName);
            $data['obrazek'] = base_url('writable/uploads/' . $imgName);
        }
        $typAutaHasModelAutaModel->insert($data);
        return redirect()->to('/auta')->with('success', 'Auto bylo úspěšně přidáno.');
    }

    /**
     * Formulář pro editaci auta
     */
    public function edit($id)
    {
        $ionAuth = service('ionAuth');
        if (!$ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }
        // Načti auto přes join, aby bylo pole 'typ' vždy dostupné
        $builder = (new TypAutaHasModelAuta())
            ->select('typ_auta_has_model_auta.*, model_auta.model, model_auta.palivo, znacka_auta.znacka, typ_auta.typ')
            ->join('model_auta', 'model_auta.id = typ_auta_has_model_auta.model_auta_id')
            ->join('znacka_auta', 'znacka_auta.id = model_auta.znacka_auta_id')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id')
            ->where('typ_auta_has_model_auta.id', $id);
        $auto = $builder->first();
        if (!$auto) {
            return redirect()->to('/auta')->with('error', 'Auto nebylo nalezeno.');
        }
        $znacky = (new ZnackaAuta())->findAll();
        $typy = (new TypAuta())->findAll();
        return view('auta/edit', [
            'auto' => $auto,
            'znacky' => $znacky,
            'typy' => $typy
        ]);
    }

    /**
     * Uloží změny auta
     */
    public function update($id)
    {
        $ionAuth = service('ionAuth');
        if (!$ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }
        $model = new TypAutaHasModelAuta();
        $data = $this->request->getPost();
        // Upload obrázku
        $img = $this->request->getFile('obrazek');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move(WRITEPATH . 'uploads', $imgName);
            $data['obrazek'] = base_url('writable/uploads/' . $imgName);
        }
        $model->update($id, $data);
        return redirect()->to('/auta')->with('success', 'Auto bylo úspěšně upraveno.');
    }

    /**
     * Soft delete auta (s modálním potvrzením na frontendu)
     */
    public function delete($id)
    {
        $ionAuth = service('ionAuth');
        if (!$ionAuth->loggedIn()) {
            return redirect()->to('/login');
        }
        $model = new TypAutaHasModelAuta();
        // Softdelete: nastaví deleted_at na aktuální čas
        if ($model->update($id, ['deleted_at' => date('Y-m-d H:i:s')])) {
            return redirect()->back()->with('success', 'Auto bylo úspěšně smazáno.');
        } else {
            return redirect()->back()->with('error', 'Chyba při mazání auta.');
        }
    }

    /**
     * Zobrazí detail auta
     */
    public function show($id)
    {
        $builder = (new TypAutaHasModelAuta())
            ->select('typ_auta_has_model_auta.*, model_auta.model, model_auta.palivo, model_auta.rok_vyroby, model_auta.vykon, model_auta.znacka_auta_id, znacka_auta.znacka, typ_auta.typ, model_auta.id as model_id')
            ->join('model_auta', 'model_auta.id = typ_auta_has_model_auta.model_auta_id')
            ->join('znacka_auta', 'znacka_auta.id = model_auta.znacka_auta_id')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id')
            ->where('typ_auta_has_model_auta.id', $id);
        $auto = $builder->first();
        if (!$auto) {
            return redirect()->to('/auta')->with('error', 'Auto nebylo nalezeno.');
        }
        $breadcrumbs = [
            ['label' => 'Auta', 'url' => base_url('auta')],
            ['label' => 'Detail auta']
        ];
        return view('auta/show', ['auto' => $auto, 'breadcrumbs' => $breadcrumbs]);
    }

    /**
     * Zobrazí detail auta s konkrétní barvou (ukázka routy se dvěma parametry)
     * @param int $id ID auta
     * @param int $barvaId ID barvy
     */
    public function showWithColor($id, $barvaId)
    {
        $builder = (new \App\Models\TypAutaHasModelAuta())
            ->select('typ_auta_has_model_auta.*, model_auta.model, model_auta.palivo, model_auta.rok_vyroby, model_auta.vykon, model_auta.znacka_auta_id, znacka_auta.znacka, typ_auta.typ, model_auta.id as model_id, barva.barva')
            ->join('model_auta', 'model_auta.id = typ_auta_has_model_auta.model_auta_id')
            ->join('znacka_auta', 'znacka_auta.id = model_auta.znacka_auta_id')
            ->join('typ_auta', 'typ_auta.id = typ_auta_has_model_auta.typ_auta_id')
            ->join('typ_auta_has_model_auta_has_barva', 'typ_auta_has_model_auta_has_barva.typ_auta_has_model_auta_id = typ_auta_has_model_auta.id')
            ->join('barva', 'barva.id = typ_auta_has_model_auta_has_barva.barva_id')
            ->where('typ_auta_has_model_auta.id', $id)
            ->where('barva.id', $barvaId);
        $auto = $builder->first();
        if (!$auto) {
            return redirect()->to('/auta')->with('error', 'Auto nebo barva nebyly nalezeny.');
        }
        $breadcrumbs = [
            ['label' => 'Auta', 'url' => base_url('auta')],
            ['label' => 'Detail auta'],
            ['label' => 'Barva: ' . ($auto['barva'] ?? '-')]
        ];
        return view('auta/show', ['auto' => $auto, 'breadcrumbs' => $breadcrumbs]);
    }
}
