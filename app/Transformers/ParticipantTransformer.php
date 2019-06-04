<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Participant;

/**
 * Class ParticipantTransformer.
 *
 * @package namespace App\Transformers;
 */
class ParticipantTransformer extends TransformerAbstract
{
    /**
     * Transform the Participant entity.
     *
     * @param \App\Models\Participant $model
     *
     * @return array
     */
    public function transform(Participant $model)
    {
        return [
            'id'         => (int) $model->id,


            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
