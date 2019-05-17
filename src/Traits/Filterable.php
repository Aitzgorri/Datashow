<?php

namespace Aitzgorri\Datashow\Traits;

use Aitzgorri\Datashow\Searches\QueryFilter;

trait Filterable
{
    /**
     * @param Builder $builder
     * @param QueryFilter $filters
     * @return QueryFilter
     */
    public function scopeModelFilter($builder, QueryFilter $filters)
    {
        return $filters->apply($builder, $this->text_columns, $this->date_columns, $this->number_columns, $this->order_by);
    }
}