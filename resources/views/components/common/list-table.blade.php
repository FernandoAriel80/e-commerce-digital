@props([
'header_list'
])
<div class="list-table-container">
    <table class="list-table">
        <thead class="list-header-table">
            <tr>
                @foreach($header_list as $header_name)
                <th>{{ $header_name }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="list-body-table">
            {{ $slot }}
        </tbody>
    </table>
</div>