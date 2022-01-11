{{-- The best athlete wants his opponent at his best. --}}
<div>
    @foreach ($blog as $item)
        <div class="card my-2">
            <div class="card-body" style="transform: rotate(0);">
                <h1 class="card-text my-3">{{ $item->title }}</h1>
                {!! Str::limit(strip_tags($item->text), 200, '...') !!}
                <div>
                    <p><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-bar-chart" viewBox="0 0 16 16">
                            <path
                                d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z">
                            </path>
                        </svg>
                        {{ $item->views->where('destination', 'blog')->count() }} || @if ($item->publish){{ 'publish' }}@else{{ 'draft' }}@endif.last
                        update {{ $item->updated_at }}
                        |
                        {{ $item->category->name }}
                        |
                        <i
                            class="ri-save-3-fill"></i>{{ $item->saves->where('user_id', Auth::id())->where('destination', 'blog')->count() }}
                    </p>
                    <a href="/blogs/{{ $item->slug }}" class="stretched-link"></a>
                </div>
            </div>

            <div class="card-footer text-muted">
                @if ($item->publish)
                    @can('unpublish-blog')
                        <i wire:click="actionp('1','{{ Crypt::encrypt($item->id) }}')" type="button"
                            class="btn btn-primary m-2 ri-draft-fill" title="unpublish your blog"></i>
                    @endcan
                @else
                    @can('publish-blog')
                        <i ire:click="actionp('0','{{ Crypt::encrypt($item->id) }}')" type="button"
                            class="btn btn-primary m-2 ri-send-plane-fill" title="publih your blog"></i>
                    @endcan
                @endif
                @can('edit-blog')
                    <a href="/dashboard/blog/{{ $item->slug }}/edit" type="button" class="btn btn-success ri-edit-box-line"
                        title="edit your blog"></a>
                @endcan
                @can('history-blog')
                    <a href="/blog/history/{{ $item->slug }}" type="button" class="btn btn-info ri-file-history-fill m-2"
                        title="history your blog"></a>
                @endcan
                @can('delete-blog')
                    <i onclick="confirm('Are you sure you want to delete this blog ?') || event.stopImmediatePropagation()"
                        wire:click="actiondelete('{{ Crypt::encrypt($item->id) }}')" type="button"
                        class="btn btn-danger ri-delete-bin-5-fill" title="delete your blog"></i>
                @endcan

                <i wire:click="show('{{ $item->id }}')" type="button" class="btn btn-secondary bx bx-show-alt m-2"
                    title="show your blog"></i>
            </div>
        </div>
    @endforeach
    {{ $blog->links() }}
</div>
@push('script')
    <script>
        window.addEventListener('successdelete', event => {
            alert('deleted success for story');
        })
    </script>
@endpush
