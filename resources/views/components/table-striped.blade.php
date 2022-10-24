<table class="table table-bordered table-striped align-middle">
    <thead>
    <tr class="table-success">
        @foreach($headings as $heading)
            <th scope="col">{{$heading}}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    {{ $slot }}
    </tbody>
</table>
