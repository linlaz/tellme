<x-app-layout>
    @can('add-blog')
        <a type="button" class="btn btn-info btn-lg" href="{{ route('createblog') }}">
            <i class="bi bi-plus-lg"></i>
            Add blog
        </a>
    @endcan
    <livewire:indexblog />
</x-app-layout>
