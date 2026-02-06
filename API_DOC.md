# DOCUMENTATION API - African Business Cards

## BASE URL
```
http://localhost:8000/api
```

## AUTHENTIFICATION

### 1. Inscription 
**Endpoint:** `POST /inscription`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```
#### a. Entreprise

**Body:**
```json
{
  "name": "Entreprise Test",
  "email": "entreprise_test@gmail.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "entreprise",
  "phone": "0123456789",
  "country": "Côte d'Ivoire",
  "nationality": "Ivoirienne",
  "accept_terms": true
}
```

**Response Success (201):**
```json
{
    "success": true,
    "message": "Inscription réussie",
    "user": {
        "id": 12,
        "name": "Entreprise Test",
        "email": "entreprise_test@gmail.com",
        "phone": "0123456789",
        "country": "Côte d'Ivoire",
        "nationality": "Ivoirienne",
        "role": "entreprise",
        "code_commercial": null
    },
    "access_token": "laravel_sanctum_token_here",
    "token_type": "Bearer"
}
```

#### b. Commercial

**Body:**
```json
{
  "name": "Jean Dupont",
  "email": "Jeandupont@gmail.com",
  "password": "password123",
  "password_confirmation": "password123",
  "role": "commercial",
  "phone": "0123456789",
  "code_commercial": " ",
  "country": "Côte d'Ivoire",
  "nationality": "Ivoirienne",
  "accept_terms": true
}
```

**Response Success (201):**
```json
{
    "success": true,
    "message": "Inscription réussie",
    "user": {
        "id": 11,
        "name": "Jean Dupont",
        "email": "Jeandupont@gmail.com",
        "phone": "0123456789",
        "country": "Côte d'Ivoire",
        "nationality": "Ivoirienne",
        "role": "commercial",
        "code_commercial": "COM-6985BC8D5DC0B"
    },
    "access_token": "laravel_sanctum_token_here",
    "token_type": "Bearer"
}
```

### 2. Connexion 
**Endpoint:** `POST /connexion`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body:**
```json
{
  "email": "entreprise_test@gmail.com",
  "password": "password123"
}
```

**Response Success (200):**
```json
{
    "success": true,
    "message": "Connexion réussie",
    "user": {
        "id": 12,
        "name": "Entreprise Test",
        "email": "entreprise_test@gmail.com",
        "phone": "0123456789",
        "country": "Côte d'Ivoire",
        "nationality": "Ivoirienne",
        "role": "entreprise",
        "code_commercial": null
    },
    "access_token": "laravel_sanctum_token_here",
    "token_type": "Bearer"
}
```

**Response Error (401):**
```json
{
    "status": false,
    "message": "Identifiants incorrects"
}
```

### 3. Déconnexion
**Endpoint:** `POST /deconnexion`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
Accept: application/json
```

**Response Success (200):**
```json
{
    "success": true,
    "message": "Déconnexion réussie"
}
```


## OFFRES & SERVICES DES ENTREPRISES

### 1. Lister des offres 
**Endpoint:** `GET /offres`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: application/json
Accept: application/json
```

**Response Success (200):**
```json
{
    "success": true,
    "data": [
        {
            "id": 4,
            "type": "service",
            "nom": "Service de livraison express",
            "prix": "10000.00",
            "identreprise": 5,
            "pdf_path": null,
            "photo_path": null,
            "detail": "Livraison express sous 24h",
            "created_at": "2025-12-22T18:10:46.000000Z",
            "updated_at": "2025-12-22T18:10:46.000000Z"
        },
        {
            "id": 5,
            "type": "produit",
            "nom": "Carte de visite premium",
            "prix": "25000.00",
            "identreprise": 6,
            "pdf_path": null,
            "photo_path": null,
            "detail": "Carte de visite haute qualité avec finition premium",
            "created_at": "2025-12-22T18:10:46.000000Z",
            "updated_at": "2025-12-22T18:10:46.000000Z"
        },
        {
            "id": 6,
            "type": "produit",
            "nom": "Carte de visite standard",
            "prix": "15000.00",
            "identreprise": 6,
            "pdf_path": null,
            "photo_path": null,
            "detail": "Carte de visite standard avec impression de qualité",
            "created_at": "2025-12-22T18:10:46.000000Z",
            "updated_at": "2025-12-22T18:10:46.000000Z"
        },
     
        {
            "id": 13,
            "type": "produit",
            "nom": "test",
            "prix": "10000.00",
            "identreprise": 6,
            "pdf_path": null,
            "photo_path": "offres_photos/su6ZOpUeDFqCHMI721m6NwHl7gs8yT03bvSbkLRx.png",
            "detail": ", jlnk",
            "created_at": "2025-12-23T04:19:01.000000Z",
            "updated_at": "2025-12-23T04:19:01.000000Z"
        },
        {
            "id": 15,
            "type": "produit",
            "nom": "Mon super produit",
            "prix": "1500.50",
            "identreprise": 12,
            "pdf_path": "offres/pdf/A0E2wUi13PZEhEb2gUbFNMnzmqObR3a38bGeRUMH.pdf",
            "photo_path": "offres/images/kMKE1eJWn6Z4OtM3ibg8cDeObReWygrAMyumwAgo.jpg",
            "detail": "Mon super produit destiné aux sportifs",
            "created_at": "2026-02-06T11:29:23.000000Z",
            "updated_at": "2026-02-06T11:29:23.000000Z"
        }
    ]
}
```

### 2. Ajouter une offre
**Endpoint:** `POST /offres`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
Accept: application/json
```

**Body:**
```form-data
--------------------------------------------------------------------------------
  **key**                     |           **value**                            |
--------------------------------------------------------------------------------
  type (Text)                 |    produit                                     |
--------------------------------------------------------------------------------                                      nom (Text)                  |    Mon super produit                           |
--------------------------------------------------------------------------------                                      prix (Text)                 |    1500.50                                     |                                    
--------------------------------------------------------------------------------                                      pdf_path (File)             |    document.pdf                                |
--------------------------------------------------------------------------------                                      photo_path (File)           |    image.jpeg                                  |                                    
--------------------------------------------------------------------------------                                      detail (Text)               |    Mon super produit destiné aux sportifs      |
--------------------------------------------------------------------------------
```

**Response Success (201):**
```json
{
    "success": true,
    "message": "Offre créée avec succès",
    "data": {
        "type": "produit",
        "nom": "Mon super produit",
        "prix": "1500.50",
        "pdf_path": "offres/pdf/A0E2wUi13PZEhEb2gUbFNMnzmqObR3a38bGeRUMH.pdf",
        "photo_path": "offres/images/kMKE1eJWn6Z4OtM3ibg8cDeObReWygrAMyumwAgo.jpg",
        "detail": "Mon super produit destiné aux sportifs",
        "identreprise": 12,
        "updated_at": "2026-02-06T11:29:23.000000Z",
        "created_at": "2026-02-06T11:29:23.000000Z",
        "id": 15
    }
}
```

### 3. Mettre à jour une offre
**Endpoint:** `POST /offres/{offre_id}`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
Accept: application/json
```

**Body:**
```form-data
--------------------------------------------------------------------------------
  **key**                     |           **value**                            |
--------------------------------------------------------------------------------
  type (Text)                 |    produit                                     |
--------------------------------------------------------------------------------                                      nom (Text)                  |    Mon super produit actualisé                 |
--------------------------------------------------------------------------------                                      prix (Text)                 |    2500.50                                     |                                    
--------------------------------------------------------------------------------                                      pdf_path (File)             |    document.pdf                                |
--------------------------------------------------------------------------------                                      photo_path (File)           |    image.jpeg                                  |                                    
--------------------------------------------------------------------------------                                      detail (Text)               |    Mon super produit destiné aux durs          |
--------------------------------------------------------------------------------
  _method (Text)              |    PUT                                         |
--------------------------------------------------------------------------------
```

**Response Success (200):**
```json
{
    "success": true,
    "message": "Offre modifiée avec succès",
    "data": {
        "id": 15,
        "type": "produit",
        "nom": "Mon super produit actualisé",
        "prix": "2500.50",
        "identreprise": 12,
        "pdf_path": "offres/pdf/A0E2wUi13PZEhEb2gUbFNMnzmqObR3a38bGeRUMH.pdf",
        "photo_path": "offres/images/kMKE1eJWn6Z4OtM3ibg8cDeObReWygrAMyumwAgo.jpg",
        "detail": "Mon super produit destiné aux durs",
        "created_at": "2026-02-06T11:29:23.000000Z",
        "updated_at": "2026-02-06T12:11:14.000000Z"
    }
}
```

### 4. Supprimer une offre
**Endpoint:** `DELETE /offres/{offre_id}`

**Headers:**
```
Authorization: Bearer {token}
Content-Type: multipart/form-data
Accept: application/json
```

**Response Success (200):**
```json
{
    "success": true,
    "message": "Offre supprimée avec succès"
}
```

## Codes d'Erreur

- `200` - Succès
- `201` - Créé avec succès
- `401` - Non authentifié
- `403` - Accès refusé (rôle incorrect)
- `422` - Erreur de validation
- `500` - Erreur serveur

## Notes Importantes

1. **Authentification**: Toutes les routes `/api/offres/*` nécessitent un token Bearer valide
2. **Rôle Client**: Seuls les utilisateurs avec le rôle "commercial" ou "entreprise" peuvent accéder aux routes protégées
3. **Validation**: Les erreurs de validation retournent un code 422 avec les détails des erreurs
4. **Token**: Le token Sanctum doit être inclus dans le header `Authorization: Bearer {token}`