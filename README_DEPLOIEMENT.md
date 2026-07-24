# Déploiement du Portfolio Symfony sur Alwaysdata

Ce document décrit la procédure de déploiement du portfolio Symfony sur Alwaysdata.

---

# Prérequis

- Compte Alwaysdata
- Dépôt GitHub
- Accès SSH activé
- Base de données MariaDB créée
- Symfony fonctionnel en local

---

# Première installation

## 1. Connexion SSH

```bash
ssh utilisateur@ssh-utilisateur.alwaysdata.net
```

---

## 2. Cloner le dépôt

```bash
git clone git@github.com:jefflearning40/Porfolio-dev-junior.git ~/www/portfolio
```

---

## 3. Installation des dépendances

```bash
cd ~/www/portfolio

composer install
```

---

## 4. Créer le fichier .env.local

```bash
nano .env.local
```

Contenu :

```env
APP_ENV=prod
APP_DEBUG=0
APP_SECRET=VOTRE_SECRET

DEFAULT_URI=https://votre-domaine.alwaysdata.net
```

---

## 5. Configuration de la base de données

Créer les variables d'environnement nécessaires pour la connexion MariaDB.

---

## 6. Vérification

```bash
php bin/console about
```

Le résultat doit indiquer :

```
Environment : prod
Debug : false
```

---

## 7. Migration de la base

```bash
php bin/console doctrine:migrations:migrate --no-interaction
```

---

## 8. Installation ImportMap

```bash
php bin/console importmap:install
```

---

## 9. Compilation des assets

```bash
php bin/console asset-map:compile
```

---

## 10. Installation Apache Pack

```bash
composer require symfony/apache-pack
```

Cette commande génère :

```
public/.htaccess
```

indispensable au fonctionnement des routes Symfony sous Apache.

---

# Import des données

Créer un export SQL contenant uniquement les données :

```bash
mysqldump --no-create-info
```

Importer :

```bash
mysql -h serveur \
-u utilisateur \
-p \
base_de_donnees \
< portfolio_data.sql
```

---

# Déploiement des mises à jour

Depuis le PC

```bash
git add .
git commit -m "Description"
git push origin main
```

---

Connexion SSH

```bash
ssh utilisateur@ssh-utilisateur.alwaysdata.net

cd ~/www/portfolio
```

---

Récupération des modifications

```bash
git pull origin main
```

---

Installation

```bash
composer install --no-dev --optimize-autoloader
```

---

Nettoyage du cache

```bash
php bin/console cache:clear --env=prod
```

---

Compilation des assets

```bash
php bin/console asset-map:compile
```

---

Vérification

```bash
git status
```

Doit afficher :

```
nothing to commit, working tree clean
```

---

# Sauvegarde de la base

Créer une sauvegarde :

```bash
mysqldump \
-h mysql-mpf2026jfld.alwaysdata.net \
-u mpf2026jfld \
-p \
--default-character-set=utf8mb4 \
mpf2026jfld_portfolio \
> ~/sauvegarde_portfolio_$(date +%Y-%m-%d).sql
```

---

Télécharger la sauvegarde

Depuis PowerShell :

```powershell
scp mpf2026jfld@ssh-mpf2026jfld.alwaysdata.net:/home/mpf2026jfld/sauvegarde_portfolio_2026-07-24.sql .
```

---

Supprimer la sauvegarde du serveur

```bash
rm ~/sauvegarde_portfolio_2026-07-24.sql
```

---

# Vérifications finales

Tester :

- Accueil
- Compétences
- Mes créations
- Contact
- Envoi d'un message
- Téléchargement du CV
- Connexion administrateur
- Dashboard EasyAdmin
- Ajout/modification d'un projet
- Traduction FR / EN
- Affichage mobile

---

# Dépannage

## Invalid CSRF Token

Vider le cache et les cookies du navigateur.

---

## Pages "Not Found"

Vérifier que le fichier :

```
public/.htaccess
```

est présent.

---

## Asset introuvable

```bash
php bin/console importmap:install

php bin/console asset-map:compile
```

---

## Base vide

Importer :

```
portfolio_data.sql
```

---

# Sauvegardes

Toujours effectuer avant un déploiement important :

- GitHub
- Sauvegarde SQL
- Vérification du site après déploiement

---

# Historique

## Version 1.0.0

Première mise en production.

- Symfony 8.1
- EasyAdmin
- MariaDB Alwaysdata
- GitHub
- Traduction FR / EN
- Contact
- CV
- Portfolio entièrement fonctionnel

Il ne restera plus qu'à simplifier les prochains déploiements

Maintenant que tout fonctionne, les prochaines mises à jour seront beaucoup plus rapides. En général, ce sera simplement :

Développer sur ton PC.
git commit
git push
Connexion SSH.
git pull
composer install --no-dev
php bin/console cache:clear --env=prod
php bin/console asset-map:compile

Et c'est tout.