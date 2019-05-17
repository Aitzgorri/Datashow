<?php
/**
 * Created by PhpStorm.
 * User: rr891c
 * Date: 5/14/2019
 * Time: 14:11
 */

namespace Aitzgorri\Datashow\Searches;

use DateTime;

class SearchFilter extends QueryFilter
{
    // Text search
    public function textSearch($column, $value = ''){
        return $this->builder->where($column, 'like', '%' . $value . '%');
    }

    // Date search functions
    public function dateBetween($column, $value = ''){

        $format = 'Y-m-d';

        $d_from = DateTime::createFromFormat($format, $value['from']);
        if($d_from && $d_from->format($format) == $value['from']) {
            self::dateLater($column, $value['from']);
        }

        $d_until = DateTime::createFromFormat($format, $value['until']);
        if($d_until && $d_until->format($format) == $value['until']) {
            self::dateSooner($column, $value['until']);
        }
    }

    public function dateLater($column, $value = '') {
        return $this->builder->where($column, '>=', $value);
    }

    public function dateSooner($column, $value = '') {
        return $this->builder->where($column, '<=', $value);
    }

    // Number search functions
    public function numberBetween($column, $value = ''){
        if(strlen(trim($value['more_than'])) > 0) {
            self::moreThan($column, $value['more_than']);
        }
        if(strlen(trim($value['less_than'])) > 0) {
            self::lessThan($column, $value['less_than']);
        }
    }

    public function moreThan($column, $value = '') {
        return $this->builder->where($column, '>=', $value);
    }

    public function lessThan($column, $value = '') {
        return $this->builder->where($column, '<=', $value);
    }
}