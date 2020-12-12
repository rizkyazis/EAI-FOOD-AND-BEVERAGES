@extends('./layouts/admin')

@section('content')
    <div class="container">
        <br/>
        <br/>
        <h2 align="center">Add Menu</h2>
        <div class="form-group">
            <form action="{{route('admin.menu.edit',$menu->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row mt-2 mb-2">
                    <input type="text" name="name" value="{{$menu->name}}" class="form-control" placeholder="Name">
                </div>
                <div class="row mt-2 mb-2">
                    <textarea name="description" cols="30" rows="10" class="form-control"
                              placeholder="Description">{{$menu->description}}</textarea>
                </div>
                <div class="row mt-2 mb-2">
                    <div class="col-4">
                        <select name="category_id" placeholder="Category" name="type" class="form-control">
                            @foreach($category as $item)
                                <option value="{{$item['id']}}" @if($item['id']===$menu->category_id) selected @endif>{{$item['name']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <select name="type" placeholder="Type" name="type" class="form-control">
                            <option value="food" @if('food'===$menu->type) selected @endif>Food</option>
                            <option value="drink" @if('drink'===$menu->type) selected @endif>Drink</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="number" value="{{$menu->price}}" name="price" class="form-control" placeholder="Price">
                    </div>
                </div>
                <div class=" border border-secondary p-3 rounded" id="dynamic_field">
                    <h5>Ingredient</h5>
                    @foreach($menu->ingredients as $index=>$ingredient)
                        <div class="row mt-2 mb-2 " id="row{{$index}}">
                            <div class="col-8">
                                <select name="ingredient_id[{{$index}}]" placeholder="Ingredient" class="form-control">
                                    @foreach($data as $item)
                                        <option value="{{$item['_id']}}" @if($item['_id']===$ingredient->ingredient_id) selected @endif>{{$item['nama']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="number" name="quantity[{{$index}}]" value="{{$ingredient->quantity}}" placeholder="Quantity" class="form-control">
                            </div>
                            <div class="col-2">
                                @if($index == 0)
                                    <button type="button" name="add" id="add" class="btn btn-success">Add More</button>
                                @else
                                    <button type="button" name="remove" id="{{$index}}" class="btn btn_remove btn-danger">X</button>'
                                @endif

                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row mt-2 mb-2 w-25">
                    <input type="file" name="image" class="form-control">
                </div>
                <input type="submit" name="submit" id="submit" class="btn btn-primary mt-5" value="Submit"/>
            </form>
        </div>
    </div>
    @push('script')
        <script>
            $(document).ready(function () {
                var i = {{count($menu->ingredients)}}-1;
                $('#add').click(function () {
                    i++;
                    $('#dynamic_field').append('' +
                        '<div class="row mt-2 mb-2" id="row' + i + '">' +
                        '   <div class="col-8">' +
                        '       <select name="ingredient_id[' + i + ']" placeholder="Ingredient" class="form-control">'
                        @foreach($data as $item)+
                        '           <option value="{{$item['_id']}}">{{$item['nama']}}</option>'
                        @endforeach+
                        '       </select>' +
                        '   </div>' +
                        '   <div class="col-2">' +
                        '       <input type="number" name="quantity[' + i + ']" placeholder="Quantity" class="form-control">' +
                        '   </div>' +
                        '   <div class="col-2">' +
                        '       <button type="button" name="remove" id="' + i + '" class="btn btn_remove btn-danger">' +
                        '           X' +
                        '       </button>' +
                        '   </div>' +
                        '</div>')
                });
                $(document).on('click', '.btn_remove', function () {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
            });
        </script>
    @endpush
@endsection
