<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Status</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            min-height: 100vh;
            background: #0d0d0d;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Grotesk', sans-serif;
            overflow: hidden;
        }

        .grid-bg {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
            pointer-events: none;
        }

        .glow {
            position: fixed;
            width: 500px;
            height: 500px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(34,197,94,0.08) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            pointer-events: none;
        }

        .card {
            position: relative;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px;
            padding: 48px 56px;
            text-align: center;
            width: 380px;
            background: rgba(255,255,255,0.03);
        }

        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 20px;
            border: 1px solid transparent;
            background: linear-gradient(135deg, rgba(34,197,94,0.25), transparent 50%) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: destination-out;
            mask-composite: exclude;
            pointer-events: none;
        }

        .icon-wrap {
            width: 56px;
            height: 56px;
            margin: 0 auto 24px;
            border-radius: 14px;
            border: 1px solid rgba(34,197,94,0.25);
            background: rgba(34,197,94,0.08);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-wrap svg {
            width: 24px;
            height: 24px;
            stroke: #22c55e;
            fill: none;
            stroke-width: 1.8;
        }

        .status-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #22c55e;
            animation: blink 2.5s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        h1 {
            font-size: 20px;
            font-weight: 600;
            color: #f9fafb;
            letter-spacing: -0.3px;
        }

        .subtitle {
            font-size: 13px;
            color: rgba(255,255,255,0.35);
            margin-top: 6px;
            margin-bottom: 32px;
            line-height: 1.6;
        }

        .meta-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 28px;
        }

        .meta-item {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 10px;
            padding: 12px;
            text-align: left;
        }

        .meta-label {
            font-size: 10px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.3);
            margin-bottom: 4px;
        }

        .meta-val {
            font-size: 13px;
            font-weight: 500;
            color: #e5e7eb;
            font-family: 'JetBrains Mono', monospace;
        }

        .meta-val.green { color: #4ade80; }

        .divider {
            border: none;
            border-top: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 20px;
        }

        .footer {
            font-size: 11px;
            color: rgba(255,255,255,0.2);
            font-family: 'JetBrains Mono', monospace;
        }

        .footer span { color: rgba(255,255,255,0.35); }
    </style>
</head>
<body>

    <div class="grid-bg"></div>
    <div class="glow"></div>

    <div class="card">
        <div class="icon-wrap">
            <svg viewBox="0 0 24 24">
                <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
            </svg>
        </div>

        <div class="status-row">
            <div class="dot"></div>
            <h1>API is Running</h1>
        </div>
        <p class="subtitle">Service is online and ready<br>to accept requests.</p>

        <div class="meta-grid">
            <div class="meta-item">
                <div class="meta-label">Status</div>
                <div class="meta-val green">200 OK</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Version</div>
                <div class="meta-val">v1.0.0</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Environment</div>
                <div class="meta-val">{{ app()->environment() }}</div>
            </div>
            <div class="meta-item">
                <div class="meta-label">Framework</div>
                <div class="meta-val">Laravel</div>
            </div>
        </div>

        <hr class="divider">
        <p class="footer"><span>{{ config('app.name') }}</span> &mdash; {{ date('Y') }}</p>
    </div>

</body>
</html>
