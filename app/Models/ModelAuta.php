<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAuta extends Model
{
    protected $table            = 'model_auta'; // Název tabulky
    protected $primaryKey       = 'id'; // Primární klíč
    protected $useAutoIncrement = true; // Automatické inkrementace primárního klíče
    protected $returnType       = 'array'; // Návratový typ dat
    protected $useSoftDeletes   = false; // Nepoužíváme soft delete
    protected $protectFields    = true; // Ochrana polí proti hromadnému přiřazení
    protected $allowedFields    = ['model', 'rok_vyroby', 'palivo', 'vykon', 'znacka_auta_id']; // Sloupce tabulky

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
