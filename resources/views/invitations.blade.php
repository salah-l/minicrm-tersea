<div class="home d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="invitations-view-wrapper row d-flex flex-column">
        <span class="row" style="font-size: 16px; font-weight: bold">Liste des Invitations</span>
        <div class="invitations-message-alert">

        </div>
        <div class="invitations-view row">
            <table id="invitations-table" class="display border">
                <thead>
                    <th>Employé</th>
                    <th>Invité par</th>
                    <th>Sociéte</th>
                    <th>Status de l'invitation</th>
                    <th>Action</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>