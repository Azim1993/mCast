<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimelineRequest;
use App\Http\Resources\TimelineResource;
use App\Repositories\Timeline\TimelineReactionRepository;
use App\Repositories\Timeline\TimelineRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TimelineController extends Controller
{
    public function __construct(
        public TimelineRepository $timelineRepository,
        public TimelineReactionRepository $timelineReactionRepository
    ){}

    public function getTimelines(): JsonResponse
    {
        $timelines = $this->timelineRepository->getTimelines();
        return $this->jsonResponse(
            'Your timeline list',
            new LengthAwarePaginator(
                TimelineResource::collection($timelines->items()),
                $timelines->total(),
                $timelines->perPage(),
                $timelines->currentPage(),
                [
                    'path' => config('app.url') . '/api'
                ]
            )
        );
    }

    public function storeTimeline(TimelineRequest $request): JsonResponse
    {
        $timeline = $this->timelineRepository->addnew($request);
        $timeline->load('user');

        return $this->jsonResponse(
            'Timeline store successfully',
            new TimelineResource($timeline),
            ResponseAlias::HTTP_CREATED
        );
    }

    public function toggleReaction($timelineId): JsonResponse
    {
        $user = auth()->user();
        $timeline = $this->timelineRepository->findOrFail($timelineId);

        if ($this->timelineReactionRepository->firstExist($timeline, $user)) {
            $this->timelineReactionRepository->remove($timeline, $user);
            return $this->jsonResponse('Removed reaction successfully');
        }

        $this->timelineReactionRepository->add($timeline, $user);
        return $this->jsonResponse('Added reaction successfully');
    }


}
