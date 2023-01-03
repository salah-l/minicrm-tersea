<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Minicrm [Home]</title>
</head>

<body id="body">

    <div class="sb-main d-flex flex-column align-items-center">
        <div class="row w-100">
            <div class="d-flex flex-column align-items-center p-0">
                <div class="d-flex align-items-center">
                    <i style="font-size: 26px" class="fa-solid fa-leaf"></i>
                    <span class="sidebar-logo mt-1">Minicrm</span>
                </div>
                <hr style="margin-top: 5px" class="w-100" />
            </div>
        </div>
        <div class="d-flex flex-column w-100 h-100 justify-content-between">
            <div class=" w-100">
                <ul class="d-flex flex-column sb-menu p-0 align-items-center">
                    <li id="home">Accueil</li>
                    <li id="account">Mon Compte</li>
                    <li id="companies">Sociétés</li>
                    <li id="employees">Employés</li>
                    <li id="invitations">Invitations</li>
                    <li id="audit">Historique</li>
                </ul>
            </div>

            <div style="text-aling: center;" class="d-flex mb-4 justify-content-center">
                <div class="row align-self-center">
                    <a href="#" class="logout">Deconnexion</a>
                </div>
            </div>

        </div>
    </div>

    <section class="content-section">

        <div class="home d-flex flex-column ms-5">
            <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
            <div class="actions-wrapper row d-flex flex-column">
                <span class="row" style="font-size: 16px">Qu'est ce que vous aimerez faire aujourd'hui?</span>
                <div class="actions row">
                    <div class="action-btn invite-employee">
                        Inviter un Employé
                    </div>
                    <div class="action-btn create-company">
                        Créer une Scoiété
                    </div>
                    <div class="action-btn create-user">
                        Ajouter un Utilisateur
                    </div>
                </div>
            </div>
        </div>






    </section>




</body>

</html>