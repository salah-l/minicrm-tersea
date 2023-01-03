<div class="company d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="company-wrapper row d-flex flex-column mt-4">
        <span class="row" style="font-size: 16px; font-weight: bold">{{$sectionTitle}}</span>
        <div class="company-message-alert">

        </div>
        <div class="company-info row ps-0 mt-3">
            <form style="min-width: 200px; width: 30%" data-entity="company" class="d-flex flex-column gap-3" action="/company">
            @csrf
            @method('PUT')
                <div style="width: 100%">
                    <label for="name">Nom de la Sociéte</label>
                    <input name="name" type="text" value="{{$company->name}}" disabled/>
                </div>

                <div style="width: 100%">
                    <label for="description">Description </label>
                    <textarea style="height: 100px;" class="w-100" name="description">{{$company->description}}</textarea>
                    <span class="invalid-feedback" id="description-error"></span>
                </div>

                <input style="display: none;" name="id" type="text" value="{{$company->id}}" />

                <div class="mt-3 w-100">
                    <button class="btn btn-secondary" style="min-width: 100px; width: 20%; align-self: end;"
                        name="submit" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>