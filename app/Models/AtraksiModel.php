<?php

namespace App\Models;

use CodeIgniter\Model;

class AtraksiModel extends Model
{
    protected $table            = 'atraksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id', 'title', 'slug', 'banner_image', 'price', 'status', 'category_id', 'city_id', 'country_id'
    ];

    public function getAtraksiWithDetails($slug = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('atraksi.*, category.title as category_name, city.name as city_name, country.name as country_name');
        $builder->join('category', 'category.id = atraksi.category_id', 'left');
        $builder->join('city', 'city.id = atraksi.city_id', 'left');
        $builder->join('country', 'country.id = atraksi.country_id', 'left');
        
        if ($slug === null) {
            return $builder->get()->getResultArray();
        }

        return $builder->where('atraksi.slug', $slug)->get()->getRowArray();
    }
}
