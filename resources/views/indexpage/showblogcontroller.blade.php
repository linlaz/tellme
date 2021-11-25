<x-apps-layout>
    {{-- Success is as dangerous as failure. --}}
    <div class="row g-5 mt-3">
        <div class="col-md-9 m-auto ">
           @livewire('blogspublic.showblogs', ['blog' => $blog])
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Read More
            </h3>
            @foreach ($next as $item)
                <article class="blog-post mb-3">
                    <h3 class="blog-post-title">
                        {{ $item->title }}
                    </h3>
                    <p class="blog-post-meta">{{ $item->created_at }} | <a
                            href="blogs?category={{ $item->category->slug }}">{{ $item->category->name }}</a></p>
                    <div class="mb-3">
                        @isset($item->text)
                            {!! Str::limit(strip_tags($item->text), 200, '...') !!}<a href="/blogs/{{ $item->slug }}">[read complete]</a>
                        @endisset
                    </div>
                    <div class="mt-3">
                        <i type="button" wire:click="addlist('{{ $item->id }}','story')"
                            class="btn btn-outline-primary bi bi-save" title="save this story"></i>

                        <i type="button" class="btn btn-outline-secondary bi bi-share" title="comment this story"></i>
                    </div>
                </article>
                <hr>
            @endforeach
        </div>
    </div>


</x-apps-layout>
