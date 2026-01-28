# ClubSuite Inventory

[![Nextcloud Version](https://img.shields.io/badge/Nextcloud-28--32-blue.svg)](https://nextcloud.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1--8.3-purple.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-AGPL%20v3-green.svg)](LICENSE)

> 📦 Inventarverwaltung und Ausleihsystem für Vereine.

## 📋 Übersicht

ClubSuite Inventory verwaltet Ihr Vereinseigentum:

- **Inventarliste**: Alle Gegenstände mit Kategorien und Fotos
- **Standorte**: Lagerörte und Räume verwalten
- **Ausleihe**: Wer hat was wann ausgeliehen
- **Status**: Verfügbar, Ausgeliehen, Reparatur, Defekt
- **QR-Codes**: Optionale Kennzeichnung mit QR-Labels

## 🚀 Installation

### Über den Nextcloud App Store
1. **ClubSuite Core** muss installiert sein
2. Apps → Organisation → "ClubSuite Inventory" suchen
3. Installieren und aktivieren

### Manuelle Installation
```bash
cd /path/to/nextcloud/apps
git clone https://github.com/clubsuite/clubsuite-inventory.git
php occ app:enable clubsuite-inventory
```

## 📦 Anforderungen

| Komponente | Version |
|------------|--------|
| Nextcloud | 28 - 32 |
| PHP | 8.1 - 8.3 |
| **clubsuite-core** | erforderlich |

## 🔒 DSGVO / Datenschutz

- Ausleihdaten mit Personenbezug geschützt
- Datenexport über Nextcloud Privacy API
- Löschung/Anonymisierung möglich

## 📄 Lizenz

AGPL v3 – Siehe [LICENSE](LICENSE)

## 🐛 Bugs & Feature Requests

[GitHub Issues](https://github.com/clubsuite/clubsuite-inventory/issues)

---

© 2026 Stefan Schulz
