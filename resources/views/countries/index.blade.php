<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">ISO</th>
            <th scope="col">Edit</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($countries as $country)
            <tr>
                <th scope="row">{{ $country->id }}</th>
                <td>{{ $country->name }}</td>
                <td>{{ $country->code }}</td>
                <td class="d-flex gap-1">
                    <a href="{{ route('dashboard', ['country_id' => $country->id])}}" class="btn btn-primary">Edit</a>
                    <form action="{{ route('country.destroy', $country->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
