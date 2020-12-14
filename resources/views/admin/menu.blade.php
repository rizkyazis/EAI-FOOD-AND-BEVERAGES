@extends('./layouts/admin')

@section('content')
    <div class="container">
        <br/>
        <br/>
        <h2 align="center">Menu</h2>
        <a href="{{route('admin.menu.add.index')}}" class="btn btn-success">Add Menu</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $index=>$item)
            <tr>
                <th scope="row">{{$index+1}}</th>
                <td>{{$item['name']}}</td>
                <td>{{$item['type']}}</td>
                <td>{{$item['price']}}</td>
                <td>
                    <form action="{{route('admin.menu.delete',$item['id'])}}" method="post">
                        @csrf
                        <a href="{{route('admin.menu.edit.index',$item['id'])}}" class="btn btn-sm btn-primary">Edit</a>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
