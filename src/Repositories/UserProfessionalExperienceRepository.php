<?php

namespace WGT\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use Prettus\Repository\Traits\CacheableRepository;
use WGT\UserProfessionalExperience;

class UserProfessionalExperienceRepository extends BaseRepository implements CacheableInterface
{
    use CacheableRepository;

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return UserProfessionalExperience::class;
    }

    /**
     * @return string
     */
    public function presenter(): string
    {
        return ModelFractalPresenter::class;
    }
}
