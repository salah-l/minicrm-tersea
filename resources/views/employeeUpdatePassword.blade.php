<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Minicrm [Set Password]</title>

</head>

<body>
    <div style="height: 60vh; width: 100%" class="container-fluid d-flex align-items-center justify-content-center">
        <div class="password-form col-2">
            <div class="form-wrapper w-100 h-100">
                <form action="/employee/password" class="d-flex flex-column justify-content-between w-100 h-100 gap-2"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center justify-content-center">
                        <i style="font-size: 26px" class="fa-solid fa-leaf"></i>
                        <span class="sidebar-logo mt-1">Minicrm</span>
                    </div>
                    <div class="row">
                        <label style="padding: 0 !important;" for="password">Veuillez enter un Mot de Passe</label>
                        <input type="password" name="password" value="" />
                        <span class="invalid-feedback" id="password-error"></span>
                    </div>

                    <input type="hidden" name="id" value="{{$id}}">

                    <div class="row">
                        <label style="padding: 0 !important;" for="password">Veuillez confirmer le Mot de Passe</label>
                        <input type="password" name="password_confirmation" value="" />
                        <span class="invalid-feedback " id="password_confirmation-error"></span>
                    </div>
                    <div class="row">
                        <button class="btn btn-secondary" type="submit" value="submit">Set Password</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</body>

</html>