<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            @foreach ($columns as $column)
            <th>{{ $column['label'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            @foreach ($columns as $column)
            <td>{{ data_get($item, $column['field']) }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
