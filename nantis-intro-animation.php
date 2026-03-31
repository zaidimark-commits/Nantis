<?php
/**
 * Plugin Name: NANTIS Intro Animation
 * Version: 7.0
 * Description: Splash screen with progress bar, NAV data, and weather.
 *              CSS-driven animations — no browser throttling issues.
 */

add_action( 'wp_footer', 'nantis_intro_cb' );

function nantis_intro_cb() {
    if ( ! is_front_page() ) return;
    if ( ! empty( $_COOKIE['nx_intro'] ) ) return;
?>
<!--
  NANTIS Intro v7 — Architecture:
  • ALL animations are CSS @keyframes (compositor thread, never throttled).
  • The progress bar auto-fills via CSS over 4s. No JS timer needed.
  • JS fires data fetches IMMEDIATELY (inline, no setTimeout).
  • When data arrives, JS updates DOM. CSS handles the reveal transitions.
  • After data + minimum display time, CSS fade-out removes the overlay.
  • Hard CSS fallback: animation-delay on .nxi-exit ensures overlay
    disappears after 12s even if every fetch fails and JS breaks entirely.
-->

<div id="nxi" class="nxi-overlay">
  <div id="nxi-inner" class="nxi-inner">

    <img class="nxi-logo" src="https://nantis.ca/wp-content/uploads/2026/03/logo.png" alt="NANTIS">
    <div class="nxi-line"></div>
    <span class="nxi-title">NANTIS</span>
    <span class="nxi-subtitle">Asset Management Inc.</span>

    <!-- Progress bar: CSS-driven, auto-fills over 4s -->
    <div class="nxi-progress-wrap">
      <div class="nxi-progress-track">
        <div id="nxi-bar" class="nxi-progress-fill"></div>
      </div>
    </div>
    <span id="nxi-status" class="nxi-status">Loading data...</span>

    <span class="nxi-location">EST. 2023 &nbsp;|&nbsp; Montr&eacute;al &nbsp;|&nbsp; Canada</span>
    <span id="nxi-weather" class="nxi-weather"></span>
  </div>

  <div id="nxi-footer" class="nxi-footer">
    <div class="nxi-nav-section">
      <div class="nxi-nav-header">2025 &nbsp;|&nbsp; Class A &amp; Class F NAV</div>

      <div class="nxi-nav-row">
        <div class="nxi-nav-label nxi-nav-label-a">Class A</div>
        <div class="nxi-nav-bar-wrap">
          <div id="nxi-bar-a" class="nxi-nav-bar-fill nxi-fill-a"></div>
          <div class="nxi-nav-bar-overlay">
            <span id="nxi-nav-a-dollar" class="nxi-nav-val"></span>
            <span id="nxi-nav-a-pct" class="nxi-nav-val"></span>
          </div>
        </div>
      </div>

      <div class="nxi-nav-row">
        <div class="nxi-nav-label nxi-nav-label-f">Class F</div>
        <div class="nxi-nav-bar-wrap">
          <div id="nxi-bar-f" class="nxi-nav-bar-fill nxi-fill-f"></div>
          <div class="nxi-nav-bar-overlay">
            <span id="nxi-nav-f-dollar" class="nxi-nav-val"></span>
            <span id="nxi-nav-f-pct" class="nxi-nav-val"></span>
          </div>
        </div>
      </div>
    </div>

    <span id="nxi-motto" class="nxi-motto">
      THINK OUTSIDE THE BOX<sup class="nxi-tm">&trade;</sup>
    </span>
  </div>
</div>

<style>
/* ── Reset & overlay ──────────────────────────────── */
.nxi-overlay{position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999999;background:#000;display:flex;flex-direction:column;align-items:center;justify-content:center;box-sizing:border-box;overflow:hidden;opacity:1;transition:opacity 1.2s ease}
.nxi-overlay *{box-sizing:border-box;margin:0;padding:0}

/* ── Inner section ────────────────────────────────── */
.nxi-inner{display:flex;flex-direction:column;align-items:center;justify-content:center;flex:1;width:100%;gap:20px;padding-top:40px;transition:opacity .6s ease}

/* ── Logo ─────────────────────────────────────────── */
.nxi-logo{width:130px;height:auto;display:block;filter:drop-shadow(0 0 24px rgba(0,168,232,.55));animation:nxPop .8s cubic-bezier(.34,1.56,.64,1) .2s both}

/* ── Decorative line ──────────────────────────────── */
.nxi-line{height:2px;background:#00a8e8;border-radius:2px;animation:nxGrow .8s ease .7s both}

/* ── Title / subtitle ─────────────────────────────── */
.nxi-title{color:#f0f2f5;font-size:2.4rem;font-weight:300;letter-spacing:.25em;text-transform:uppercase;font-family:'Architects Daughter',sans-serif;animation:nxUp .7s ease 1s both}
.nxi-subtitle{color:rgba(240,242,245,.6);font-size:.85rem;letter-spacing:.18em;text-transform:uppercase;font-family:sans-serif;animation:nxUp .7s ease 1.3s both}

/* ── Progress bar (CSS-driven — never throttled) ──── */
.nxi-progress-wrap{width:275px;margin-top:10px}
.nxi-progress-track{width:100%;height:3px;background:rgba(0,168,232,.15);border-radius:2px}
.nxi-progress-fill{width:0%;height:3px;background:#00a8e8;border-radius:2px;box-shadow:0 0 8px rgba(0,168,232,.8);animation:nxFill 4s ease-out 1.8s both}

/* ── Status text ──────────────────────────────────── */
.nxi-status{color:rgba(240,242,245,.35);font-size:.69rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;margin-top:2px;text-align:center;opacity:0;animation:nxUp .5s ease 2.5s both,nxGlow 1.5s ease-in-out 2.5s infinite}

/* ── Location / weather ───────────────────────────── */
.nxi-location{color:rgba(240,242,245,.2);font-size:.75rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;margin-top:4px}
.nxi-weather{color:rgba(240,242,245,.6);font-size:.75rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;margin-top:2px;display:none}

/* ── Footer ───────────────────────────────────────── */
.nxi-footer{width:100%;padding:28px 40px 36px;display:flex;flex-direction:column;align-items:center;gap:12px;border-top:1px solid rgba(0,168,232,.15)}

/* ── NAV section ──────────────────────────────────── */
.nxi-nav-section{width:100%;max-width:400px;margin-bottom:16px}
.nxi-nav-header{color:rgba(240,242,245,.5);font-size:.69rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-bottom:10px}
.nxi-nav-row{margin-bottom:8px}
.nxi-nav-label{font-size:.69rem;letter-spacing:.15em;text-transform:uppercase;font-family:sans-serif;margin-bottom:4px}
.nxi-nav-label-a{color:#00c9d4}
.nxi-nav-label-f{color:#00AEEF}
.nxi-nav-bar-wrap{width:100%;height:23px;background:rgba(255,255,255,.06);border-radius:4px;position:relative;overflow:hidden}
.nxi-nav-bar-fill{height:100%;width:0%;border-radius:4px;transition:width 1.8s cubic-bezier(.22,1,.36,1)}
.nxi-fill-a{background:linear-gradient(90deg,#006d75,#00c9d4)}
.nxi-fill-f{background:linear-gradient(90deg,#0a4a7a,#00AEEF)}
.nxi-nav-bar-overlay{position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:space-between;padding:0 8px}
.nxi-nav-val{font-size:.75rem;color:#fff;font-family:sans-serif;font-weight:700}

/* ── Motto ────────────────────────────────────────── */
.nxi-motto{color:#00a8e8;font-size:1.5rem;letter-spacing:.12em;text-transform:uppercase;text-align:center;font-family:'Architects Daughter',sans-serif;display:block;animation:nxGlow 2.5s ease-in-out 2s infinite;transition:font-size 1s ease,letter-spacing 1s ease}
.nxi-tm{font-size:.4em;vertical-align:super;letter-spacing:0}

/* ── Exit states (toggled by JS adding classes) ───── */
.nxi-overlay.nxi-exiting .nxi-inner{opacity:0}
.nxi-overlay.nxi-exiting .nxi-footer{border-top:none}
.nxi-overlay.nxi-done .nxi-inner{display:none}
.nxi-overlay.nxi-done .nxi-motto{font-size:2.8rem;letter-spacing:.25em}
.nxi-overlay.nxi-fadeout{opacity:0}

/* ── Pure-CSS fallback: if JS completely dies, overlay
     still disappears after 14s via CSS animation ──── */
.nxi-overlay{animation:nxSafeExit 0s ease 14s forwards}

/* ── Keyframes ────────────────────────────────────── */
@keyframes nxPop{0%{opacity:0;transform:scale(.3) translateY(30px)}100%{opacity:1;transform:scale(1) translateY(0)}}
@keyframes nxUp{0%{opacity:0;transform:translateY(20px)}100%{opacity:1;transform:translateY(0)}}
@keyframes nxGrow{0%{width:0}100%{width:200px}}
@keyframes nxFill{0%{width:0%}70%{width:60%}100%{width:95%}}
@keyframes nxGlow{0%,100%{color:#00a8e8;text-shadow:0 0 10px rgba(0,168,232,.3)}50%{color:#33bcf5;text-shadow:0 0 30px rgba(0,168,232,.8)}}
@keyframes nxSafeExit{to{opacity:0;visibility:hidden;pointer-events:none}}
</style>

<script>
(function(){
  "use strict";

  var el = document.getElementById.bind(document);

  /* ── Cookie helpers ──────────────────────────────── */

  function getCookie(n){
    var m = document.cookie.match(new RegExp('(?:^|; )' + n + '=([^;]*)'));
    return m ? m[1] : null;
  }

  /* ── Bail out if cookie exists (double-check JS side) */

  var overlay = el('nxi');
  if (!overlay) return;

  if (getCookie('nx_intro')) {
    overlay.remove();
    return;
  }

  /* ── Set cookie (30 min) and lock scroll ─────────── */

  document.cookie = 'nx_intro=1; path=/; expires=' +
    new Date(Date.now() + 1800000).toUTCString() + '; SameSite=Lax';
  document.body.style.overflow = 'hidden';
  document.documentElement.style.overflow = 'hidden';

  /* ── Fetch helper with timeout ───────────────────── */

  function fetchT(url, ms){
    var ctrl = new AbortController();
    var tid  = setTimeout(function(){ ctrl.abort(); }, ms);
    return fetch(url, { signal: ctrl.signal })
      .finally(function(){ clearTimeout(tid); });
  }

  /* ── Data promises — fire IMMEDIATELY, no timers ─── */

  var navPromise = fetchT(
    'https://api.codetabs.com/v1/proxy?quest=' +
    encodeURIComponent('https://docs.google.com/spreadsheets/d/e/2PACX-1vQT6dFLvqEDKW6UBHoMsr237H3mFu1WjmfKDOCJT1KGf2AQV3eU3jMFQQta_J8qGE9KCAadjIEZXoms/pub?output=csv'),
    8000
  )
  .then(function(r){
    if (!r.ok) throw new Error(r.status);
    return r.text();
  })
  .then(function(text){
    var lines = text.trim().split('\n');
    if (lines.length < 2) throw new Error('empty');
    var vals   = lines[1].split(',');
    var raised = parseFloat((vals[0]||'').replace(/[$,%\s]/g, ''));
    var net    = parseFloat((vals[1]||'').replace(/[$,%\s]/g, ''));
    if (isNaN(raised) || isNaN(net) || net === 0) throw new Error('bad data');
    return { classF: (net / raised) * 100, classA: (net / raised) * 100 * 0.9475 };
  });

  var weatherPromise = fetchT('https://ipapi.co/json/', 5000)
  .then(function(r){
    if (!r.ok) throw new Error(r.status);
    return r.json();
  })
  .then(function(d){
    if (!d.city || d.latitude == null) throw new Error('no loc');
    return fetchT(
      'https://api.open-meteo.com/v1/forecast?latitude=' + d.latitude +
      '&longitude=' + d.longitude + '&current_weather=true', 5000
    )
    .then(function(r){ return r.json(); })
    .then(function(wd){
      return d.city + '  |  ' + Math.round(wd.current_weather.temperature) + '\u00B0C';
    });
  });

  /* ── Render NAV data when it arrives ─────────────── */

  function fmt(n){
    return '$' + n.toLocaleString('en-CA', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
  }

  function animNAV(fillId, dollarId, pctId, val, delay){
    setTimeout(function(){
      var fill = el(fillId), dEl = el(dollarId), pEl = el(pctId);
      if (!fill || !dEl || !pEl) return;
      fill.style.width = Math.min(val, 100) + '%';
      var t0 = null;
      (function step(ts){
        if (!t0) t0 = ts;
        var p = Math.min((ts - t0) / 1800, 1);
        var v = 1 - Math.pow(1 - p, 3);
        dEl.textContent = fmt(val * v);
        pEl.textContent = (val * v).toFixed(2) + '%';
        if (p < 1) requestAnimationFrame(step);
      })(performance.now());
    }, delay);
  }

  navPromise.then(function(d){
    animNAV('nxi-bar-a', 'nxi-nav-a-dollar', 'nxi-nav-a-pct', d.classA, 100);
    animNAV('nxi-bar-f', 'nxi-nav-f-dollar', 'nxi-nav-f-pct', d.classF, 400);
  }).catch(function(){/* NAV unavailable — bars stay empty */});

  /* ── Render weather when it arrives ──────────────── */

  weatherPromise.then(function(text){
    var w = el('nxi-weather');
    if (w) { w.textContent = text; w.style.display = 'block'; }
  }).catch(function(){/* weather unavailable — hidden */});

  /* ── Exit sequence ───────────────────────────────── */

  var exited = false;

  function doExit(){
    if (exited) return;
    exited = true;

    // Cancel the CSS safety-net animation
    overlay.style.animation = 'none';

    // Phase 1: fade inner content
    overlay.classList.add('nxi-exiting');

    // Phase 2: show motto enlarged
    setTimeout(function(){
      overlay.classList.add('nxi-done');

      // Phase 3: fade entire overlay
      setTimeout(function(){
        overlay.classList.add('nxi-fadeout');
        setTimeout(function(){
          overlay.remove();
          document.body.style.overflow = '';
          document.documentElement.style.overflow = '';
        }, 1300);
      }, 2500);
    }, 650);
  }

  /* ── Wait for both data + minimum display time ───── */
  // Show the intro for at least 4s (CSS bar fill time), then exit
  // once data is resolved. If data is slow, exit when it arrives.
  // Absolute hard deadline: 12s (JS) + 14s (CSS safety net).

  var minTime = new Promise(function(ok){ setTimeout(ok, 4000); });

  Promise.all([
    minTime,
    navPromise.catch(function(){ return null; }),
    weatherPromise.catch(function(){ return null; })
  ]).then(function(){
    // Small extra pause so user can read the NAV numbers
    setTimeout(doExit, 2000);
  });

  // JS hard deadline (backup if Promise.all somehow hangs)
  setTimeout(function(){ doExit(); }, 12000);

  /* ── BFCache cleanup ─────────────────────────────── */

  window.addEventListener('pageshow', function(e){
    if (e.persisted) {
      var o = el('nxi');
      if (o) o.remove();
      document.body.style.overflow = '';
      document.documentElement.style.overflow = '';
    }
  });

})();
</script>
<?php
}
?>
