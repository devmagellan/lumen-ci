<?php

namespace WGT\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;

use WGT\Transformers\ProfanityIgnoreTransformer;

class ProfanityIgnorePresenter extends FractalPresenter {

    /**
     * Prepare data to present
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProfanityIgnoreTransformer();
    }
}
