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