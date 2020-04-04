<!DOCTYPE html>
<html>
<head>
    <title>Laravel 7 Import Excel to MySQL database</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.0/css/bootstrap.min.css" />
</head>
<body>
   
<div class="container">
    <div class="card bg-light mt-3">
        <div class="card-header">
            Laravel 7 Import Excel to MySQL database
        </div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success">Import User Data</button>
            </form>
        </div>
    </div>
</div>
   
</body>
</html>