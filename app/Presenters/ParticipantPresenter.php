<?php

namespace App\Presenters;

use App\Transformers\ParticipantTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ParticipantPresenter.
 *
 * @package namespace App\Presenters;
 */
class ParticipantPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ParticipantTransformer();
    }
}
