@extends('layout.template')

@section('content')
    <div class="container mt-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h4>Points Table</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id=pointstable>
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="">No</th>
                            <th scope="col" class="text-center" style="">Name</th>
                            <th scope="col" class="text-center" style="">Description</th>
                            <th scope="col" class="text-center" style="">Gambar</th>
                            <th scope="col" class="text-center" style="">Created at</th>
                            <th scope="col" class="text-center" style="">Updated At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($points as $p)
                            <tr>
                                <td class="text-center"> {{ $p->id }} </td>
                                <td> {{ $p->name }} </td>
                                <td> {{ $p->description }} </td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                        class="img-thumbnail" width="100">
                                </td>
                                <td class="text-center"> {{ $p->created_at }} </td>
                                <td class="text-center"> {{ $p->updated_at }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Polylines</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id=polylinestable>
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
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                        class="img-thumbnail" width="100">
                                </td>
                                <td class="text-center"> {{ $p->created_at }} </td>
                                <td class="text-center"> {{ $p->updated_at }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="card mt-4">
            <div class="card-header">
                <h4>Data Polygons</h4>
            </div>
            <div class="card-body">
                <table class="table table-striped" id=polygontable>
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
                                    <img src="{{ asset('storage/images/' . $p->image) }}" alt=""
                                        class="img-thumbnail" width="100">
                                </td>
                                <td class="text-center"> {{ $p->created_at }} </td>
                                <td class="text-center"> {{ $p->updated_at }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            @endsection

            @section('styles')
            <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" @endsection
                @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>
    <script>
    let pointstable = new DataTable('#pointstable');
    let polylinestable = new DataTable('#polylinestable');
    let polygonstable = new DataTable('#polygontable');

    </script>
@endsection
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
