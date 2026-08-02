# Sorty Platform Architecture

> Version 1.0 · 2026-08-02 · DreamStill Technologies

## 1. System overview

```
┌────────────────────────┐
│  Sorty Flutter app     │  Android / iOS / Web
│  (Dreamstill-app/sorty)│
└─────────┬──────────────┘
          │ HTTPS · JSON · Sanctum bearer tokens
          ▼
┌─────────────────────────────────────────────────────────┐
│  Laravel 12 @ dreamstill.ca (Plesk, PHP 8.3)            │
│                                                         │
│  /            CMS marketing site (Blade + Tailwind)     │
│  /admin       Filament v5 — CMS, Sorty admin, partner   │
│               dashboards, impact metrics, data export   │
│  /api/v1      Sorty REST API (this document)            │
│                                                         │
│  Services:                                              │
│   · Sorting\DecisionTree      (deterministic, versioned)│
│   · Ai\AzureOpenAi            (vision analysis + chat)  │
│   · Impact\GhgCalculator      (GHG/diversion rollups)   │
│   · Pricing\PriceEstimator    (brand-tier price bands)  │
│                                                         │
│  Queue (database driver) → analysis jobs, mail,         │
│  nightly impact rollups, dataset export                 │
└───────┬───────────────────────┬─────────────────────────┘
        │                       │
        ▼                       ▼
┌──────────────┐   ┌─────────────────────────────────────┐
│ MariaDB 10.6 │   │ Azure                               │
│ (Plesk)      │   │  · AI Services: GPT-4.1 vision      │
│              │   │    (analysis) + gpt-4.1-mini (chat) │
│ File storage │   │  · Azure ML (Phase 9): YOLOv8s +    │
│ private disk │   │    ResNet50 custom endpoint         │
│ per-user dirs│   │  · Blob (Phase 9): training dataset │
└──────────────┘   └─────────────────────────────────────┘
```

**Design principles**

1. **One backend.** The Laravel app is the single source of truth: consumer API, admin,
   CMS, and dataset pipeline live together. No Firebase.
2. **Explainable AI.** The vision model *proposes*; the deterministic decision tree
   *disposes*. Every recommendation carries a human-readable explanation and a versioned
   `analysis_source`. Auditable — required for municipal/enterprise buyers.
3. **Every interaction is training data.** Sort images, model output, user damage markers,
   and accept/correct feedback are stored as labeled examples for the Phase-9 custom model.
4. **Demo never breaks.** Analysis fallback chain: Azure vision → decision tree on user
   markers alone. The app functions fully offline-from-Azure.
5. **Secrets stay server-side.** The Flutter app holds zero API keys. All third-party
   calls (Azure, maps geocoding) are proxied by Laravel.

## 2. Request flows

### 2.1 Sort & analyze (flagship)

```
App: capture front/back/tag → client-side compress (≤500KB each)
 → POST /api/v1/sorts  (multipart: images + survey + damage markers)
Laravel: store images (private disk, sorts/{userId}/{sortId}/)
 → strip EXIF, re-encode, record sha256
 → AnalyzeSort (sync ≤8s target):
     1. Ai\AzureOpenAi::analyzeGarment(images)   → structured JSON
        {category, brand?, colours, damages[{type,severity,location}], quality_signals}
     2. Sorting\DecisionTree::decide(vision + user markers + survey)
        → {condition_score 1-4, decision, reasons[]}
     3. Pricing\PriceEstimator::band(brand, category, score)  → {low, high}
 → persist analysis (+ source/version) → API Resource response
App: result screen → user Accept / "Not right" (+ correction)
 → PATCH /api/v1/sorts/{id}  → stored as training label
```

### 2.2 Chat

```
POST /api/v1/chat {conversation_id?, message}
 → guardrails (length, rate, topic)
 → context builder: user city, recent sorts, nearest partner_locations,
   active events (from MariaDB)
 → Azure gpt-4.1-mini, streaming SSE → persisted to chat_messages
```

### 2.3 Impact metrics

Nightly scheduled job rolls up `sorts` into `impact_metrics` (per-user + global) using
`Impact\GhgCalculator` (formulas ported from the Dreamstill GHG Calculator workbook).
Served to the app home screen and the Filament dashboard from the rollup table — never
computed on request.

## 3. Data model (ERD summary)

```
users 1─* sorts 1─* sort_images
              1─* damage_markers
              1─1 survey_responses
users 1─* bundles 1─* bundle_items *─1 sorts
users 1─* chat_conversations 1─* chat_messages
users 1─* challenge_progress *─1 challenges
partner_locations (─* future: partner_user_id → users)
events · facts · impact_metrics (rollups) · site CMS tables (existing)
```

Full column definitions live in the migrations (Phase 1) and are the authority.

## 4. Environments

| Env | API base | DB | Notes |
|---|---|---|---|
| Local | `http://<dev-ip>:8000/api/v1` | local MySQL `dreamstill` | `php artisan serve`; Flutter uses `--dart-define=API_BASE_URL` |
| Production | `https://dreamstill.ca/api/v1` | Plesk MariaDB | deployed from `finalsite` branch via Plesk git |

## 5. Versioning

- API: URL-versioned (`/api/v1`). Breaking changes → `/api/v2`; additive changes are free.
- Decision tree: `SORTY_DECISION_TREE_VERSION` env, stamped on every analysis.
- Prompts: version constant in `Ai\AzureOpenAi`, stamped on every analysis.
- Models (Phase 9): Azure ML registry versions, `analysis_source` records which served.

## 6. Phase-9 ML pipeline (designed now, built post-demo)

```
MariaDB/disk ──nightly export──▶ Azure Blob (images + JSONL labels)
   labels = vision output ⊕ user markers ⊕ accept/correct feedback
        └▶ Azure ML pipeline (GPU): YOLOv8s damage localization
                                  → ResNet50 severity classifier
        └▶ managed online endpoint `sorty-score` (CPU, key auth)
        └▶ Laravel Analysis Engine A/B: custom-model vs vision-llm
```

Requires GPU quota (requested Phase 0; NC-family currently 0 in westus2).
