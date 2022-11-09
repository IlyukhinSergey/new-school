
<div>
    <form action="{{route('books.add')}}" method="post">
        @csrf
        <table>
            <tr>
                <td>name</td>
                <td><input type="text" name="name">
                @if ($errors->has('name'))
                    <div class="allert alert-danger"> {{$errors->first('name')}}</div>
                @endif
                </td>
            </tr>
            <tr>
                <td>price</td>
                <td><input type="text" name="price">
                @if ($errors->has('price'))
                    <div class="allert alert-danger"> {{$errors->first('price')}}</div>
                @endif
                </td>
            </tr>
        </table>
        <input type="submit" value="создать">
    </form>
</div>
