<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Message;

/**
 * Class MessageTransformer.
 *
 * @package namespace App\Transformers;
 */
class MessageTransformer extends TransformerAbstract
{
    /**
     * Transform the Message entity.
     *
     * @param Message $model
     *
     * @return array
     */
    public function transform(Message $model)
    {
        return [
            'id'         => (int) $model->id,
            'content'    => $model->content,
            'created_at' => $model->created_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
            "user"       => $this->getUser($model),
        ];
    }

    public function getUser($model){
        $user = [
            "user_id"   => $model->user->id,
            "name"      => $model->user->name,
        ];
        return $user;
    }
}
