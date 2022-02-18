<!DOCTYPE html>
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>TODO LIST PDF :</h1>
        <table class="table table-bordered">
            <thead>
                <th>Nomor</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </thead>
            <tbody>
                @foreach($tasklist as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->checked ? "selesai" : "belum selesai" }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>