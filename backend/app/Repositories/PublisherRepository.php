<?php

namespace App\Repositories;

use App\Models\Publisher;

class PublisherRepository
{
    public function getActivePublishers()
    {
        return Publisher::where('status','1')
            ->orderBy('name','asc')
            ->select('id','name')
            ->get();
    }
}