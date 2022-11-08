
<div>
    <form action="{{route('books.save', ['id' => $book->id])}}" method="post">
        {{csrf_token()}}
        <table>
            <tr>
                <td>name</td>
                <td><input type="text" name="name" value="{{$book->name}}">
                @if ($errors->has('name'))
                    <div class="allert alert-danger"> {{$errors->first('name')}}</div>
                @endif
                </td>
            </tr>
            <tr>
                <td>price</td>
                <td><input type="text" name="price" value="{{$book->price}}">
                @if ($errors->has('price'))
                    <div class="allert alert-danger"> {{$errors->first('price')}}</div>
                @endif
                </td>
            </tr>
        </table>
        <input type="submit" value="сохранить">
    </form>
</div>
