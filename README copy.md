# Africa Business Card 🌍

## Description du Projet

**Africa Business Card** est une application mobile Flutter innovante qui digitalise la carte de visite traditionnelle africaine. Elle permet aux professionnels et entreprises de créer, partager et gérer leurs cartes de visite numériques de manière moderne et efficace.

## 🎯 Objectifs

- **Digitalisation** : Remplacer les cartes de visite papier par une solution numérique écologique
- **Accessibilité** : Faciliter le partage d'informations professionnelles en Afrique et à l'international
- **Mise en réseau** : Connecter les professionnels africains entre eux et avec le monde
- **Modernisation** : Offrir une expérience utilisateur moderne et intuitive

## 📱 Fonctionnalités Principales

### Authentification & Gestion de Compte
- **Inscription/Connexion** : Système d'authentification sécurisé
- **Profil utilisateur** : Gestion complète du profil professionnel
- **Réinitialisation de mot de passe** : Récupération de compte

### Carte de Visite Numérique
- **Création de carte** : Interface intuitive pour créer sa carte de visite
- **QR Code dynamique** : Génération automatique de QR code pour partage rapide
- **Templates personnalisables** : Plusieurs designs adaptés à l'identité africaine
- **Informations complètes** : Nom, entreprise, poste, contacts, réseaux sociaux

### Tableau de Bord Interactif
- **Navigation moderne** : Interface avec drawer et bottom navigation
- **Dashboard centralisé** : Vue d'ensemble des activités
- **Exploration** : Découvrir d'autres professionnels
- **Gestion des produits/services** : Catalogue personnel d'offres

### Communication & Réseautage
- **Chat intégré** : Messagerie pour communiquer avec d'autres professionnels
- **Notifications** : Système de notifications intelligent
- **Support client** : Assistance directe via chat

### Partage & Export
- **Partage numérique** : Envoi par email, SMS, réseaux sociaux
- **Sauvegarde des contacts** : Enregistrement direct dans le répertoire
- **Version imprimable** : Possibilité d'imprimer la carte

### Système d'Abonnement 💳
- **Formule Junior** : 10 000 FCFA (12 mois) / 15 000 FCFA (24 mois)
- **Formule Senior** : 12 000 FCFA (12 mois Standard) / 20 000 FCFA (24 mois Standard) / 20 000 FCFA (12 mois Premium) / 30 000 FCFA (24 mois Premium)
- **Formule Manager** : 
  - Réseau Transactionnel : 
    - Niveau 1 : 750 000 - 1 500 000 FCFA
    - Niveau 2 : 1 000 000 - 3 000 000 FCFA
    - Niveau 3 : 1 500 000 - 5 000 000 FCFA
    - Niveau 4 : 2 000 000 - 7 000 000 FCFA
  - Réseau Relationnel :
    - Niveau 1 : 500 000 - 1 000 000 FCFA
    - Niveau 2 : 750 000 - 2 000 000 FCFA
    - Niveau 3 : 1 000 000 - 3 000 000 FCFA
    - Niveau 4 : 1 500 000 - 5 000 000 FCFA
- **Formule Entreprise** : 50 000 - 180 000 FCFA (selon le nombre d'offres et durée)
  - Réseau Transactionnel : 50 000 FCFA (12 mois, 1-5 offres) à 120 000 FCFA (24 mois, 11-20 offres)
  - Réseau Relationnel : 75 000 FCFA (12 mois, 1-5 offres) à 180 000 FCFA (24 mois, 11-20 offres)

### Marketplace B2B 🏪
**Système de vente collaborative entre entreprises et commerciaux**

#### Pour les Entreprises
- **Publier des offres** : Création de catalogues produits/services après achat de carte
- **Gestion des offres** : Interface complète pour administrer les offres publiées
- **Suivi des ventes** : Tableau de bord avec statistiques et performances
- **Communication** : Chat direct avec les commerciaux intéressés
- **Paiements sécurisés** : Système de transaction sécurisé intégré

#### Pour les Commerciaux
- **Accès au catalogue** : Visualisation de toutes les offres disponibles
- **Recherche avancée** : Filtrage par secteur, prix, localisation
- **Système de commission** : Récompenses pour chaque vente réalisée
- **Outils de vente** : Matériel promotionnel et arguments commerciaux
- **Suivi des clients** : Gestion de la relation client

#### Fonctionnalités du Marketplace
- **Matching intelligent** : Algorithme de correspondance offre/commercial
- **Notifications** : Alertes pour nouvelles offres et opportunités
- **Évaluations** : Système de notation et avis
- **Contrats numériques** : Signature électronique des accords
- **Support dédié** : Assistance pour les litiges et questions

## 🚀 Technologies Utilisées

### Framework & Langages
- **Flutter** : Framework cross-platform de Google
- **Dart** : Langage de programmation moderne
- **Material Design 3** : Design system moderne et accessible

### Packages & Dépendances
- **qr_flutter** : Génération de QR codes
- **image_picker** : Sélection d'images depuis la galerie
- **flutter_native_splash** : Écran de démarrage personnalisé
- **cupertino_icons** : Icônes iOS style

### Architecture
- **MVC Pattern** : Séparation claire des responsabilités
- **State Management** : Gestion d'état optimisée
- **Navigation** : Système de routage fluide

## 📁 Structure du Projet

```
africa_business_card/
├── lib/                          # Code source principal
│   ├── auth/                     # Authentification
│   │   ├── login_screen.dart     # Écran de connexion
│   │   ├── register_screen.dart  # Écran d'inscription
│   │   └── acheteur_form_screen.dart # Formulaire acheteur
│   ├── dashboard/                # Tableau de bord
│   │   ├── dashboard_screen.dart   # Écran principal
│   │   ├── home_screen.dart        # Accueil
│   │   ├── explore_screen.dart     # Exploration
│   │   ├── profile_screen.dart     # Profil utilisateur
│   │   ├── chat_screen.dart        # Messagerie
│   │   └── notifications_screen.dart # Notifications
│   ├── onboarding/               # Présentation initiale
│   │   └── onboarding_screen.dart
│   ├── subscription/             # Gestion des abonnements
│   │   ├── enterprise/           # Formule entreprise
│   │   ├── junior/               # Formule junior
│   │   ├── manager/              # Formule manager
│   │   ├── senior/               # Formule senior
│   │   └── subscription_flow.dart # Flux d'abonnement
│   ├── welcome/                  # Écran de bienvenue
│   ├── constants/                # Constantes
│   │   ├── colors.dart           # Couleurs de l'application
│   │   └── card_types.dart       # Types de cartes
│   ├── models/                   # Modèles de données
│   └── gen/                      # Génération automatique
├── assets/                       # Ressources
│   ├── images/                   # Images et logos
│   ├── fonts/                    # Polices de caractères
│   └── color/                    # Fichiers de couleurs
├── android/                      # Configuration Android
├── ios/                          # Configuration iOS
├── web/                          # Version web
├── linux/                        # Version Linux
├── macos/                        # Version macOS
├── windows/                      # Version Windows
└── database/                     # Base de données et migrations
```

## 🎨 Design & Identité Visuelle

### Couleurs Principales
- **Bleu primaire** : #041E56FF (professionnalisme et confiance)
- **Orange accent** : #F5E50BFF (énergie et innovation africaine)
- **Blanc** : #FFFFFF (pureté et modernité)
- **Gris texte** : #6B7280 (lisibilité optimale)

### Thème
- **Material Design 3** : Interface moderne et accessible
- **Mode clair** : Optimisé pour une utilisation en extérieur
- **Animations fluides** : Transitions naturelles et agréables
- **Icons cohérents** : Style uniforme sur toute l'application

## 🔧 Installation & Configuration

### Prérequis
- **Flutter** : Version 3.8.0 ou supérieure
- **Dart** : SDK inclus avec Flutter
- **Éditeur** : VS Code, Android Studio, ou IntelliJ

### Installation
```bash
# Cloner le repository
git clone https://github.com/votre-repo/africa-business-card.git

# Naviguer dans le dossier
cd africa_business_card

# Installer les dépendances
flutter pub get

# Générer les fichiers automatiques
flutter pub run build_runner build

# Créer l'écran de démarrage
flutter pub run flutter_native_splash:create
```

### Lancement
```bash
# Lancer sur Android
flutter run

# Lancer sur iOS (nécessite macOS)
flutter run -d ios

# Lancer sur web
flutter run -d chrome

# Build pour la production
flutter build apk --release
flutter build ios --release
```

## 📱 Plateformes Supportées

- **Android** : API 21+ (Android 5.0+)
- **iOS** : iOS 11.0+
- **Web** : Navigateurs modernes (Chrome, Firefox, Safari)
- **Desktop** : Windows, macOS, Linux

## 🔐 Sécurité

- **Authentification sécurisée** : Chiffrement des données sensibles
- **Validation des entrées** : Protection contre les injections
- **Gestion des permissions** : Accès minimaux nécessaires
- **Sauvegarde des données** : Stockage sécurisé local

## 🌍 Aspect Africain

### Localisation
- **Français** : Langue principale (Afrique francophone)
- **Support multilingue** : Préparation pour l'anglais et autres langues
- **Formats locaux** : Adaptation aux conventions africaines

### Contenu Culturel
- **Designs inspirés** : Motifs et couleurs africaines
- **Réseaux locaux** : Intégration avec plateformes africaines
- **Monnaies locales** : Support des devises africaines

## 📊 Analytics & Performance

- **Google Analytics** : Suivi des utilisateurs et comportements
- **Crashlytics** : Rapport d'erreurs et stabilité
- **Performance monitoring** : Optimisation continue
- **A/B Testing** : Amélioration de l'expérience utilisateur

## 🤝 Contribution

Les contributions sont les bienvenues ! Pour contribuer :

1. Fork le projet
2. Créer une branche pour votre fonctionnalité (`git checkout -b feature/AmazingFeature`)
3. Commit vos changements (`git commit -m 'Add some AmazingFeature'`)
4. Push vers la branche (`git push origin feature/AmazingFeature`)
5. Ouvrir une Pull Request

## 📝 Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## 👥 Équipe

- **Développeur principal** : [Votre Nom]
- **Designer UI/UX** : [Nom du designer]
- **Chef de projet** : [Nom du chef de projet]

## 📞 Support

Pour toute question ou assistance :
- **Email** : support@africabusinesscard.com
- **WhatsApp** : +XXX XXX XXX XXX
- **Site web** : https://africabusinesscard.com

## 🙏 Remerciements

- Merci à la communauté Flutter pour le support
- Inspirations des designs africains traditionnels
- Partenaires locaux pour les retours utilisateurs
- Beta testeurs pour l'amélioration continue

---

**Africa Business Card** - Connecter l'Afrique professionnelle, une carte à la fois. 🌍✨
