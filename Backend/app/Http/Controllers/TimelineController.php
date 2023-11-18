<?php

namespace App\Http\Controllers;

use App\Http\Requests\TimelineRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\TimelineResource;
use App\Repositories\Timeline\CommentRepository;
use App\Repositories\Timeline\TimelineReactionRepository;
use App\Repositories\Timeline\TimelineRepository;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class TimelineController extends Controller
{
    public function __construct(
        public TimelineRepository $timelineRepository,
        public TimelineReactionRepository $timelineReactionRepository,
        public CommentRepository $commentRepository
    ){}

    public function getTimelines(): JsonResponse
    {
        $timelines = $this->timelineRepository->getPersonalizeTimelines();
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

    public function getTimelineDetail($timelineId): JsonResponse
    {
        $timeline = $this->timelineRepository->query()
            ->withCount('comments')
            ->with(['comments' => function(HasMany $comments) {
                $comments->latest()
                    ->with('user')
                    ->take(15);
            }, 'images'])
            ->findOrFail($timelineId);

        return $this->jsonResponse(
            'Timeline detail',
            new TimelineResource($timeline)
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

    public function storeComment($timelineId, Request $request): JsonResponse
    {
        $request->validate(['comment' => 'required|max:255']);

        $timeline = $this->timelineRepository->findOrFail($timelineId);
        $user = auth()->user();

        $comment = $this->commentRepository->addNew($timeline, $user, $request->get('comment'));
        $comment->load('user');
        return $this->jsonResponse(
            'Stored comment successfully',
            new CommentResource($comment),
            ResponseAlias::HTTP_CREATED
        );
    }
}
