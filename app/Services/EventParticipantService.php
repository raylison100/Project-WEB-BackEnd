<?php


namespace App\Services;

use App\Repositories\EventParticipantRepository;
use App\Repositories\ParticipantRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventParticipantService
{
    protected $participantRepository;

    protected $eventParticipantsRepository;

    public function __construct(ParticipantRepository $participantRepository, EventParticipantRepository $eventParticipantsRepository)
    {
        $this->participantRepository = $participantRepository;
        $this->eventParticipantsRepository = $eventParticipantsRepository;
    }

    public function participantAdd($event_id)
    {

        try {
            DB::beginTransaction();
            $data['user_id'] = Auth::user()->getAuthIdentifier();
            if ($this->validationParticipation($data['user_id'], $event_id)) {
                $participants = $this->participantRepository->create($data);
                $event_participant = [
                    "participant_id" => $participants->id,
                    "event_id" => $event_id
                ];
                $this->eventParticipantsRepository->create($event_participant);
                DB::commit();
                return [
                    'success' => 'User include in event'
                ];
            } else {
                return [
                    'success' => 'User already in event'
                ];
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'error' => true,
//                'message' => "Failed to create data"
                'message' => $e->getMessage()
            ];

        }
    }

    public function validationParticipation($user_id, $event_id)
    {

        $model = DB::select("SELECT event_id FROM event_participant INNER JOIN events  ON event_participant.event_id = events.id 
                                    INNER JOIN participants ON participants.id = event_participant.participant_id 
                                    WHERE participants.user_id = ? AND events.id = ?", [$user_id, $event_id,]);
        if (empty($model)) {
            return true;
        }
        return false;
    }
}
