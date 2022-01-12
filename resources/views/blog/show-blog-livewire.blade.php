{{-- Care about people's approval and you will be their prisoner. --}}
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
    <article class="card my-3 border-top fs-5" style="font-family: 'Arvo', serif ;" style="word-wrap: break-word;">
        <div class="card-body">
            <p class="blog-post-meta">{{ $blog->created_at->diffForHumans() }} | <a
                    href="/blog/category/{{ $blog->category->slug }}">{{ $blog->category->name }}</a> </p>
            <div class="position-relative">
                <div class="title-blog mb-2">
                    <h3>{{ $blog->title }}</h3>
                </div>
                <div class="banner-blog mb-3">
                    <img src="https://source.unsplash.com/1600x900/?{{ $blog->category->name }},{{ $blog->title }},random"
                        class="img-fluid" alt="...">
                </div>
                <div class="mb-3">
                    @isset($blog->text)
                        {!! $blog->text !!}
                    @endisset
                </div>
            </div>
            <hr>
            <div>
                <div class="mt-3">
                    <div class="row">
                        <div class="col text-center">
                            @php
                                $totalsave = $blog->saves
                                    ->where('destination', 'blog')
                                    ->where('destination_id', $blog->id)
                                    ->count();
                            @endphp
                            @auth
                                @if (is_null($blog->saves->where('user_id', Auth::id())->where('destination',
                                'blog')->where('destination_id', $blog->id)->first()))
                                <button type="button" class="btn btn-outline-primary"
                                    wire:click="addsave('{{ Crypt::encrypt($blog->id) }}','blog')" title="save this blog"><i
                                        class="bi bi-save"></i>
                                    @if ($totalsave != 0)
                                        {{ $totalsave }}
                                    @endif
                                </button>
                            @else
                                <button type="button" class="btn btn-primary"
                                    wire:click="unsave('{{ Crypt::encrypt($blog->id) }}','blog')" title="unsave this blog"><i
                                        class="bi bi-save"></i>
                                    @if ($totalsave != 0)
                                        {{ $totalsave }}
                                    @endif
                                </button>
                                @endif
                            @endauth
                            @guest
                                <button type="button" class="btn btn-outline-primary"
                                    wire:click="addsave('{{ Crypt::encrypt($blog->id) }}','blog')" title="save this blog"><i
                                        class="bi bi-save"></i>
                                </button>
                            @endguest
                        </div>
                        <div class="col text-center">
                            <button type="button" class="btn btn-outline-secondary"
                                data-clipboard-text="http://tellme.test/blog/{{ $blog->slug }}"
                                title="share this blog" onclick="alert('this link copied for you')"><i
                                    class="bi bi-share"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
