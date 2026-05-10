# Dreamstill Website

Premium marketing website for Dreamstill and Sorty, built with Next.js.

## View on the web

After this branch is merged to `main`, GitHub Actions builds and publishes the static site to:

https://dreamstill-app.github.io/Website/

The workflow can also be run manually from the GitHub Actions tab with **Deploy website to GitHub Pages**.

## Local development

```bash
npm ci
npm run dev
```

Open http://localhost:3000 to view the site locally.

## Static preview

```bash
npm run build
npm run preview
```

The production static build is written to `out/`.
