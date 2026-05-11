<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{
    protected $table            = 'event';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'id', 'title', 'slug', 'banner_image', 'status', 'category_id', 'venue_id'
    ];

    public function getEvents($search = null, $date = null, $sort = 'asc')
    {
        $builder = $this->db->table($this->table);
        $builder->select('event.id, event.title, event.slug, event.banner_image, MIN(schedule.started_at) as event_date, MIN(ticket.price) as start_price, city.name as city_name');
        
        $builder->join('schedule', 'schedule.event_id = event.id', 'left');
        $builder->join('ticket', 'ticket.event_id = event.id', 'left');
        $builder->join('venue', 'venue.id = event.venue_id', 'left');
        $builder->join('city', 'city.id = venue.city_id', 'left');
        
        if (!empty($search)) {
            $builder->like('event.title', $search);
        }
        
        if (!empty($date)) {
            $builder->where('DATE(schedule.started_at)', $date);
        }
        
        $builder->groupBy('event.id');
        
        $sortOrder = (strtolower($sort) === 'desc') ? 'DESC' : 'ASC';
        $builder->orderBy('event_date', $sortOrder);
        
        return $builder->get()->getResultArray();
    }
}
