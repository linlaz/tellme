<div>
    @foreach ($stories as $item)
        <div class="card my-2">
            <div class="card-body">
                <h5 class="card-title">Created at {{ $item->created_at }}</h5>
                {!! Str::limit(strip_tags($item->stories), 200, '...') !!}
            </div>
            <div class="card-footer text-muted">
                @if ($item->publish == 0)
                    @can('publish-story')
                        <i wire:click="actionp('1','{{ $item->id }}')" type="button"
                            class="btn btn-primary m-2 ri-send-plane-fill" title="publish your blog"></i>
                    @endcan
                @else
                    @can('unpublish-story')
                        <i wire:click="actionp('0','{{ $item->id }}')" type="button"
                            class="btn btn-primary m-2 ri-draft-fill" title="unpublish your blog"></i>
                    @endcan
                @endif
                @if ($item->choice != 'voice')
                    @can('edit-story')
                        <a href="/dashboard/edit/{{ $item->slug }}" type="button" class="btn btn-success ri-edit-box-line"
                            title="edit your blog"></a>
                    @endcan
                    @can('history-blog')
                        <a href="/story/history/{{ $item->slug }}" type="button" class="m-2 btn btn-info ri-file-history-fill"
                            title="history story"></a>
                    @endcan
                @endif
                @can('delete-story')
                    <i onclick="confirm('Are you sure you want to delete this story ?') || event.stopImmediatePropagation()"
                        wire:click="actionp('d','{{ $item->id }}')" type="button"
                        class="btn btn-danger ri-delete-bin-5-fill" title="delete your blog"></i>
                @endcan

                <i type="button" class=" m-2 btn btn-secondary bx bx-show-alt" title="show your blog"></i>
            </div>
        </div>
    @endforeach
    {{ $stories->links() }}
</div>
