<x-app-layout>
    <h1>{{ $user->name }}</h1>
    <div>
     <table class="table datatable">
        <thead>
          <tr>
            <th scope="col">log name</th>
            <th scope="col">action</th>
            <th scope="col">attributes</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($activity as $item)
            <tr>
              <td>{{ $item->log_name }}</td>
              <td>{{ $item->event }}</td>
              <td>{{ $item->changes }}</td>
            </tr>
          @endforeach
        <tbody>
      </table>
      </div>
</x-app-layout>