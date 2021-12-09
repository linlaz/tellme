<x-apps-layout>
    {{-- Success is as dangerous as failure. --}}
    <div class="row g-5 mt-3">
        <div class="col-md-9 m-auto ">
           @livewire('blogspublic.showblogs', ['slug' => $slug])
            <h3 class="pb-4 mb-4 fst-italic border-bottom">
                Read More
            </h3>
            @livewire('blogspublic.nextblogs')
        </div>
    </div>


</x-apps-layout>
