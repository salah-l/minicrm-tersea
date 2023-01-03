<div class="account d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="account-wrapper row d-flex flex-column mt-4">
        <span class="row" style="font-size: 16px; font-weight: bold">{{$sectionTitle}}</span>

        <div class="account-message-alert">

        </div>
        <div class="account-info row ps-0 mt-3">
            <form style="min-width: 200px; width: 30%" data-entity="account" class="d-flex flex-column gap-3" method="POST" action="/user">
                @csrf
                @method('PUT')
                <div style="width: 100%">
                    <label for="name">Nom & Prénom </label>
                    <input name="name" type="text" value="{{$user->name}}" required/>
                    <span class="invalid-feedback" id="name-error"></span>
                </div>

                <div style="width: 100%">
                    <label for="name">Email </label>
                    <input name="email" type="text" value="{{$user->email}}" required/>
                    <span class="invalid-feedback" id="email-error"></span>
                </div>


                <div style="width: 100%">
                    <label for="role">Role </label>
                    <select name="role" required>
                        @if($user->role == 1)
                        <option value="1" selected>Administrateur</option>
                        <option value="0">Utilisateur</option>
                        @else
                        <option value="1">Administrateur</option>
                        <option value="0" selected>Utilisateur</option>
                        @endif
                    </select>
                    <span class="invalid-feedback" id="role-error"></span>
                </div>


                <div class="mt-3 w-100">
                    <button class="btn btn-secondary" style="min-width: 100px; width: 20%; align-self: end;"
                        name="submit" type="submit">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>