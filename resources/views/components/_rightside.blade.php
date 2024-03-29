<!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
<div class="position-sticky d-sm-none d-none d-sm-block d-md-block" style="top: 2rem;">
    <div class="p-4 mb-3 bg-light rounded">
        <p>ingin bercerita ??</p>
        <p>cerita ga nambah beban ke orang lain kok</p>
        <p>gasinnn aja <a href="/addstory">kesini</a></p>
    </div>
    
    <div class="p-4">
        @foreach ($blog as $item)
            <div class="card mb-1" style="border: none">
                <div class="card-body">
                    <h3>{{ $item->title }}</h3>
                    <p class="card-text">
                        <small class="text-muted">{{ $item->category->name }}</small>
                    </p>
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
