<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Minicrm [Set up Details]</title>

</head>

<body>
    <div style="height: 80vh; width: 100%" class="container-fluid d-flex align-items-center justify-content-center">
        <div class="employee-details-form col-2">
            <div class="form-wrapper w-100 h-100">
                <form action="/employees/registration/details" class="d-flex flex-column justify-content-between w-100 h-100 gap-2"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="d-flex align-items-center justify-content-center">
                        <i style="font-size: 26px" class="fa-solid fa-leaf"></i>
                        <span class="sidebar-logo mt-1">Minicrm</span>
                    </div>
                    <div class="row">
                        <span style="font-weight: bold;" class="header mt-2 p-0">Données personnelles</span>
                        <span style="font-size: 12px" class="mt-1 p-0">Entrer vos données personnelles pour valider votre profile Minicrm.</span>
                    </div>
                    <div class="row mt-2">
                        <label style="padding: 0 !important;" for="name">Nom & Prénom</label>
                        <input type="text" name="name" value="{{Session::get('employee')['name']}}" />
                        <span class="invalid-feedback" id="name-error"></span>
                    </div>

                    <div class="row">
                        <label style="padding: 0 !important;" for="address">Adresse</label>
                        <input type="text" name="address" value="" />
                        <span class="invalid-feedback" id="address-error"></span>
                    </div>

                    <div class="row">
                        <label style="padding: 0 !important;" for="phone">Téléphone</label>
                        <input type="tel" name="phone" value="" />
                        <span class="invalid-feedback " id="phone-error"></span>
                    </div>

                    <div class="row">
                        <label style="padding: 0 !important;" for="birthdate">Date de naissance</label>
                        <input type="date" name="birthdate" value="" />
                        <span class="invalid-feedback" id="birthdate-error"></span>
                    </div>

                    <input type="hidden" name="id" value="{{Session::get('employee')['id']}}">
                    <div class="row mt-2">
                        <button class="btn btn-secondary" type="submit" value="submit">Valider</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</body>

</html>