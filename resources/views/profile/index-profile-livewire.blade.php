{{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
<div>
    @if ($action == 'edit')
        @livewire('action.input-story', ['action' => $action,'idstory' => $subject->id,'stories'=>$subject->stories])
    @endif
    @foreach ($story as $item)
        <div class="card my-2" @if ($loop->last) id="last_record" @endif>
            <div class="card-body" style="transform: rotate(0);">
                <h5 class="card-title">Created at {{ $item->created_at }}</h5>
                {!! Str::limit(strip_tags($item->stories), 200, '...') !!}<a href="/story/{{ $item->slug }}">[read
                    complete]</a>
                <div class="my-2">
                    @if ($item->publish == '1'){{ 'publish' }}@else{{ 'draft' }}@endif.last update
                    {{ $item->updated_at }}
                </div>
                <a href="/story/{{ $item->slug }}" class="stretched-link"></a>
            </div>
            <div class=" card-footer text-muted">
                <div class="row text-center">
                    @if ($item->publish == 0)
                        @can('publish-story')
                            <div class="col">
                                <i wire:click="actionp('1','{{ Crypt::encrypt($item->id) }}')" type="button"
                                    class="btn btn-primary w-100 ri-send-plane-fill" title="publish your story"></i>
                            </div>
                        @endcan
                    @else
                        @can('unpublish-story')
                            <div class="col">
                                <i wire:click="actionp('0','{{ Crypt::encrypt($item->id) }}')" type="button"
                                    class="btn btn-primary w-100 ri-draft-fill" title="unpublish your story"></i>
                            </div>
                        @endcan
                    @endif
                    @if ($item->choice != 'voice')
                        @can('edit-story')
                            <div class="col">
                                <a " wire:click=" editstory('{{ Crypt::encrypt($item->id) }}')" type="button"
                                    class="btn btn-success w-100 ri-edit-box-line" title="edit your story"></a>
                            </div>
                        @endcan
                        @can('history-blog')
                            <div class="col">
                                <a href="/story/history/{{ $item->slug }}" type="button"
                                    class=" btn btn-info w-100 ri-file-history-fill" title="history story"></a>
                            </div>
                        @endcan
                    @endif

                    @can('delete-story')
                        <div class="col">
                            <i onclick="confirm('Are you sure you want to delete this story ?') || event.stopImmediatePropagation()"
                                wire:click="actiondelete('{{ Crypt::encrypt($item->id) }}')" type="button"
                                class="btn btn-danger w-100 ri-delete-bin-5-fill" title="delete your story"></i>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    @endforeach
    @if ($loadAmount >= $totalRecords)
        <div class="alert alert-secondary text-center" role="alert">
            No Remaining Records!
        </div>
    @endif
</div>



@push('script')
    <script>
        const lastRecord = document.getElementById('last_record');
        const options = {
            root: null,
            threshold: 1,
            rootMargin: '0px'
        }
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    @this.loadMore()
                }
            });
        });
        observer.observe(lastRecord);
    </script>
    <script>
        window.addEventListener('successdelete', event => {
            alert('deleted success for story');
        })
    </script>
@endpush
