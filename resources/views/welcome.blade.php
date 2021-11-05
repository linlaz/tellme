<x-AppsLayout>
    <div class="row g-5">
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <p>ingin bercerita ??</p>
                    <p>cerita ga nambah beban ke orang lain kok</p>
                    <p>gasinnn aja <a href="">kesini</a></p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @foreach ($story as $item)
                <article class="card mb-3">
                    <div class="card-body">
                        <p class="blog-post-meta">{{ $item->created_at }}</p>
                        <div class="mb-3">
                        @isset($item->stories)
                            {!! Str::limit($item->stories, 10, '...') !!}<a href="story/{{ $item->slug }}">[lanjutkan]</a>
                        @endisset
                        </div>
                        <div>
                        <i type="button" class="btn btn-primary bx bxs-save" title="save this story"></i>
                        <i type="button" class="btn btn-primary bx bxs-comment-detail" title="comment this story"></i>
                        <i type="button" class="btn btn-primary bx bxs-share-alt" title="comment this story"></i>
                        </div>
                    </div>
                </article>
            @endforeach




        </div>
    </div>
</x-AppsLayout>
