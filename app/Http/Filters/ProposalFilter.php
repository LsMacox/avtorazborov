<?php

namespace App\Http\Filters;

use App\Http\Filters\QueryFilter;

class ProposalFilter extends QueryFilter
{

    public function mark($value)
    {
        if ($value !== 'all')
            $this->builder = $this->builder->where('mark', $value);
    }

    public function model($value)
    {
        if ($value !== 'all')
            $this->builder = $this->builder->where('model', $value);
    }

    public function city($value)
    {
        if ($value !== 'all')
            $this->builder = $this->builder->where('city', $value);
    }

}

