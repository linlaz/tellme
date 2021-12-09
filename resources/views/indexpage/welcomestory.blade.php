    <div class="col-md-8 border-end" wire:loading.delay.class="opacity-50">
        @if (session()->has('mustlogin'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('mustlogin') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @foreach ($story as $item)
            <article class="card mb-3" @if ($loop->last) id="last_record" @endif>
                <div class="card-body">
                    <p class="blog-post-meta">{{ $item->created_at }}</p>
                    <div class="mb-3">
                        @isset($item->stories)

                            {!! Str::limit(html_entity_decode(strip_tags($item->stories)), 100, '...') !!}<a href="/story/{{ $item->slug }}">[read complete]</a>
                        @endisset
                        @isset($item->voice)
                            <audio src=""></audio>
                        @endisset
                    </div>
                    <div class="mt-3">
                        @auth
                            @if (!is_null($item->saves->where('user_id',
                            Auth::id())->where('destination','story')->where('destination_id',$item->id)->first()))
                            <button type="button" wire:click="unsave('{{ $item->id }}','story')" class="btn btn-primary bi bi-save"
                                title="unsave this story"></button>
                            @else
                            <button type="button" wire:click="addsave('{{ $item->id }}','story')"
                                class="btn btn-outline-primary bi bi-save" title="save this story"></button>
                            @endif
                        @endauth

                        @guest
                            <button type="button" wire:click="addsave('{{ $item->id }}','story')"
                                class="btn btn-outline-primary bi bi-save" title="save this story"></button>
                        @endguest
                        <a href="/story/{{ $item->slug }}" type="button" class="btn btn-outline-danger bx bxs-comment-detail"
                            title="comment this story"></a>
                        <i type="button" class="btn btn-outline-secondary bi bi-share"
                            data-clipboard-text="http://tellme.test/story/{{ $item->slug }}" title="share this story"
                            onclick="alert('this link copied for you')"></i>
                    </div>
                </div>
            </article>
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
    @endpush
