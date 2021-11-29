<x-AppsLayout>

    @if (session()->has('bloked'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('bloked') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-5">
        <div class="col-md d-md-none d-lg-block d-lg-none d-xl-none">
            <div class="card ">
                <div class="card-body">
                    <p>ingin bercerita ??</p>
                    <p>cerita ga nambah beban ke orang lain kok</p>
                    <p>gasinnn aja <a href="/addstory">kesini</a></p>
                </div>
            </div>
        </div>
        @livewire('storypublic.welcomestory')
        <div class="col-md">
           <x-rightside>
           </x-rightside>
        </div>
    </div>
</x-AppsLayout>
