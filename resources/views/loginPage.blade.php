<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Minicrm [Login]</title>

</head>

<body>
    <div style="height: 80vh; width: 100%" class="container-fluid d-flex align-items-center justify-content-center">
        <div class="employee-details-form col-2">
            <div class="form-wrapper w-100 h-100">
                <form action="/login" class="d-flex flex-column justify-content-between w-100 h-100 gap-2"
                    method="POST">
                    @csrf
                    <div class="d-flex align-items-center justify-content-center">
                        <i style="font-size: 26px" class="fa-solid fa-leaf"></i>
                        <span class="sidebar-logo mt-1">Minicrm</span>
                    </div>
                    <div class="row">
                        <span style="font-weight: bold; text-align: center" class="header mt-2 p-0">Connectez-vous à votre portail</span>
                    </div>
                    <div class="row mt-2">
                        <label style="padding: 0 !important;" for="name">Email</label>
                        <input type="text" name="email"/>
                        <span class="invalid-feedback" id="email-error"></span>
                    </div>

                    <div class="row">
                        <label style="padding: 0 !important;" for="address">Mot de Passe</label>
                        <input type="password" name="password"/>
                        <span class="invalid-feedback" id="password-error"></span>
                    </div>

                    <div class="row">
                        <label style="padding: 0 !important;" for="address">Type de compte</label>
                        <select style="height: 30px" name="guard">
                            <option value="user" selected>Administrateur</option>
                            <option value="employee">Employé</option>
                        </select>
                        <span class="invalid-feedback" id="login_type-error"></span>
                    </div>
                    <div class="row mt-2">
                        <button class="btn btn-secondary" type="submit" value="submit">Connexion</button>
                    </div>
                    <div style="text-align: center" class="row mt-2">
                        <a style="color: inherit;" href="#">Mot de Passe oublié?</button>
                    </div>
                </form>
            </div>
        </div>


    </div>
</body>

</html>