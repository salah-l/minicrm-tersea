<div class="employee d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="employee-wrapper row d-flex flex-column mt-4">
        <span class="row" style="font-size: 16px; font-weight: bold">{{$sectionTitle}}</span>
        @if($message)
        <div style="min-width: 200px" class="row alert alert-danger w-50 d-flex justify-content-between">
            <div class="row w-75">
                <span>{{$message}}</span>
            </div>
        </div>
        @else
        <div class="employee-message-alert">

        </div>
        <div class="employee-info row ps-0 mt-3">
            <form style="min-width: 200px; width: 30%" data-entity="employee" class="d-flex flex-column gap-3"
                method="POST" action="/employees">
                @csrf
                @method('PUT')
                <div style="width: 100%">
                    <label for="name">Nom & Prénom </label>
                    <input name="name" type="text" value="{{$employee->name}}" required />
                    <span class="invalid-feedback" id="name-error"></span>
                </div>

                <div style="width: 100%">
                    <label for="email">Email </label>
                    <input class="w-100" name="email" type="email" value="{{$employee->email}}" />
                    <span class="invalid-feedback" id="email-error"></span>
                </div>


                <div style="width: 100%">
                    <label for="company_id">Sociéte</label>
                    <select id="select2" name="company_id" required>
                        @forEach($companies as $companie)
                        @if($companie->id == $employee->company_id)
                        <option value="{{$companie->id}}" selected>{{$companie->name}}</option>
                        @else
                        <option value="{{$companie->id}}">{{$companie->name}}</option>
                        @endif
                        @endforEach
                    </select>
                    <span class="invalid-feedback" id="company_id-error"></span>
                </div>


                <div style="width: 100%">
                    <label for="address">Addresse </label>
                    <input name="address" type="text" value="{{$employee->address}}" required />
                    <span class="invalid-feedback" id="address-error"></span>
                </div>


                <div style="width: 100%">
                    <label for="phone">Téléphone </label>
                    <input class="w-100" name="phone" type="tel" value="{{$employee->phone}}" required />
                    <span class="invalid-feedback" id="phone-error"></span>
                </div>


                <div style="width: 100%">
                    <label for="birthdate">Date de Naissance </label>
                    <input class="w-100" name="birthdate" type="date" value="{{$employee->birthdate}}" required />
                    <span class="invalid-feedback" id="birthdate-error"></span>
                </div>

                <input style="display: none;" class="w-100" name="id" type="tel" value="{{$employee->id}}" />

                <div class="mt-3 w-100">
                    <button class="btn btn-secondary" style="min-width: 100px; width: 20%; align-self: end;"
                        name="submit" type="submit">Modifier</button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>