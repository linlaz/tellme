<x-app-layout>
    @can('add-story')
    <a type="button" class="btn btn-info btn-lg" href="{{ route('addstory') }}"> 
        <i class="bi bi-plus-lg"></i>
        Add Story
    </a>
    @endcan
    <livewire:indexstory>
        
    </livewire:indexstory>

</x-app-layout>