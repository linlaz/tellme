{{-- Nothing in the world is as soft and yielding as water. --}}
@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Arvo&family=Rubik:wght@300&display=swap" rel="stylesheet">
@endpush
<div wire:loading.delay.class="opacity-50" class="py-1">
     @if (session()->has('success'))
         <x-session-success></x-session-success>
     @endif
     @if (session()->has('failed'))
         <x-session-failed></x-session-failed>
     @endif
    @foreach ($blog as $item)
        <article class="card my-3 border-top fs-5" @if ($loop->last) id="last_record" @endif style="font-family: 'Arvo', serif ;">
            <div class="card-body">
                 <p class="blog-post-meta">{{ $item->created_at->diffForHumans() }} | <a href="/blog/category/{{ $item->category->slug }}">{{ $item->category->name }}</a> </p>
                <div class="position-relative">
                    <div class="title-blog mb-2">
                        <h3>{{ $item->title }}</h3>
                    </div>
                    <div class="banner-blog mb-3">
                        <img src="https://source.unsplash.com/1600x900/?{{ $item->category->name }},{{ $item->title }},random" class="img-fluid" alt="...">
                    </div>
                    <div class="mb-3" >
                        @isset($item->text)
                            <p> {!! Str::limit(html_entity_decode(strip_tags($item->text)), 100, '...') !!}<a href="/blog/read/{{ $item->slug }}">[read complete]</a></p>
                        @endisset
                        <a href="/blog/read/{{ $item->slug }}" class="stretched-link"></a>
                    </div>
                </div>
                <hr>
                <div wire:key="{{ $loop->index }}">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col text-center">
                                @php
                                    $totalsave = $item->saves
                                        ->where('destination', 'blog')
                                        ->where('destination_id', $item->id)
                                        ->count();
                                @endphp
                                @auth
                                    @if (is_null($item->saves->where('user_id', Auth::id())->where('destination',
                                    'blog')->where('destination_id', $item->id)->first()))
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click="addsave('{{ $item->id }}','blog')" title="save this blog"><i
                                            class="bi bi-save"></i>
                                        @if ($totalsave != 0)
                                            {{ $totalsave }}
                                        @endif
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary"
                                        wire:click="unsave('{{ $item->id }}','blog')" title="unsave this blog"><i
                                            class="bi bi-save"></i>
                                        @if ($totalsave != 0)
                                            {{ $totalsave }}
                                        @endif
                                    </button>
                                    @endif
                                @endauth
                                @guest
                                    <button type="button" class="btn btn-outline-primary" wire:click="addsave('{{ $item->id }}','blog')" title="save this blog"><i
                                            class="bi bi-save"></i>
                                    </button>
                                @endguest
                            </div>
                            <div class="col text-center">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-clipboard-text="http://tellme.test/blog/{{ $item->slug }}" title="share this blog"
                                    onclick="alert('this link copied for you')"><i class="bi bi-share"></i>
                                </button>
                            </div>
                        </div>
                    </div>
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
