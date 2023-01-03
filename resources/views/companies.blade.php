<div class="companies d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="companies-view-wrapper row d-flex flex-column">
        <span class="row" style="font-size: 16px; font-weight: bold">Liste des Sociétes</span>

        <div class="companies-message-alert">

        </div>

        <div class="companies-view row">
            <table id="companies-table" class="display border">
                <thead>
                    <th>Nom de la Sociéte</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>