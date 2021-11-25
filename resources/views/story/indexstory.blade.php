<div>
    @foreach ($stories as $item)
        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title">Created at {{ $item->created_at }}</h5>
                {!! Str::limit(strip_tags($item->stories), 200, '...') !!}
                @can('show-story')
                    <div class="my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bar-chart" viewBox="0 0 16 16">
                            <path
                                d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z">
                            </path>
                        </svg>
                        {{ $item->views->where('destination', 'story')->count() }} || @if ($item->publish == '1'){{ 'publish' }}@else{{ 'draft' }}@endif.last update
                        {{ $item->updated_at }} | <i
                            class="ri-save-3-fill"></i>{{ $item->saves->where('user_id', Auth::id())->where('destination', 'story')->count() }}
                        </>
                    </div>
                @endcan
            </div>
            <div class="card-footer text-muted">
                @if ($item->publish == 0)
                    @can('publish-story')
                        <i wire:click="actionp('1','{{ $item->id }}')" type="button"
                            class="btn btn-primary m-2 ri-send-plane-fill" title="publish your story"></i>
                    @endcan
                @else
                    @can('unpublish-story')
                        <i wire:click="actionp('0','{{ $item->id }}')" type="button"
                            class="btn btn-primary m-2 ri-draft-fill" title="unpublish your story"></i>
                    @endcan
                @endif
                @if ($item->choice != 'voice')
                    @can('edit-story')
                        <a href="/dashboard/edit/{{ $item->slug }}" type="button" class="btn btn-success ri-edit-box-line"
                            title="edit your story"></a>
                    @endcan
                    @can('history-blog')
                        <a href="/storyhistory/{{ $item->slug }}" type="button"
                            class="m-2 btn btn-info ri-file-history-fill" title="history story"></a>
                    @endcan
                @endif
                @can('delete-story')
                    <i onclick="confirm('Are you sure you want to delete this story ?') || event.stopImmediatePropagation()"
                        wire:click="actionp('d','{{ $item->id }}')" type="button"
                        class="btn btn-danger ri-delete-bin-5-fill" title="delete your story"></i>
                @endcan
                <i type="button" class=" m-2 btn btn-secondary bx bx-show-alt" title="show your story"></i>
            </div>
        </div>
    @endforeach
    {{ $stories->links() }}
</div>
