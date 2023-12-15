<?php namespace Visiosoft\ProfileModule\Address\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class UserFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->where('user_id', $filter->getValue());
    }
}
