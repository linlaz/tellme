<x-app-layout>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    blog now
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div>
                        <h1>{{ $nowblog->title }}</h1>
                        <h6>{{ $nowblog->Category->name }}</h6>
                        {!! $nowblog->text !!}
                    </div>
                </div>
            </div>
        </div>
        @foreach ($history as $item)
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo{{ $item->id }}" aria-expanded="false"
                        aria-controls="collapseTwo">
                        history blog {{ $item->event }} at {{ $item->created_at }} by {{ $item->user->name }}
                    </button>
                </h2>
                <div id="collapseTwo{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @php
                            $blog = json_decode($item->properties)->attributes;
                        @endphp
                        @isset($blog->title)
                            <p>title : {{ $blog->title }} </p>
                        @endisset
                        @isset($blog->text)
                            <p>teks : </p>{!! $blog->text !!}
                        @endisset
                        @isset($blog->publish)
                            <p>status : @if ($blog->publish == 1)
                                    {{ 'publish' }}
                                @else
                                    {{ 'draft' }}
                                @endif
                            </p>
                        @endisset
                        @can('delete-history-blog')
                            @livewire('historyblog',['idhistory'=>$item->id])
                            {{-- <i onclick="confirm('Are you sure you want to delete this blog ?') || event.stopImmediatePropagation()"
                                wire:click="actionp('delete','1','{{ $item->id }}')" type="button"
                                class="btn btn-danger m-2 ri-delete-bin-5-fill" title="delete your blog">
                            </i> --}}
                        @endcan
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</x-app-layout>
