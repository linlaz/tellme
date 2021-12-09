<x-apps-layout>
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
        <div class="col-md-8 border-end">
            @livewire('storypublic.showstory', ['story' => $story,'ip_user'=>$ip_user,'user_id'=>$user_id])
        </div>
        <div class="col-md">
          <x-rightside></x-rightside>
        </div>
    </div>
</x-apps-layout>
