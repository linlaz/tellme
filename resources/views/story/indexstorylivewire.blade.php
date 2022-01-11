{{-- Nothing in the world is as soft and yielding as water. --}}
@push('style')
    <link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
@endpush
<div wire:loading.delay.class="opacity-50">
    @if (session()->has('success'))
        <x-session-success></x-session-success>
    @endif
    @if (session()->has('failed'))
        <x-session-failed></x-session-failed>
    @endif
    @foreach ($story as $item)
        <article class="card mb-3 border-top fs-5" @if ($loop->last) id="last_record" @endif style="font-family: 'Arvo', serif ;">
            <div class="card-body">
                <div class="position-relative">
                    <p class="blog-post-meta">{{ $item->created_at->diffForHumans() }}</p>
                    <div class="mb-3" style="font-family: Helvetica ;">
                        @isset($item->stories)
                            {!! Str::limit(html_entity_decode(strip_tags($item->stories)), 100, '...') !!}<a href="/story/{{ $item->slug }}">[read complete]</a>
                        @endisset
                        <a href="/story/{{ $item->slug }}" class="stretched-link"></a>
                    </div>
                </div>
                <hr>
                <div wire:key="{{ $loop->index }}">
                    <div class="mt-3">
                        <div class="row">
                            <div class="col text-center">
                                @php
                                    $totalsave = $item->saves
                                        ->where('destination', 'story')
                                        ->where('destination_id', $item->id)
                                        ->count();
                                @endphp
                                @auth
                                    @if (is_null($item->saves->where('user_id', Auth::id())->where('destination',
                                    'story')->where('destination_id', $item->id)->first()))
                                    <button type="button" class="btn btn-outline-primary"
                                        wire:click="addsave('{{ Crypt::encrypt($item->id) }}','story')"
                                        title="save this story"><i class="bi bi-save"></i>
                                        @if ($totalsave != 0)
                                            {{ $totalsave }}
                                        @endif
                                    </button>
                                @else
                                    <button type="button" class="btn btn-primary"
                                        wire:click="unsave('{{ Crypt::encrypt($item->id) }}','story')"
                                        title="unsave this story"><i class="bi bi-save"></i>
                                        @if ($totalsave != 0)
                                            {{ $totalsave }}
                                        @endif
                                    </button>
        @endif
    @endauth
    @guest
        <button type="button" class="btn btn-outline-primary"
            wire:click="addsave('{{ Crypt::encrypt($item->id) }}','story')" title="save this story"><i
                class="bi bi-save"></i>
        </button>
    @endguest
</div>
@php
$totalcomment = $item->comment->where('story_id', $item->id)->count();
@endphp
<div class="col text-center">
    <a href="/story/{{ $item->slug }}" type="button" class="btn btn-outline-danger" title="comment this story"><i
            class="ri-chat-smile-line"></i> @if ($totalcomment != 0) {{ $totalcomment }}  @endif </a>
</div>
<div class="col text-center">
    <button type="button" class="btn btn-outline-secondary"
        data-clipboard-text="http://tellme.test/story/{{ $item->slug }}" title="share this story"
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
