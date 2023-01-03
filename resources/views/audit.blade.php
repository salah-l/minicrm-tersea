<div class="audit d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="audit-view-wrapper row d-flex flex-column">
        <span class="row" style="font-size: 16px; font-weight: bold">Historique</span>
        <div class="audit-message-alert">

        </div>
        <div class="audit-view row">
            <table id="audit-table" class="display border">
                <thead>
                    <th>Événements</th>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>