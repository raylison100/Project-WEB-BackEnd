<?php

namespace App\Transformers;

use App\Models\Event;
use League\Fractal\TransformerAbstract;

/**
 * Class EventTransformer.
 *
 * @package namespace App\Transformers;
 */
class EventTransformer extends TransformerAbstract
{
    /**
     * Transform the Event entity.
     *
     * @param Event $model
     *
     * @return array
     */
    public function transform(Event $model)
    {
        return [
            'id'            => (int) $model->id,
            'status'        => $model->statusEvent->name,
            'subject'       => $model->subject,
            'creator_user'  => $model->users->name,
            'created_at'    => $model->created_at->toDateTimeString(),
            'updated_at'    => $model->updated_at->toDateTimeString(),
            'participant'   => $this->getParticipants($model),
            'messages'      => $this->getMessages($model),
        ];
    }

    private function getMessages($model)
    {
        $messages = array();
        $counter = 0;
        foreach ($model->messages as $message) {
                $posts = [
                    "id"            => $message->user->id,
                    "content"       => $message->content,
                    "name"          => $message->user->name,
                    "email"         => $message->user->email,
                    'created_at'    => $message->created_at->toDateTimeString(),
                    'updated_at'    => $message->updated_at->toDateTimeString(),
                ];
            $messages[$counter] = $posts;
            ++$counter;
            }
        return $messages;
    }

    private function getParticipants($model)
    {
        $participants = array();
        $counter = 0;
        foreach ($model->participants as $participant) {
            $posts = [
                "id"            => $participant->user_id,
                "name"          => $participant->user->name,
            ];
            $participants[$counter] = $posts;
            ++$counter;
        }
        return $participants;
    }
}
