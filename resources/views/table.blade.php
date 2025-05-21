@extends('layout.template')

@section('content')
<h2>Points</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 10%;">No</th>
                <th scope="col" class="text-center" style="width: 20%;">Name</th>
                <th scope="col" class="text-center" style="width: 30%;">Description</th>
                <th scope="col" class="text-center" style="width: 20%;">Gambar</th>
                <th scope="col" class="text-center" style="width: 10%;">Created at</th>
                <th scope="col" class="text-center" style="width: 10%;">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($points as $p)
                <tr>
                    <td class="text-center"> {{ $p->id }} </td>
                    <td> {{ $p->name }} </td>
                    <td> {{ $p->description }} </td>
                    <td class="text-center">
                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="" class="img-thumbnail"
                            width="100">
                    </td>
                    <td class="text-center"> {{ $p->created_at }} </td>
                    <td class="text-center"> {{ $p->updated_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Polylines</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 10%;">No</th>
                <th scope="col" class="text-center" style="width: 20%;">Name</th>
                <th scope="col" class="text-center" style="width: 30%;">Description</th>
                <th scope="col" class="text-center" style="width: 20%;">Gambar</th>
                <th scope="col" class="text-center" style="width: 10%;">Created at</th>
                <th scope="col" class="text-center" style="width: 10%;">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($polylines as $p)
                <tr>
                    <td class="text-center"> {{ $p->id }} </td>
                    <td> {{ $p->name }} </td>
                    <td> {{ $p->description }} </td>
                    <td class="text-center">
                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="" class="img-thumbnail"
                            width="100">
                    </td>
                    <td class="text-center"> {{ $p->created_at }} </td>
                    <td class="text-center"> {{ $p->updated_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Polygons</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center" style="width: 10%;">No</th>
                <th scope="col" class="text-center" style="width: 20%;">Name</th>
                <th scope="col" class="text-center" style="width: 30%;">Description</th>
                <th scope="col" class="text-center" style="width: 20%;">Gambar</th>
                <th scope="col" class="text-center" style="width: 10%;">Created at</th>
                <th scope="col" class="text-center" style="width: 10%;">Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($polygons as $p)
                <tr>
                    <td class="text-center"> {{ $p->id }} </td>
                    <td> {{ $p->name }} </td>
                    <td> {{ $p->description }} </td>
                    <td class="text-center">
                        <img src="{{ asset('storage/images/' . $p->image) }}" alt="" class="img-thumbnail"
                            width="100">
                    </td>
                    <td class="text-center"> {{ $p->created_at }} </td>
                    <td class="text-center"> {{ $p->updated_at }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
