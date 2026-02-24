<form action="/login" method="POST" class="w-50 mx-auto mt-5" novalidate>
  <div class="mb-3">
    <label for="email" class="form-label">Adresse email</label>
    <input
      type="email"
      class="form-control"
      id="email"
      name="email"
      required
      autocomplete="email"
    >
    <div class="form-text">Ne partagez jamais votre email avec une personne tierce</div>
  </div>

  <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input
      type="password"
      class="form-control"
      id="password"
      name="password"
      required
      autocomplete="current-password"
    >
  </div>

  <button type="submit" class="btn btn-primary">Se connecter</button>
</form>