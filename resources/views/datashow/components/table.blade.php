<table>
    <thead>
    <tr>
        @forelse($columns as $heading)
            <th>{{ $heading }}</th>
        @empty
            <th>No columns identified</th>
        @endforelse
    </tr>
    </thead>
    <tbody>
        @forelse($model as $value)
            <tr>
                @forelse($columns as $index)
                    <td>{{ $value[$index] }}</td>
                @empty
                    <td>No value retrieved</td>
                @endforelse
            </tr>
        @empty
            <tr>
                <td>No record retrieved</td>
            </tr>
        @endforelse
    </tbody>
</table>