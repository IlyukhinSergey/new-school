<div>
    <a href="{{route('books.create')}}" id="add">Добавить</a>
    <table class="table table-bordered">
        @foreach($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td>{{$book->name}}</td>
                <td>{{$book->price}}</td>
                <td>
                    <a href="{{route('books.edit', ['id' => $book->id])}}">edit</a>
                    <a href="{{route('books.delete', ['id' => $book->id])}}">delete</a>
                </td>
            </tr>
        @endforeach
    </table>
</div>

