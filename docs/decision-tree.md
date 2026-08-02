# Sorty Decision Tree — Specification v1.0

> Source: UBC capstone "Condition Assessment - Decision Tree" + ML report, formalized and
> gap-filled for implementation. This file is the **authority** for
> `App\Services\Sorting\DecisionTree`. Any change bumps `SORTY_DECISION_TREE_VERSION`
> and gets a dated changelog entry at the bottom.

## Inputs

| Input | Source | Required |
|---|---|---|
| `damages[]` | union of user damage markers and vision-model detections (deduplicated by type+location) | no (absence = no damage) |
| `survey` | reason, time_owned, brand, thrifted, style, times_worn, purchase_price | no (all optional) |
| `brand` | survey or vision tag-photo read | no |
| `category` | vision model (shirt/pants/dress/outerwear/shoes/accessory/other) | no |

### Damage taxonomy

| Damage type | Class | Severity scale |
|---|---|---|
| Stain | **A — not repairable** | 1 minor · 2 moderate · 3 severe |
| Damaged text/print | A | 1–3 |
| Shrinkage | A | 1–3 |
| Faded colour | A | 1–3 |
| Pilling | A | 1 light · 2 moderate · 3 extensive |
| Tear / hole | **B — repairable** | count + size (>3 cm = large) |
| Seam breakage | B | size (>5 cm = large) |
| Missing button | B | count |
| Broken zipper | B | boolean |

*Class A = condition-degrading, cannot be economically repaired.*
*Class B = repairable defects; repair restores value.*

## Scoring algorithm

Start `score = 4` (excellent). Apply the worst-case rule that matches:

1. **No damages at all** → score 4.
2. **Only class-B damages, all small** (tears ≤ 2 and each ≤ 3 cm; seam ≤ 5 cm;
   missing buttons ≤ 2; zipper OK) → score **2 (Repair)** — value recoverable.
3. **Class-B damages beyond repair economics** (tears > 2, or any tear > 3 cm,
   or seam breakage > 5 cm) → treat as class A severe.
4. **Class-A damages present:**
   - all severity 1 → score 3
   - any severity 2 (none at 3) → score 2 if a class-B repair also present, else 3
     when damage is cosmetic-light (single moderate pilling/fade), else 2
   - any severity 3, or ≥ 3 distinct class-A types → score 1
5. Vision-model `quality_signals` (e.g., "heavy wear", "misshapen") may downgrade one
   step, never upgrade.

## Decision mapping

| Score | Condition | Decision | Refinement |
|---|---|---|---|
| 4 | Excellent | **Resell** | if estimated price < $20 → **Donate** (capstone $20 rule) |
| 3 | Good | **Donate** | luxury/high-tier brand at score 3 → **Resell** (consignment) |
| 2 | Fair, repairable | **Repair** | if repair-class damages absent (pure class-A moderate) → **Donate** |
| 1 | Poor | **Recycle** | never Donate (protects donation-stream quality — core pitch point) |

## Price estimation (v1 — brand tiers)

`base(category) × tier(brand) × condition(score)`

- Category base (CAD): shirt 12 · pants 18 · dress 25 · outerwear 40 · shoes 30 · accessory 10 · other 15
- Brand tier multiplier: luxury 4.0 · premium 2.0 · mainstream 1.0 · fast-fashion 0.6 · unknown 0.8
  (curated brand→tier table seeded in DB, admin-editable in Filament)
- Condition: score 4 → 1.0 · score 3 → 0.6 · below → no resale price shown
- Band: `low = round(est × 0.8)`, `high = round(est × 1.3)`

## Output contract

```json
{
  "condition_score": 1-4,
  "decision": "resell|donate|repair|recycle",
  "reasons": ["1 small tear (repairable)", "no other damage detected"],
  "damages": [{"type": "tear", "severity": 2, "source": "vision|user", "location": {...}}],
  "price_estimate": {"low": 24, "high": 39, "currency": "CAD"} | null,
  "engine": {"tree_version": "1.0", "analysis_source": "vision-llm|rules-only", "model_version": "..."}
}
```

`reasons` are user-facing strings — every decision must be explainable in plain language.

## Changelog

- **1.0** (2026-08-02) — initial formalization from capstone docs; $20 resell/donate
  threshold retained; score-1-never-donate rule made explicit; brand-tier pricing v1.
