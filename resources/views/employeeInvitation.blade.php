<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Minicrm [Invitation]</title>
</head>

<body>
    <div style="height: 60vh; width: 100%" class="container-fluid d-flex align-items-center justify-content-center">
        <div class="invitation-form col-6">
            <div class="form-wrapper w-100 h-100">
                <form action="/invitation/employee/{{Session::get('employee')['id']}}" class="d-flex flex-column justify-content-between w-100 h-100" method='POST'>
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center justify-content-center">
                        <i style="font-size: 26px" class="fa-solid fa-leaf"></i>
                        <span class="sidebar-logo mt-1">Minicrm</span>
                    </div>
                    <div class="row my-4">
                        <span style="font-size: 26px;" class="invitation">Vous êtes invités à rejoindre la société <i style="font-weight: 800;">"{{$company}}"</i> sur la platform Minicrm</span>
                    </div>
                    <input type="hidden" name="answer" value='' />
                    <div class="row mb-3">
                        <button  onclick="this.form.answer.value=this.value" type="submit" value="1" class="btn btn-secondary">Accepter</button>
                    </div>
                    <div class="row">
                        <button  onclick="this.form.answer.value=this.value" type="submit" value="0" class="btn btn-light">Rejeter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>