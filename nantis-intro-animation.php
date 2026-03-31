<?php
/**
 * Plugin Name: NANTIS Intro Animation
 * Version: 9.0
 * Description: Two-screen intro splash with EN/FR language selection.
 *              Screen 1: static branding + language buttons (CSS only).
 *              Screen 2: progress bar, NAV data, weather (XHR on click).
 */

add_action( 'wp_footer', 'nantis_intro_cb' );

function nantis_intro_cb() {
    if ( ! is_front_page() ) return;
    if ( ! empty( $_COOKIE['nx_intro'] ) ) return;
?>
<div id="nxi">
  <div id="nxi-s1">
    <img id="nxi-logo" src="https://nantis.ca/wp-content/uploads/2026/03/logo.png" alt="NANTIS">
    <div id="nxi-line"></div>
    <span class="nxi-title">NANTIS</span>
    <span class="nxi-sub">Asset Management Inc.</span>
    <span class="nxi-loc">EST. 2023 &nbsp;|&nbsp; Montr&eacute;al &nbsp;|&nbsp; Canada</span>

    <div class="nxi-btns">
      <button class="nxi-btn" data-lang="en">ENGLISH</button>
      <button class="nxi-btn" data-lang="fr">FRAN&Ccedil;AIS</button>
    </div>

    <span id="nxi-s1-weather" class="nxi-s1-weather"></span>

    <div class="nxi-contact">
      <svg class="nxi-contact-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(0,168,232,.7)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6A19.79 19.79 0 012.12 4.18 2 2 0 014.11 2h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>514.416.3466<span class="nxi-contact-sep">||</span><svg class="nxi-contact-icon" viewBox="0 0 24 24" fill="none" stroke="rgba(0,168,232,.7)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/></svg>INFO@NANTIS.CA
    </div>
  </div>

  <div id="nxi-motto-s1">
    <span>THINK OUTSIDE THE BOX<sup class="nxi-tm">&trade;</sup></span>
  </div>

  <div id="nxi-s2">
    <img class="nxi-s2-logo" src="https://nantis.ca/wp-content/uploads/2026/03/logo.png"
         style="width:90px;height:auto;filter:drop-shadow(0 0 20px rgba(0,168,232,.45));margin-bottom:4px" alt="">

    <div class="nxi-bar-wrap">
      <div class="nxi-bar-track"><div id="nxi-bar"></div></div>
    </div>
    <span id="nxi-pct">0%</span>
    <span id="nxi-status">Loading data...</span>
    <span id="nxi-weather"></span>

    <div class="nxi-nav-box">
      <div class="nxi-nav-hdr">2025 &nbsp;|&nbsp; Class A &amp; Class F NAV</div>
      <div class="nxi-nr">
        <div class="nxi-nl" style="color:#00c9d4">Class A</div>
        <div class="nxi-nbw">
          <div id="nxi-ba" class="nxi-nbf" style="background:linear-gradient(90deg,#006d75,#00c9d4)"></div>
          <div class="nxi-nbo"><span id="nxi-ad"></span><span id="nxi-ap"></span></div>
        </div>
      </div>
      <div class="nxi-nr">
        <div class="nxi-nl" style="color:#00AEEF">Class F</div>
        <div class="nxi-nbw">
          <div id="nxi-bf" class="nxi-nbf" style="background:linear-gradient(90deg,#0a4a7a,#00AEEF)"></div>
          <div class="nxi-nbo"><span id="nxi-fd"></span><span id="nxi-fp"></span></div>
        </div>
      </div>
    </div>

    <span id="nxi-motto-s2">THINK OUTSIDE THE BOX<sup class="nxi-tm">&trade;</sup></span>
  </div>
</div>

<style>
#nxi{position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999999;background:#000;display:flex;flex-direction:column;align-items:center;justify-content:center;transition:opacity 1.2s ease}
#nxi *{box-sizing:border-box;margin:0;padding:0}
#nxi-s1{display:flex;flex-direction:column;align-items:center;justify-content:center;flex:1;width:100%;gap:16px;padding:30px 20px 0}
#nxi-logo{width:120px;height:auto;filter:drop-shadow(0 0 24px rgba(0,168,232,.55));animation:nxPop .8s cubic-bezier(.34,1.56,.64,1) .2s both,nxLogoGlow 3s ease-in-out 1.5s infinite}
#nxi-line{height:2px;background:#00a8e8;border-radius:2px;animation:nxGrow .8s ease .7s both}
.nxi-title{color:#f0f2f5;font-size:2.2rem;font-weight:300;letter-spacing:.25em;text-transform:uppercase;font-family:'Architects Daughter',sans-serif;animation:nxUp .7s ease 1s both}
.nxi-sub{color:rgba(240,242,245,.6);font-size:.82rem;letter-spacing:.18em;text-transform:uppercase;font-family:sans-serif;animation:nxUp .7s ease 1.3s both}
.nxi-loc{color:rgba(240,242,245,.2);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;margin-top:4px;animation:nxUp .7s ease 1.5s both}
.nxi-btns{display:flex;gap:20px;margin-top:24px;animation:nxUp .7s ease 1.8s both}
.nxi-btn{padding:11.5px 41px;background:rgba(0,0,0,.85);border:1px solid #00a8e8;color:#00a8e8;font-size:.86rem;letter-spacing:.3em;text-transform:uppercase;text-decoration:none;font-family:'Architects Daughter',sans-serif;cursor:pointer;border-radius:3px;box-shadow:0 0 12px rgba(0,168,232,.5);transition:background .3s,box-shadow .3s;-webkit-appearance:none}
.nxi-btn:hover{background:rgba(0,168,232,.15);box-shadow:0 0 24px rgba(0,168,232,.9)}
.nxi-s1-weather{color:rgba(240,242,245,.5);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-top:9px;display:none;animation:nxUp .5s ease both}
.nxi-contact{color:rgba(240,242,245,.25);font-size:.7rem;letter-spacing:.18em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-top:6px;padding-bottom:0;animation:nxUp .7s ease 2s both,nxContactGlow 3s ease-in-out 2.5s infinite}
.nxi-contact-icon{display:inline-block;width:14px;height:14px;vertical-align:-2px;margin-right:4px;filter:drop-shadow(0 0 4px rgba(0,168,232,.6));animation:nxIconGlow 3s ease-in-out 2.5s infinite}
.nxi-contact-sep{display:inline-block;margin:0 10px;color:rgba(240,242,245,.12)}
#nxi-motto-s1{width:100%;padding:18px 24px 26px;text-align:center;flex-shrink:0;border-top:1px solid rgba(0,168,232,.15)}
#nxi-motto-s1 span{color:#00a8e8;font-size:1.35rem;letter-spacing:.12em;text-transform:uppercase;font-family:'Architects Daughter',sans-serif;animation:nxGlow 2.5s ease-in-out 2s infinite}
.nxi-tm{font-size:.4em;vertical-align:super;letter-spacing:0}
#nxi-s2{display:none;flex-direction:column;align-items:center;justify-content:center;width:100%;height:100%;padding:30px 20px;gap:14px}
.nxi-bar-wrap{width:260px}
.nxi-bar-track{width:100%;height:3px;background:rgba(0,168,232,.15);border-radius:2px}
#nxi-bar{width:0%;height:3px;background:#00a8e8;border-radius:2px;box-shadow:0 0 8px rgba(0,168,232,.8);transition:width .15s linear}
#nxi-pct{color:#00a8e8;font-size:.75rem;letter-spacing:.15em;font-family:sans-serif;text-align:center;transition:opacity .4s ease}
#nxi-status{color:rgba(240,242,245,.35);font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;animation:nxGlow 1.5s ease-in-out infinite}
#nxi-weather{color:rgba(240,242,245,.6);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;display:none}
.nxi-nav-box{width:100%;max-width:380px;margin-top:10px}
.nxi-nav-hdr{color:rgba(240,242,245,.5);font-size:.65rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-bottom:10px}
.nxi-nr{margin-bottom:8px}
.nxi-nl{font-size:.65rem;letter-spacing:.15em;text-transform:uppercase;font-family:sans-serif;margin-bottom:3px}
.nxi-nbw{width:100%;height:22px;background:rgba(255,255,255,.06);border-radius:4px;position:relative;overflow:hidden}
.nxi-nbf{height:100%;width:0%;border-radius:4px;transition:width 1.8s cubic-bezier(.22,1,.36,1)}
.nxi-nbo{position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:space-between;padding:0 8px}
.nxi-nbo span{font-size:.75rem;color:#fff;font-family:sans-serif;font-weight:700}
#nxi-motto-s2{color:#00a8e8;font-size:1.35rem;letter-spacing:.12em;text-transform:uppercase;text-align:center;font-family:'Architects Daughter',sans-serif;margin-top:20px;animation:nxGlow 2.5s ease-in-out infinite;transition:font-size 1s ease,letter-spacing 1s ease}
#nxi.nxi-fadeout{opacity:0}
@keyframes nxPop{0%{opacity:0;transform:scale(.3) translateY(30px)}100%{opacity:1;transform:scale(1) translateY(0)}}
@keyframes nxUp{0%{opacity:0;transform:translateY(15px)}100%{opacity:1;transform:translateY(0)}}
@keyframes nxGrow{0%{width:0}100%{width:180px}}
@keyframes nxGlow{0%,100%{color:#00a8e8;text-shadow:0 0 10px rgba(0,168,232,.3)}50%{color:#33bcf5;text-shadow:0 0 30px rgba(0,168,232,.8)}}
@keyframes nxContactGlow{0%,100%{color:rgba(240,242,245,.25);text-shadow:0 0 6px rgba(0,168,232,.15)}50%{color:rgba(240,242,245,.45);text-shadow:0 0 14px rgba(0,168,232,.4)}}
@keyframes nxIconGlow{0%,100%{filter:drop-shadow(0 0 4px rgba(0,168,232,.4));opacity:.5}50%{filter:drop-shadow(0 0 10px rgba(0,168,232,.9));opacity:.85}}
@keyframes nxLogoGlow{0%,100%{filter:drop-shadow(0 0 24px rgba(0,168,232,.45))}50%{filter:drop-shadow(0 0 40px rgba(0,168,232,.85))}}
@media(max-height:650px){
  #nxi-logo{width:80px}
  .nxi-title{font-size:1.7rem}
  .nxi-sub{font-size:.7rem}
  .nxi-btns{gap:14px;margin-top:15px}
  .nxi-btn{padding:9px 32px;font-size:.75rem}
  .nxi-s1-weather{font-size:.6rem}
  .nxi-contact{font-size:.6rem;padding-bottom:10px}
  #nxi-motto-s1{padding:14px 20px 18px}
  #nxi-motto-s1 span{font-size:1.1rem}
  #nxi-s2{gap:10px;padding:20px 16px}
  #nxi-motto-s2{font-size:1.1rem;margin-top:12px}
  .nxi-nbw{height:18px}
}
</style>

<script>
(function(){
  "use strict";

  var g = document.getElementById.bind(document);
  var ov    = g('nxi');
  var s1    = g('nxi-s1');
  var s2    = g('nxi-s2');
  var motto1= g('nxi-motto-s1');
  var bar   = g('nxi-bar');
  var pctEl = g('nxi-pct');
  var statusEl = g('nxi-status');

  if (!ov) return;

  /* ── Cookie check ────────────────────────────────── */

  function cookie(n){
    var m = document.cookie.match(new RegExp('(?:^|; )'+n+'=([^;]*)'));
    return m ? m[1] : null;
  }

  if (cookie('nx_intro')) {
    ov.remove();
    return;
  }

  document.cookie = 'nx_intro=1; path=/; expires=' +
    new Date(Date.now() + 1800000).toUTCString() + '; SameSite=Lax';
  document.body.style.overflow = 'hidden';
  document.documentElement.style.overflow = 'hidden';

  /* ── Language button click → Screen 2 ────────────── */

  var targetURL = '';

  var btns = document.querySelectorAll('.nxi-btn');
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener('click', function(e){
      e.preventDefault();
      var lang = this.getAttribute('data-lang');
      targetURL = lang;

      s1.style.transition = 'opacity .5s ease';
      s1.style.opacity = '0';
      motto1.style.transition = 'opacity .5s ease';
      motto1.style.opacity = '0';

      setTimeout(function(){
        s1.style.display = 'none';
        motto1.style.display = 'none';

        s2.style.display = 'flex';
        s2.style.opacity = '0';
        s2.style.transition = 'opacity .5s ease';
        requestAnimationFrame(function(){ s2.style.opacity = '1'; });

        startLoading();
      }, 500);
    });
  }

  /* ── Progress bar ────────────────────────────────── */

  var progress = 0;
  var barTimer = null;

  function setProgress(val) {
    progress = Math.min(val, 100);
    bar.style.width = Math.round(progress) + '%';
    pctEl.textContent = Math.round(progress) + '%';
  }

  function animProgress(target, ms) {
    var start = progress;
    var t0 = Date.now();
    if (barTimer) clearInterval(barTimer);
    barTimer = setInterval(function(){
      var p = Math.min((Date.now() - t0) / ms, 1);
      setProgress(start + (target - start) * p);
      if (p >= 1) clearInterval(barTimer);
    }, 30);
  }

  var navDone = false, weatherDone = false;

  function checkDone() {
    if (navDone && weatherDone) {
      animProgress(100, 400);
      setTimeout(doExit, 3500);
    }
  }

  function startLoading() {
    animProgress(25, 1200);
    loadNAV();
    loadWeatherForS2();
    setTimeout(doExit, 15000);
  }

  /* ── NAV ──────────────────────────────────────────── */

  function loadNAV() {
    var url = 'https://docs.google.com/spreadsheets/d/e/' +
      '2PACX-1vQT6dFLvqEDKW6UBHoMsr237H3mFu1WjmfKDOCJT1KGf2AQV3eU3jMFQQta_J8qGE9KCAadjIEZXoms' +
      '/pub?output=csv';
    var x = new XMLHttpRequest();
    x.open('GET', 'https://api.codetabs.com/v1/proxy?quest=' + encodeURIComponent(url));
    x.timeout = 8000;
    x.onload = function() {
      navDone = true;
      if (x.status < 200 || x.status >= 300) { setProgress(60); checkDone(); return; }
      var lines = x.responseText.trim().split('\n');
      if (lines.length < 2) { setProgress(60); checkDone(); return; }
      var vals = lines[1].split(',');
      var raised = parseFloat((vals[0]||'').replace(/[$,%\s]/g,''));
      var net    = parseFloat((vals[1]||'').replace(/[$,%\s]/g,''));
      if (isNaN(raised) || isNaN(net) || net === 0) { setProgress(60); checkDone(); return; }

      var cF = (net/raised)*100, cA = cF * 0.9475;
      animProgress(60, 500);
      animNAV('nxi-ba','nxi-ad','nxi-ap', cA, 200);
      animNAV('nxi-bf','nxi-fd','nxi-fp', cF, 500);
      checkDone();
    };
    x.onerror = x.ontimeout = function() {
      navDone = true; setProgress(60); checkDone();
    };
    x.send();
  }

  function fmt(n) {
    return '$' + n.toLocaleString('en-CA', { minimumFractionDigits:2, maximumFractionDigits:2 });
  }

  function animNAV(fillId, dId, pId, val, delay) {
    setTimeout(function(){
      var fill = g(fillId), dEl = g(dId), pEl = g(pId);
      if (!fill || !dEl || !pEl) return;
      fill.style.width = Math.min(val,100) + '%';
      var t0 = performance.now();
      (function step(ts){
        var p = Math.min((ts - t0)/1800, 1);
        var v = 1 - Math.pow(1-p, 3);
        dEl.textContent = fmt(val * v);
        pEl.textContent = (val * v).toFixed(2) + '%';
        if (p < 1) requestAnimationFrame(step);
      })(t0);
    }, delay);
  }

  /* ── Weather (loads immediately for Screen 1) ─────── */

  var weatherText = '';

  function fetchWeatherNow() {
    var x = new XMLHttpRequest();
    x.open('GET', 'https://ipapi.co/json/');
    x.timeout = 5000;
    x.onload = function() {
      if (x.status < 200 || x.status >= 300) return;
      try {
        var d = JSON.parse(x.responseText);
        if (!d.city || d.latitude == null) return;

        var x2 = new XMLHttpRequest();
        x2.open('GET', 'https://api.open-meteo.com/v1/forecast?latitude='+d.latitude+'&longitude='+d.longitude+'&current_weather=true');
        x2.timeout = 5000;
        x2.onload = function() {
          try {
            var wd = JSON.parse(x2.responseText);
            if (wd.current_weather) {
              weatherText = d.city + '  |  ' + Math.round(wd.current_weather.temperature) + '\u00B0C';
              var s1w = g('nxi-s1-weather');
              if (s1w) { s1w.textContent = weatherText; s1w.style.display = 'block'; }
            }
          } catch(e){}
        };
        x2.onerror = x2.ontimeout = function(){};
        x2.send();
      } catch(e){}
    };
    x.onerror = x.ontimeout = function(){};
    x.send();
  }

  fetchWeatherNow();

  function loadWeatherForS2() {
    if (weatherText) {
      var el = g('nxi-weather');
      if (el) { el.textContent = weatherText; el.style.display = 'block'; }
      weatherDone = true;
      setProgress(Math.max(progress, 85));
      checkDone();
      return;
    }
    var waited = 0;
    var poll = setInterval(function(){
      waited += 300;
      if (weatherText) {
        clearInterval(poll);
        var el = g('nxi-weather');
        if (el) { el.textContent = weatherText; el.style.display = 'block'; }
        weatherDone = true;
        setProgress(Math.max(progress, 85));
        checkDone();
      } else if (waited >= 4000) {
        clearInterval(poll);
        weatherDone = true;
        setProgress(Math.max(progress, 80));
        checkDone();
      }
    }, 300);
  }

  /* ── Exit → redirect to chosen language ──────────── */

  var exited = false;

  function doExit() {
    if (exited) return;
    exited = true;
    if (barTimer) clearInterval(barTimer);
    setProgress(100);

    setTimeout(function(){
      var mottoS2 = g('nxi-motto-s2');
      var navBox  = document.querySelector('.nxi-nav-box');
      var barWrap = document.querySelector('.nxi-bar-wrap');

      [pctEl, statusEl, g('nxi-weather'), navBox, barWrap, document.querySelector('.nxi-s2-logo')].forEach(function(el){
        if (el) { el.style.transition = 'opacity .5s ease'; el.style.opacity = '0'; }
      });

      setTimeout(function(){
        [pctEl, statusEl, g('nxi-weather'), navBox, barWrap, document.querySelector('.nxi-s2-logo')].forEach(function(el){
          if (el) el.style.display = 'none';
        });

        if (mottoS2) {
          mottoS2.style.fontSize = '2.8rem';
          mottoS2.style.letterSpacing = '.25em';
        }

        setTimeout(function(){
          ov.classList.add('nxi-fadeout');
          setTimeout(function(){
            ov.remove();
            document.body.style.overflow = '';
            document.documentElement.style.overflow = '';
            // French: redirect to /fr/. English: already on nantis.ca, no redirect needed.
            if (targetURL === 'fr') window.location.href = 'https://nantis.ca/fr/';
          }, 1300);
        }, 2500);
      }, 550);
    }, 500);
  }

  /* ── BFCache cleanup ─────────────────────────────── */

  window.addEventListener('pageshow', function(e){
    if (e.persisted) {
      var o = g('nxi'); if (o) o.remove();
      document.body.style.overflow = '';
      document.documentElement.style.overflow = '';
    }
  });

})();
</script>
<?php
}
?>
