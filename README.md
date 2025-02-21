# 📚 Système de Réservation pour Professeurs

Bienvenue dans notre projet de système de réservation pour professeurs ! 🎓📅 Ce projet vise à simplifier la gestion des rendez-vous entre professeurs et étudiants en offrant une plateforme intuitive et efficace. 

## ✨ Fonctionnalités Principales

✅ **Page d'accueil** : Affichage des informations sur les professeurs et leurs disponibilités.
✅ **Système de réservation** : Les étudiants peuvent réserver un rendez-vous avec un professeur via un formulaire.
✅ **Gestion des rendez-vous** : Consultation, modification et annulation des rendez-vous.
✅ **Authentification** : Gestion des comptes utilisateurs pour les professeurs et les étudiants.
✅ **Gestion des disponibilités** : Les professeurs peuvent définir leurs créneaux horaires.
✅ **Envoi d’e-mails** : Confirmation et rappels automatiques par e-mail. 

---

## 🛠️ Installation & Déploiement

1️⃣ **Cloner le repo** :

2️⃣ **Installer les dépendances** :
```bash
composer install && npm install
```

3️⃣ **Configurer l'environnement** :
```bash
cp .env.example .env
php artisan key:generate
```

4️⃣ **Migrer la base de données** :
```bash
php artisan migrate --seed
```

5️⃣ **Démarrer le serveur** :
```bash
php artisan serve
```

🌟 **C'est parti ! Rendez-vous sur `http://127.0.0.1:8000`**

---

## 📌 Backlog (User Stories)

### 🎯 Mise en place de l’environnement et du modèle User
> **En tant qu'enseignant**, je veux configurer mon environnement Laravel et créer le modèle `User` afin de gérer l’authentification.

### 🎯 Gestion des disponibilités
> **En tant que professeur**, je veux définir mes créneaux horaires afin que les étudiants puissent réserver un rendez-vous.

### 🎯 Système de réservation
> **En tant qu'étudiant**, je veux réserver un créneau afin de discuter avec mon professeur.

### 🎯 Envoi de notifications
> **En tant qu'utilisateur**, je veux recevoir une confirmation par e-mail afin d'être certain de ma réservation.

