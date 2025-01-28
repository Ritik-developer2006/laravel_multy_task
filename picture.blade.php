<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <form class="needs-validation" action="{{ url('/') }}" method='post' enctype="multipart/form-data">
        @csrf
        <div class='d-flex justify-content-center align-items-center' style='height:100vh;'>
            <div class="card w-25">
                @if (session('success'))
                    <div class="alert alert-success mb-1" role="alert">
                        Images successfully upload!
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger mb-1" role="alert">
                        Something was wrong!
                    </div>
                @endif
                @if ($errors->has('image1'))
                    <div class="alert alert-danger mb-1" role="alert">
                        {{ $errors->first('image1') }}
                    </div>
                @endif
                @if ($errors->has('image2'))
                    <div class="alert alert-danger mb-1" role="alert">
                        {{ $errors->first('image2') }}
                    </div>
                @endif
                @if ($errors->has('image3'))
                    <div class="alert alert-danger mb-1" role="alert">
                        {{ $errors->first('image3') }}
                    </div>
                @endif
                <div class="card-body">
                    <div class='mb-1 text-center'><img src="/images/{{ $data[0] }}" alt="no image found!"
                            width='100px' height='100px'></div>
                    <div class="mb-3">
                        <label for="">Image 1</label>
                        <input type="file" name='image1' class="form-control" aria-label="file example">
                    </div>

                    <div class='mb-1 text-center'><img src="/images/{{ $data[1] }}" alt="no image found!"
                            width='100px' height='100px'></div>
                    <div class="mb-3">
                        <label for="">Image 2</label>
                        <input type="file" name='image2' class="form-control" aria-label="file example">
                    </div>

                    <div class='mb-1 text-center'><img src="/images/{{ $data[2] }}" alt="no image found!"
                            width='100px' height='100px'></div>
                    <div class="mb-3">
                        <label for="">Image 3</label>
                        <input type="file" name='image3' class="form-control" aria-label="file example">
                    </div>

                    <div class="mb-3 text-center">
                        <button class="btn btn-primary" type="submit">Submit form</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>
</html>
