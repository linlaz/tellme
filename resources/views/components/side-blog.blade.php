<!-- It is quality rather than quantity that matters. - Lucius Annaeus Seneca -->
<!-- Waste no more time arguing what a good man should be, be one. - Marcus Aurelius -->

<div class="position-sticky my-4" style="top: 2rem;">
    <h2 class="text-center"> Trending Blog </h2>
    @foreach ($trending as $item)
        <article class="card mb-3">
            <div class="card-body">
                <p class="blog-post-meta">{{ $item->title }}</p>
                <div class="mb-3 ">
                    {!! Str::limit(html_entity_decode(strip_tags($item->text)), 100, '...') !!}<a href="/story/{{ $item->slug }}">[read complete]</a>
                </div>
            </div>
        </article>
    @endforeach
</div>
