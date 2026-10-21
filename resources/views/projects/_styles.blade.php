<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
<style>
    .pv { --green:#2f5d3a; --green-d:#234729; --green-l:#e8f1e6; --sand:#f6f3ec; --ink:#1f2a22; --muted:#6b7a6f; --line:#e3e8e0; --danger:#b3412f;
          font-family:'DM Sans',sans-serif; color:var(--ink); background:var(--sand); min-height:100vh; padding:2.5rem 1.25rem 4rem; }
    .pv *, .pv *::before, .pv *::after { box-sizing:border-box; }
    .pv-wrap { max-width:1180px; margin:0 auto; }
    .pv h1, .pv h2, .pv h3 { font-family:'Playfair Display',serif; margin:0; }
    .pv h1 { font-size:2.2rem; }
    .pv h2 { font-size:1.35rem; margin-bottom:1rem; }
    .pv a { color:var(--green); text-decoration:none; }

    .pv-head { display:flex; justify-content:space-between; align-items:flex-end; gap:1rem; flex-wrap:wrap; margin-bottom:2rem; }
    .pv-sub { color:var(--muted); margin:.35rem 0 0; }

    .pv-btn { display:inline-flex; align-items:center; justify-content:center; gap:.4rem; border:0; cursor:pointer; font:600 .9rem 'DM Sans',sans-serif;
              padding:.65rem 1.2rem; border-radius:999px; background:var(--green); color:#fff !important; transition:transform .15s, background .15s, box-shadow .15s; }
    .pv-btn:hover { background:var(--green-d); transform:translateY(-1px); box-shadow:0 6px 16px rgba(47,93,58,.25); }
    .pv-btn.sm { padding:.45rem .9rem; font-size:.8rem; }
    .pv-btn.ghost { background:transparent; color:var(--green) !important; border:1px solid var(--green); }
    .pv-btn.ghost:hover { background:var(--green-l); box-shadow:none; }
    .pv-icon-btn { border:0; background:transparent; color:var(--muted); cursor:pointer; width:30px; height:30px; border-radius:50%; font-size:1rem; transition:.15s; }
    .pv-icon-btn:hover { background:#f6dcd6; color:var(--danger); }

    .pv-card { background:#fff; border:1px solid var(--line); border-radius:18px; padding:1.4rem; box-shadow:0 2px 10px rgba(31,42,34,.04); }
    .pv-grid { display:grid; gap:1.25rem; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); }
    .pv-project { display:block; color:inherit !important; animation:pvUp .45s ease both; transition:transform .2s, box-shadow .2s; }
    .pv-project:hover { transform:translateY(-4px); box-shadow:0 14px 30px rgba(31,42,34,.1); }
    .pv-project h3 { font-size:1.2rem; margin-bottom:.5rem; }
    .pv-meta { color:var(--muted); font-size:.88rem; margin-bottom:1rem; }
    .pv-price { font:700 1.4rem 'Playfair Display',serif; color:var(--green); }
    .pv-badge { display:inline-block; font-size:.72rem; font-weight:600; text-transform:uppercase; letter-spacing:.05em; padding:.25rem .65rem; border-radius:999px; background:var(--green-l); color:var(--green); margin-bottom:.8rem; }
    .pv-badge.cotizado { background:#fdf0d3; color:#8a6410; }
    .pv-badge.aprobado { background:#d9ecdc; color:#1d5a2c; }

    .pv-alert { padding:.85rem 1.1rem; border-radius:12px; margin-bottom:1.25rem; font-size:.92rem; }
    .pv-alert.ok { background:var(--green-l); color:var(--green-d); }
    .pv-alert.err { background:#f6dcd6; color:var(--danger); }

    .pv-empty { text-align:center; padding:3rem 1rem; color:var(--muted); }
    .pv-empty .big { font-size:2.5rem; display:block; margin-bottom:.5rem; }

    .pv-form label { display:block; font-size:.85rem; font-weight:600; margin-bottom:.35rem; }
    .pv-form .field { margin-bottom:1.1rem; }
    .pv input[type=text], .pv input[type=number], .pv textarea { width:100%; padding:.7rem .9rem; border:1px solid var(--line); border-radius:12px; font:inherit; background:#fcfcfa; transition:border .15s, box-shadow .15s; }
    .pv input:focus, .pv textarea:focus { outline:0; border-color:var(--green); box-shadow:0 0 0 3px rgba(47,93,58,.15); }
    .pv .err-text { color:var(--danger); font-size:.8rem; }

    .pv-layout { display:grid; grid-template-columns:minmax(0,1fr) 440px; gap:1.75rem; align-items:start; }
    @media (max-width:960px) { .pv-layout { grid-template-columns:1fr; } }
    .pv-panel { position:sticky; top:1.25rem; }

    .pv-chips { display:flex; flex-wrap:wrap; gap:.5rem; margin-bottom:1.25rem; }
    .pv-chip { padding:.4rem .9rem; border-radius:999px; background:#fff; border:1px solid var(--line); font-size:.82rem; font-weight:500; color:var(--ink) !important; transition:.15s; }
    .pv-chip:hover { border-color:var(--green); }
    .pv-chip.active { background:var(--green); border-color:var(--green); color:#fff !important; }

    .pv-materials { display:grid; gap:.8rem; grid-template-columns:repeat(auto-fill,minmax(250px,1fr)); }
    .pv-material { background:#fff; border:1px solid var(--line); border-radius:16px; padding:1rem; animation:pvUp .4s ease both; transition:transform .2s, box-shadow .2s; }
    .pv-material:hover { transform:translateY(-3px); box-shadow:0 10px 22px rgba(31,42,34,.08); }
    .pv-material .cat { font-size:.7rem; text-transform:uppercase; letter-spacing:.06em; color:var(--muted); }
    .pv-material .name { font-weight:600; margin:.2rem 0 .15rem; }
    .pv-material .price { color:var(--green); font-weight:600; font-size:.92rem; margin-bottom:.8rem; }
    .pv-add { display:flex; gap:.5rem; }
    .pv-add input { width:80px !important; padding:.5rem .6rem !important; }
    .pv-add .pv-btn { flex:1; }

    .pv-table { width:100%; border-collapse:collapse; font-size:.9rem; }
    .pv-table th { text-align:left; font-size:.72rem; text-transform:uppercase; letter-spacing:.05em; color:var(--muted); padding:.4rem .3rem; border-bottom:1px solid var(--line); }
    .pv-table td { padding:.65rem .3rem; border-bottom:1px solid var(--line); vertical-align:middle; }
    .pv-table .qty { display:flex; align-items:center; gap:.3rem; }
    .pv-table .qty input { width:72px !important; padding:.35rem .5rem !important; }
    .pv-table .right { text-align:right; }

    .pv-sum { margin-top:1rem; }
    .pv-sum div { display:flex; justify-content:space-between; padding:.3rem 0; font-size:.92rem; color:var(--muted); }
    .pv-total { display:flex; justify-content:space-between; align-items:center; margin-top:.8rem; padding:1rem 1.1rem; border-radius:14px; background:var(--green); color:#fff; }
    .pv-total span { font-size:.85rem; opacity:.85; }
    .pv-total strong { font:700 1.6rem 'Playfair Display',serif; }

    .pv details { margin-top:1.1rem; border-top:1px dashed var(--line); padding-top:.9rem; }
    .pv summary { cursor:pointer; font-weight:600; font-size:.88rem; color:var(--green); }
    .pv .pct { display:grid; grid-template-columns:repeat(3,1fr); gap:.6rem; margin:.8rem 0; }
    .pv .pct label { font-size:.75rem; }

    @keyframes pvUp { from { opacity:0; transform:translateY(12px); } to { opacity:1; transform:none; } }
</style>
