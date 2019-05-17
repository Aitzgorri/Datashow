<?php
/**
 * Created by PhpStorm.
 * User: rr891c
 * Date: 5/14/2019
 * Time: 14:11
 */

namespace Aitzgorri\Datashow\Searches;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter
{
    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;
    /**
     * Create a new QueryFilters instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply(Builder $builder, $text_columns = [], $date_columns = [], $number_columns = [], $order_by = 'id') {

        $this->builder = $builder;
        $searchValuesArray = $this->filters()->all();

        foreach ($searchValuesArray as $name => $value) {

            // ensure '' is not passed as search value
            if(is_array($value)){
                $trimCheck = implode($value);
            } else {
                $trimCheck = $value;
            }

            if (strlen(trim($trimCheck)) > 0) {
                if (method_exists($this, $name)) {
                    call_user_func_array([$this, $name], array_filter([$value]));
                } elseif (in_array($name,$text_columns)) {
                    call_user_func_array([$this, 'textSearch'], array_filter([$name, $value]));
                } elseif (in_array($name,$date_columns)) {
                    call_user_func_array([$this, 'dateBetween'], array_filter([$name, $value]));
                } elseif (in_array($name,$number_columns)) {
                    call_user_func_array([$this, 'numberBetween'], array_filter([$name, $value]));
                }
            }
        }

        return $this->builder->orderBy($order_by, 'desc')->limit($this->filters()['limit']);

    }

    public function filters() {
        return $this->request;
    }
}