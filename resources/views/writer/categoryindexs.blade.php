<div>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Category</h5>
                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->slug }}</td>
                                        <td>
                                            @can('delete-category')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirm('Are you sure you want to delete this category ? delete category same you delete blog in category this') || event.stopImmediatePropagation()"
                                                    wire:click="delete('{{ $item->id }}')">Delete</button>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
