# Projet EMARGEMENT

Ce dépôt contient le projet **EMARGEMENT**, développé dans le cadre du BTS SIO SLAM. Il s'agit d'une application web permettant la gestion des feuilles d'émargement à travers un calendrier dynamique et une interface multi-rôles (admin, formateur, apprenant).

---

## ✅ Objectif du projet

- Gestion des utilisateurs (apprenants, formateurs, administrateurs)
- Génération et signature des feuilles d’émargement
- Affichage dynamique d’un calendrier (HTML/JS)
- Connexion sécurisée à une base de données MySQL
- Développement modulaire côté PHP

---

## 📁 Structure du projet

```
projet-emargement/
├── apprenant_calendrier.html      # Interface calendrier dynamique
├── dashboard_admin.php            # Tableau de bord admin
├── dashboard_formateur.php        # Tableau de bord formateur
├── dashboard_apprenant.php        # Tableau de bord apprenant
├── script.js                      # Script JS du calendrier
├── styles.css                     # Style global du projet
├── emargement.sql                 # Structure complète de la base de données
```

---

## 🧪 Étapes techniques réalisées

### 1. Mise en place du calendrier dynamique
- Création d’un fichier `apprenant_calendrier.html`
- Intégration d’un calendrier JS avec navigation entre les mois
- Ajout d’un système d’ajout d’événements au clic

### 2. Connexion dynamique à la session PHP
- Affichage des initiales du nom/prénom selon l’utilisateur connecté
- Détection du rôle (apprenant, formateur, admin)

### 3. Création de la base de données `emargement`
- Tables : `users`, `formations`, `groupes`, `feuilles_emargements`, etc.
- Insertion de données de test avec mot de passe haché
- Détection et correction d’erreurs SQL (`PRIMARY KEY`, `user_id`, `ENUM`, etc.)

### 4. Intégration Git & GitHub
- Initialisation du dépôt local avec `git init`
- Création d’un dépôt GitHub : https://github.com/selimBTS/emargement
- Problèmes rencontrés :
  - Mauvais `user.name` ou `user.email` ➤ corrigé avec `git config`
  - `403 Permission denied` ➤ résolution via `token GitHub personnel`
  - `non-fast-forward` et conflits de `README.md` ➤ résolu via `git pull --allow-unrelated-histories`
  - Conflits de fusion ➤ manuellement résolus et commit finalisé

---

## ⚠️ Difficultés rencontrées & solutions

| Problème rencontré                            | Solution apportée                                              |
|----------------------------------------------|----------------------------------------------------------------|
| Mauvais compte Git configuré (`Turqone`)     | Suppression des credentials et reconfig avec `selimBTS`        |
| Push refusé (`403` / `non-fast-forward`)     | Résolution via `git pull` avec fusion                         |
| Conflit sur `README.md`                      | Suppression locale + revalidation manuelle du merge            |
| Dépôt GitHub vide mais bloquant              | Utilisation de `--allow-unrelated-histories`                  |
| Aucune branche `main` trouvée                | Création avec `git branch -M main`                             |
| Connexion GitHub depuis VS Code              | Authentification réussie via navigateur et VS Code             |

---

## 🚀 Prochaines étapes

- Connecter le calendrier à la base de données MySQL
- Sauvegarder les événements d’émargement en base
- Générer un export PDF ou CSV des feuilles signées
- Ajout d’une interface de validation pour les formateurs
- Historique de présence et statistiques pour les admins

---

## 🎨 Maquette Figma

Le design de l'interface a été conçu avec Figma :  
👉 [Voir la maquette](https://www.figma.com/design/rljuchhQ7rZN6gcvg2awzh/site-feuille-d'%C3%A9margement?node-id=0-1&t=H0lwOpRw9SRAoGJ1-1)

---

## 👨‍💻 Auteur

Projet développé par **Selim** — BTS SIO SLAM 2025  
GitHub : [selimBTS](https://github.com/selimBTS)
memo: http://localhost/myproject/projet-emargement/apprenant/apprenant_dashboard.php