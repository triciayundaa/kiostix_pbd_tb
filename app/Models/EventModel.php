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
    public function getEventWithDetails($slug)
    {
        $builder = $this->db->table($this->table);
        $builder->select('event.*, venue.title as venue_name, city.name as city_name');
        $builder->join('venue', 'venue.id = event.venue_id', 'left');
        $builder->join('city', 'city.id = venue.city_id', 'left');
        return $builder->where('event.slug', $slug)->get()->getRowArray();
    }

    public function getEventTickets($eventId)
    {
        return $this->db->table('ticket')
            ->where('event_id', $eventId)
            ->get()->getResultArray();
    }

    public function getEventSchedules($eventId)
    {
        return $this->db->table('schedule')
            ->where('event_id', $eventId)
            ->orderBy('started_at', 'ASC')
            ->get()->getResultArray();
    }

    public function getRelatedEvents($excludeId = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('event.id, event.title, event.slug, event.banner_image, MIN(schedule.started_at) as event_date, MIN(ticket.price) as start_price, city.name as city_name');
        
        $builder->join('schedule', 'schedule.event_id = event.id', 'left');
        $builder->join('ticket', 'ticket.event_id = event.id', 'left');
        $builder->join('venue', 'venue.id = event.venue_id', 'left');
        $builder->join('city', 'city.id = venue.city_id', 'left');
        
        if ($excludeId) {
            $builder->where('event.id !=', $excludeId);
        }
        
        $builder->groupBy('event.id');
        $builder->orderBy('event_date', 'ASC');
        $builder->limit(4);
        
        return $builder->get()->getResultArray();
    }
}
