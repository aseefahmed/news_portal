<div class="row">
    <a href="{{ route('htmltopdfview',['download'=>'pdf']) }}">Download PDF</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Details</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->id }}</td>
        </tr>
        @endforeach
    </table>
</div>