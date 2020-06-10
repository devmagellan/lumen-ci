<?php

namespace WGT\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use WGT\Repositories\CurrencyRepository;
use WGT\Models\Currency;
use WGT\Validators\CurrencyValidator;

/**
 * Class CurrencyRepositoryEloquent.
 *
 * @package namespace WGT\Repositories;
 */
class CurrencyRepositoryEloquent extends BaseRepository implements CurrencyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Currency::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
