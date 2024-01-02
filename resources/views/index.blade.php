<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>User</title>
        <link rel="stylesheet" href="{{asset('style.css')}}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body>
        <div class="p-5 d-flex flex-column gap-5">
            @if (session('error'))
            <div class="response error">
                <p class="text-center text-white my-auto">{{ session('error') }}</p>
            </div>
            @endif
            @if (session('success'))
                <div class="response success">
                    <p class="text-center text-white my-auto">{{ session('success') }}</p>
                </div>
            @endif
            <form method="POST" action="{{route('user.store')}}">
                @csrf
                <div class="mb-3">
                    <label for="data" class="form-label">Data</label>
                    <input type="text" class="form-control" name="data" placeholder="Format: NAMA[spasi]USIA[spasi]KOTA" id="data" aria-describedby="data">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            <div class="d-flex flex-column">
                <h3>Data User</h3>
                <table class="table">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Umur</th>
                        <th>Kota</th>
                        <th>Dibuat Pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1 ?>
                        @foreach ($users as $item)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item->NAME}}</td>
                                <td>{{$item->AGE}}</td>
                                <td>{{$item->CITY}}</td>
                                <td>{{$item->CREATED_AT}}</td>
                            </tr>
                            <?php ++$i ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>