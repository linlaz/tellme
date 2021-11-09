<x-apps-layout>
    <div class="row g-5">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <p>ingin bercerita ??</p>
                    <p>cerita ga nambah beban ke orang lain kok</p>
                    <p>gasinnn aja <a href="/addstory">kesini</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
                <article class="card mb-3">
                    <div class="card-body">
                        <p class="blog-post-meta">{{ $story->created_at }}</p>
                        <div class="mb-3">
                            @isset($story->stories)
                                {!! $story->stories !!}
                            @endisset
                        </div>
                        <div>
                            <i type="button" class="btn btn-primary bx bxs-save" title="save this story"></i>
                            <i type="button" class="btn btn-primary bx bxs-share-alt" title="comment this story"></i>
                        </div>
                    </div>
                </article>
        </div>
    </div>
</x-apps-layout>
