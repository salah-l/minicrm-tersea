<div class="employee d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="employee-wrapper row d-flex flex-column mt-4">
        <span class="row" style="font-size: 16px; font-weight: bold">Inviter un nouveau Employé</span>

        <div class="invitations-message-alert">

        </div>

        <div class="employee-info row ps-0 mt-3">
            <form style="min-width: 200px; width: 30%" data-entity="invitations" class="d-flex flex-column gap-3" method="POST" action="/invitation">
                @csrf
                <div style="width: 100%">
                    <label for="name">Nom & Prénom </label>
                    <input name="name" type="text" required/>
                    <span class="invalid-feedback" id="name-error"></span>
                </div>

                <div style="width: 100%">
                    <label for="email">Email </label>
                    <input class="w-100" name="email" type="email" required/>
                    <span class="invalid-feedback" id="email-error"></span>
                </div>


                <div style="width: 100%">
                    <label for="company_id">Sociéte</label>
                    <select name="company_id" required>
                        @forEach($companies as $companie)
                            <option value="{{$companie->id}}" selected>{{$companie->name}}</option>
                        @endforEach
                    </select>
                    <span class="invalid-feedback" id="company_id-error"></span>
                </div>


                <div class="mt-3 w-100">
                    <button class="btn btn-secondary " style="min-width: 100px; width: 20%; align-self: end;"
                        name="submit" type="submit">Inviter</button>
                </div>
            </form>
        </div>
    </div>
</div>