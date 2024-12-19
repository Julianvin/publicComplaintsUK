<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaduan Masyarakat</title>
    @include('layout.cdn')
</head>
<body class="bg-gradient-to-r from-blue-100 to-purple-100 min-h-screen p-8">
    <div class="container mx-auto px-4 py-6">
        @include('layout.alert')
        <div class="max-w-4xl mx-auto p-4 bg-white shadow-md rounded-lg">
            {!! $chart->container() !!}
        </div>
    </div>

    @include('layout.button_floating')
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
</body>
</html>