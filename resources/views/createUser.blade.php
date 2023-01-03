<div class="user d-flex flex-column ms-5">
    <span class="greeting row">Salut {{Session::get('user')['user_name']}}</span>
    <div class="user-wrapper row d-flex flex-column mt-4">
        <span class="row" style="font-size: 16px; font-weight: bold">Ajouter un Utilisateur</span>

        <div class="user-message-alert">

        </div>
        <div class="user-info row ps-0 mt-3">
            <form style="min-width: 200px; width: 30%" data-entity="user" class="d-flex flex-column gap-3" method ="POST" action="/user">
                    @csrf
                <div style="width: 100%">
                    <label for="name">Nom & Prénom </label>
                    <input name="name" type="text" required/>
                    <span class="invalid-feedback" id="name-error"></span>
                </div>

                <div style="width: 100%">
                    <label for="email">Email </label>
                    <input name="email" type="text" required/>
                    <span class="invalid-feedback" id="email-error"></span>
                </div>

                <div style="width: 100%">
                    <label for="password">password</label>
                    <input name="password" type="password" />
                    <span class="invalid-feedback" id="password-error"></span>
                </div>

                <div style="width: 100%">
                    <label for="role">Role </label>
                    <select name="role" required>
                        <option value="1" selected>Administrateur</option>
                        <option value="0">Utilisateur</option>
                    </select>
                </div>

                <div class="mt-3 w-100">
                    <button class="btn btn-secondary" style="min-width: 100px; width: 20%; align-self: end;"
                        name="submit" type="submit">Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>