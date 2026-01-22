<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Pricing Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        :root {
            --bg: #0f172a;
            --card: #111827;
            --text: #e5e7eb;
            --muted: #9ca3af;
            --green: #22c55e;
            --red: #ef4444;
            --border: #1f2933;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Inter, system-ui, Arial, sans-serif;
            background: linear-gradient(135deg, #020617, #020617);
            color: var(--text);
        }

        h1 {
            margin-bottom: 20px;
            font-size: 28px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
        }

        .symbol {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 8px;
        }

        .price {
            font-size: 32px;
            font-weight: 700;
        }

        .alerts-title {
            margin-bottom: 12px;
            font-size: 20px;
        }

        .alerts {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 10px;
            border: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .alert.active {
            background: rgba(34,197,94,0.08);
            color: var(--green);
        }

        .alert.triggered {
            background: rgba(239,68,68,0.12);
            color: var(--red);
        }

        .status {
            font-size: 12px;
            font-weight: 600;
        }

        footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: var(--muted);
        }
    </style>
</head>
<body>

<h1>📊 Live Pricing Dashboard</h1>

<div class="grid" id="prices">
    {{-- Prices injected by JS --}}
</div>

<div class="card">
    <div class="alerts-title">🔔 Alerts</div>
    <ul class="alerts" id="alerts">
        {{-- Alerts injected by JS --}}
    </ul>
</div>

<footer>
    Live updates every 5 seconds • Laravel + Python Automation
</footer>

<script>
async function refreshStatus() {
    try {
        const res = await fetch('/api/status');
        const data = await res.json();

        // Prices
        const pricesDiv = document.getElementById('prices');
        pricesDiv.innerHTML = '';

        data.prices.forEach(p => {
            const card = document.createElement('div');
            card.className = 'card';

            card.innerHTML = `
                <div class="symbol">${p.symbol}</div>
                <div class="price">${p.price}</div>
            `;

            pricesDiv.appendChild(card);
        });

        // Alerts
        const alertsEl = document.getElementById('alerts');
        alertsEl.innerHTML = '';

        data.alerts.forEach(a => {
            const li = document.createElement('li');
            li.className = `alert ${a.is_triggered ? 'triggered' : 'active'}`;

            li.innerHTML = `
                <span>${a.symbol} ${a.condition.replace('_', ' ')} ${a.target_price}</span>
                <span class="status">
                    ${a.is_triggered ? 'TRIGGERED' : 'ACTIVE'}
                </span>
            `;

            alertsEl.appendChild(li);
        });

    } catch (e) {
        console.error('Polling failed', e);
    }
}

refreshStatus();
setInterval(refreshStatus, 5000);
</script>

</body>
</html>
