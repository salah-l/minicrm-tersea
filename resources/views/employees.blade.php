<div class="employees d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="employees-view-wrapper row d-flex flex-column">
        <span class="row" style="font-size: 16px; font-weight: bold">Liste des Employés</span>
        <div class="employees-message-alert">

        </div>
        <div class="employees-view row">
            <table id="employees-table" class="display border">
                <thead>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Sociéte</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Date de naissance</th>
                    <th>Action</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>