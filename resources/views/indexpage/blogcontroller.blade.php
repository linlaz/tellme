<x-AppsLayout>
    <div class="container nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            @foreach ($category as $item)
                <a class="p-2 link-secondary" href="#">{{ $item->name }}</a>
            @endforeach
        </nav>
    </div>
    <hr>
    <div class="row g-5">
        {{-- <div class="col-md d-md-none d-lg-block d-lg-none d-xl-none">
            <div class="p-4 mb-1 bg-light rounded">
                <p>ingin bercerita ??</p>
                <p>cerita ga nambah beban ke orang lain kok</p>
                <p>gasinnn aja <a href="/addstory">kesini</a></p>
            </div>
        </div> --}}
        <div class="col-md-8 border-end">
            @livewire('blogspublic.showallblogs')
        </div>
        <div class="col-md">
            <div class="position-sticky d-sm-none d-none d-sm-block d-md-block" style="top: 2rem;">
                <div class="p-4 mb-3 bg-light rounded">
                    <p>ingin bercerita ??</p>
                    <p>cerita ga nambah beban ke orang lain kok</p>
                    <p>gasinnn aja <a href="/addstory">kesini</a></p>
                </div>
                <div class="p-4">
                    <h4 class="fst-italic">More Views</h4>
                    @foreach ($trending as $item)
                        <div class="card mb-1" style="border: none">
                            <div class="card-body">
                                <h4>{{ $item->title }}</h4>
                                {!! Str::limit(html_entity_decode(strip_tags($item->text)), 50, '...') !!}<a href="blogs/{{ $item->slug }}">[read
                                    complete]</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-4">
                    <h4 class="fst-italic">Elsewhere</h4>
                    <ol class="list-unstyled">
                        <li><a href="#">GitHub</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</x-AppsLayout>
