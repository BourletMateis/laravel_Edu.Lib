<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du compte</title>
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toolbarAdmin.css') }}">

</head>
<body>
    <div class="min-h-screen">
        <!-- Header -->
        <header>
            <div class="container">
                <h1>Paramètres du compte</h1>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container">
            <div class="card">
                <!-- Profile Section -->
                <div class="profile-section">
                    <div class="profile-info">
                        <div class="avatar-container">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                                 alt="Profile" 
                                 class="avatar">
                            <button class="camera-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"/><circle cx="12" cy="13" r="3"/></svg>
                            </button>
                        </div>
                        <div class="profile-text">
                            <h2>John Doe</h2>
                            <p>Membre depuis Janvier 2024</p>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form class="account-form">
                    <!-- Personal Information -->
                    <div class="form-section">
                        <h3>Informations personnelles</h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="firstName">Prénom</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input type="text" id="firstName" name="firstName" value="John">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="lastName">Nom</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                    <input type="text" id="lastName" name="lastName" value="Doe">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                    <input type="email" id="email" name="email" value="john.doe@example.com">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone">Téléphone</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                    <input type="tel" id="phone" name="phone" value="+33 6 12 34 56 78">
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label for="address">Adresse</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                    <input type="text" id="address" name="address" value="123 Rue de Paris, 75001 Paris">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Password Change -->
                    <div class="form-section">
                        <h3>Changer le mot de passe</h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="currentPassword">Mot de passe actuel</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input type="password" id="currentPassword" name="currentPassword">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="newPassword">Nouveau mot de passe</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input type="password" id="newPassword" name="newPassword">
                                </div>
                            </div>

                            <div class="form-group full-width">
                                <label for="confirmPassword">Confirmer le nouveau mot de passe</label>
                                <div class="input-with-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                                    <input type="password" id="confirmPassword" name="confirmPassword">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-footer">
                        <button type="submit">Sauvegarder les modifications</button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php
require_once base_path('app/View/toolbarAdmin.php');
    echo $toolbar->render();
    ?>
    
</body>
</html>