@extends('./layouts/admin')

@section('content')
    <div class="container">
        <h2 align="center">Category</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
            </tr>
            </thead>
            <tbody>
                @foreach($category as $index=>$item)
                    <tr>
                        <td>{{$index+1}}</td>
                        <td>{{$item->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
