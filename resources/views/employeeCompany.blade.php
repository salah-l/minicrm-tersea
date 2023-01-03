<div class="company d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('employee')['name']}}</span>
    <div class="company-wrapper row d-flex flex-column mt-4">
        <span class="row" style="font-size: 16px; font-weight: bold">Ma Société</span>
        <div class="company-message-alert">

        </div>
        <div class="company-info row ps-0 mt-3">
            <div style="min-width: 200px; width: 30%" data-entity="company" class="d-flex flex-column gap-3">
                <div style="width: 100%">
                    <label for="name">Nom de la Sociéte</label>
                    <input name="name" type="text" value="{{$company->name}}" disabled />
                </div>

                <div style="width: 100%">
                    <label for="description">Description </label>
                    <textarea style="height: 100px;" class="w-100"
                        name="description" disabled>{{$company->description}}</textarea>
                </div>

            </div>
        </div>
    </div>
</div>