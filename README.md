# 📊 Live Pricing & Alert System  
### Laravel 11 + Python Automation

A production-style **live pricing and alert monitoring system** built with **Laravel 11** and **Python**.

This project demonstrates how to ingest live data from an external service (Python automation), evaluate alert rules on the backend, and display real-time updates in a clean dashboard — using a **simple, scalable architecture** suitable for financial, e-commerce, or monitoring use cases.

---

## 🚀 Key Features

- 🔄 Live price ingestion via **Python automation**
- 📈 Multi-instrument support (Crypto + FX)
  - BTCUSDT
  - EURUSD
- 🔔 Rule-based alerts (greater than / less than)
- 🧠 Alert engine with **single-trigger logic** (no duplicate alerts)
- 🧾 Alert history logging
- 📊 Live dashboard with automatic updates (polling)
- 🌱 Demo alerts provided via **database seeders**
- 🧱 Clean, service-based backend architecture

---

## 🏗️ Architecture Overview

```
Python Script (Price Fetcher)
        ↓
Laravel API  (/api/prices)
        ↓
MySQL Database
(prices, alerts, alert_logs)
        ↓
Alert Engine (Service Layer)
        ↓
Dashboard UI (Polling every 5s)
```

---

## 🛠️ Tech Stack

### Backend
- Laravel 11
- PHP 8.3+
- MySQL

### Automation
- Python 3
- requests
- logging

### Frontend
- Blade
- Vanilla JavaScript (polling-based updates)
- Custom CSS (no UI framework)

---

## 📂 Project Structure

```
live-pricing-alerts/
├── app/
│   └── Services/
│       └── AlertEvaluator.php
├── database/
│   └── seeders/
│       └── AlertSeeder.php
├── python/
│   ├── fetch_price.py
│   ├── requirements.txt
│   └── README.md
├── resources/
│   └── views/
│       └── dashboard.blade.php
├── routes/
│   ├── web.php
│   └── api.php
├── .env.example
└── README.md
```

---

## ⚙️ Setup & Run Instructions

### 1️⃣ Clone the repository
```bash
git clone https://github.com/nourhanmroueh/live-pricing-alerts.git
cd live-pricing-alerts
```

---

### 2️⃣ Install PHP dependencies
```bash
composer install
```

---

### 3️⃣ Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials.

---

### 4️⃣ Run migrations & seeders
```bash
php artisan migrate
php artisan db:seed --class=AlertSeeder
```

This creates demo alerts for:
- BTCUSDT
- EURUSD

---

### 5️⃣ Start Laravel server
```bash
php artisan serve
```

---

### 6️⃣ Run the Python price fetcher
```bash
cd python
pip install -r requirements.txt
python fetch_price.py
```

---

### 7️⃣ Open the dashboard
```
http://127.0.0.1:8000/
```

Prices and alert statuses update automatically every 5 seconds.

---

## 🔔 Alert Logic

- Alerts trigger **once only**
- Triggered alerts are logged in `alert_logs`
- Alerts do not re-trigger unless reset (by design)
- Supports both upper and lower thresholds per symbol

---

## 💡 Design Decisions

- **Polling instead of WebSockets**  
  Chosen for simplicity, reliability, and easier client adoption.

- **Service layer for alert logic**  
  Keeps controllers thin and business logic reusable.

- **Seeders for demo data**  
  Allows instant testing without manual DB setup.

---

## 📌 Example Use Cases

- Crypto & FX price monitoring
- E-commerce price alerts
- Financial dashboards
- Server / metric monitoring
- Automation pipelines

---
## 📸 Screenshots

### Dashboard
docs/screenshots/live-pricing-demo.png

## 👤 Author

**Nourhan Mroueh**  
Senior Web Development Manager  
Laravel • Python Automation • Real-Time Systems

---

## 📄 License

This project is open-source and intended for learning, demonstration, and portfolio use.
