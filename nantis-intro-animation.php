<?php
/**
 * Plugin Name: NANTIS Intro Animation
 * Version: 8.0
 * Description: CSS-driven splash. Data loads as a bonus, never blocks exit.
 */

add_action( 'wp_footer', 'nantis_intro_cb' );

function nantis_intro_cb() {
    if ( ! is_front_page() ) return;
    if ( ! empty( $_COOKIE['nx_intro'] ) ) return;
?>
<div id="nxi">
  <div id="nxi-inner">
    <img id="nxi-logo" src="https://nantis.ca/wp-content/uploads/2026/03/logo.png" alt="NANTIS">
    <div id="nxi-line"></div>
    <span id="nxi-title">NANTIS</span>
    <span id="nxi-sub">Asset Management Inc.</span>

    <div id="nxi-bar-wrap">
      <div id="nxi-bar-track"><div id="nxi-bar"></div></div>
    </div>
    <span id="nxi-pct">0%</span>
    <span id="nxi-status">Loading data...</span>

    <span id="nxi-loc">EST. 2023 &nbsp;|&nbsp; Montr&eacute;al &nbsp;|&nbsp; Canada</span>
    <span id="nxi-weather"></span>
  </div>

  <div id="nxi-foot">
    <div id="nxi-nav-box">
      <div id="nxi-nav-hdr">2025 &nbsp;|&nbsp; Class A &amp; Class F NAV</div>
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
    <span id="nxi-motto">THINK OUTSIDE THE BOX<sup style="font-size:.4em;vertical-align:super;letter-spacing:0">&trade;</sup></span>
  </div>
</div>

<style>
#nxi{position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999999;background:#000;display:flex;flex-direction:column;box-sizing:border-box;overflow:hidden}
#nxi *{box-sizing:border-box;margin:0;padding:0}

/* ── Inner: vertically centered, compact gaps ─────── */
#nxi-inner{display:flex;flex-direction:column;align-items:center;justify-content:center;flex:1;width:100%;gap:12px;padding:20px 20px 10px;min-height:0;transition:opacity .6s ease}

/* ── Logo ─────────────────────────────────────────── */
#nxi-logo{width:110px;height:auto;filter:drop-shadow(0 0 24px rgba(0,168,232,.55));animation:nxPop .8s cubic-bezier(.34,1.56,.64,1) .2s both}

/* ── Line ─────────────────────────────────────────── */
#nxi-line{height:2px;background:#00a8e8;border-radius:2px;animation:nxGrow .8s ease .7s both}

/* ── Text ─────────────────────────────────────────── */
#nxi-title{color:#f0f2f5;font-size:2rem;font-weight:300;letter-spacing:.25em;text-transform:uppercase;font-family:'Architects Daughter',sans-serif;animation:nxUp .7s ease 1s both}
#nxi-sub{color:rgba(240,242,245,.6);font-size:.8rem;letter-spacing:.18em;text-transform:uppercase;font-family:sans-serif;animation:nxUp .7s ease 1.3s both}

/* ── Progress bar: pure CSS fill over 5s ──────────── */
#nxi-bar-wrap{width:250px;margin-top:6px}
#nxi-bar-track{width:100%;height:3px;background:rgba(0,168,232,.15);border-radius:2px}
#nxi-bar{width:0%;height:3px;background:#00a8e8;border-radius:2px;box-shadow:0 0 8px rgba(0,168,232,.8);animation:nxFill 5s ease-out 1.8s both}

/* ── Percent + status ─────────────────────────────── */
#nxi-pct{color:#00a8e8;font-size:.75rem;letter-spacing:.15em;font-family:sans-serif;text-align:center;animation:nxUp .4s ease 2s both}
#nxi-status{color:rgba(240,242,245,.35);font-size:.69rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;animation:nxUp .4s ease 2.5s both,nxGlow 1.5s ease-in-out 2.5s infinite}

/* ── Location + weather ───────────────────────────── */
#nxi-loc{color:rgba(240,242,245,.2);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif}
#nxi-weather{color:rgba(240,242,245,.6);font-size:.7rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;min-height:0;display:none}

/* ── Footer ───────────────────────────────────────── */
#nxi-foot{width:100%;padding:16px 24px 24px;display:flex;flex-direction:column;align-items:center;gap:10px;border-top:1px solid rgba(0,168,232,.15);flex-shrink:0}

/* ── NAV section ──────────────────────────────────── */
#nxi-nav-box{width:100%;max-width:380px;margin-bottom:8px}
#nxi-nav-hdr{color:rgba(240,242,245,.5);font-size:.69rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-bottom:8px}
.nxi-nr{margin-bottom:6px}
.nxi-nl{font-size:.69rem;letter-spacing:.15em;text-transform:uppercase;font-family:sans-serif;margin-bottom:3px}
.nxi-nbw{width:100%;height:22px;background:rgba(255,255,255,.06);border-radius:4px;position:relative;overflow:hidden}
.nxi-nbf{height:100%;width:0%;border-radius:4px;transition:width 1.8s cubic-bezier(.22,1,.36,1)}
.nxi-nbo{position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:space-between;padding:0 8px}
.nxi-nbo span{font-size:.75rem;color:#fff;font-family:sans-serif;font-weight:700}

/* ── Motto ────────────────────────────────────────── */
#nxi-motto{color:#00a8e8;font-size:1.4rem;letter-spacing:.12em;text-transform:uppercase;text-align:center;font-family:'Architects Daughter',sans-serif;animation:nxGlow 2.5s ease-in-out 2s infinite;transition:font-size 1s ease,letter-spacing 1s ease}

/* ── Keyframes ────────────────────────────────────── */
@keyframes nxPop{0%{opacity:0;transform:scale(.3) translateY(30px)}100%{opacity:1;transform:scale(1) translateY(0)}}
@keyframes nxUp{0%{opacity:0;transform:translateY(15px)}100%{opacity:1;transform:translateY(0)}}
@keyframes nxGrow{0%{width:0}100%{width:180px}}
@keyframes nxFill{0%{width:0}60%{width:55%}85%{width:80%}100%{width:100%}}
@keyframes nxGlow{0%,100%{color:#00a8e8;text-shadow:0 0 10px rgba(0,168,232,.3)}50%{color:#33bcf5;text-shadow:0 0 30px rgba(0,168,232,.8)}}

/* ── Mobile tweaks ────────────────────────────────── */
@media(max-height:700px){
  #nxi-inner{gap:8px;padding-top:12px}
  #nxi-logo{width:80px}
  #nxi-title{font-size:1.6rem}
  #nxi-sub{font-size:.7rem}
  #nxi-foot{padding:12px 20px 18px}
  #nxi-motto{font-size:1.1rem}
  .nxi-nbw{height:18px}
}
</style>

<script>
(function(){
  "use strict";

  /* ── Helpers ──────────────────────────────────────── */
  var g = document.getElementById.bind(document);

  function cookie(n){
    var m = document.cookie.match(new RegExp('(?:^|; )'+n+'=([^;]*)'));
    return m ? m[1] : null;
  }

  /* ── Bail if already seen ────────────────────────── */
  var ov = g('nxi');
  if (!ov) return;
  if (cookie('nx_intro')){ ov.remove(); return; }

  document.cookie = 'nx_intro=1; path=/; expires=' +
    new Date(Date.now()+1800000).toUTCString() + '; SameSite=Lax';
  document.body.style.overflow = 'hidden';
  document.documentElement.style.overflow = 'hidden';

  /* ── Percent counter (driven by CSS animation progress) ── */
  var pctEl  = g('nxi-pct');
  var barEl  = g('nxi-bar');
  var pctRAF = null;

  function trackBar(){
    if (!barEl || !pctEl) return;
    var w = barEl.getBoundingClientRect().width;
    var p = barEl.parentElement.getBoundingClientRect().width;
    var pct = p > 0 ? Math.round((w / p) * 100) : 0;
    pctEl.textContent = Math.min(pct, 100) + '%';
    if (pct < 100) pctRAF = requestAnimationFrame(trackBar);
    else pctEl.style.opacity = '0';
  }
  // Start tracking after bar animation begins (1.8s delay in CSS)
  setTimeout(function(){ pctRAF = requestAnimationFrame(trackBar); }, 1800);

  /* ── XHR loader (works in ALL browsers, no fetch deferral) ── */
  function xhrGet(url, timeout, cb){
    var x = new XMLHttpRequest();
    x.open('GET', url, true);
    x.timeout = timeout;
    x.onload = function(){
      if (x.status >= 200 && x.status < 300) cb(null, x.responseText);
      else cb(new Error(x.status));
    };
    x.onerror = x.ontimeout = function(){ cb(new Error('fail')); };
    x.send();
  }

  function xhrJSON(url, timeout, cb){
    xhrGet(url, timeout, function(err, txt){
      if (err) return cb(err);
      try { cb(null, JSON.parse(txt)); }
      catch(e){ cb(e); }
    });
  }

  /* ── NAV data ────────────────────────────────────── */
  var navLoaded = false;

  function loadNAV(){
    var sheetURL = 'https://docs.google.com/spreadsheets/d/e/' +
      '2PACX-1vQT6dFLvqEDKW6UBHoMsr237H3mFu1WjmfKDOCJT1KGf2AQV3eU3jMFQQta_J8qGE9KCAadjIEZXoms' +
      '/pub?output=csv';

    xhrGet('https://api.codetabs.com/v1/proxy?quest='+encodeURIComponent(sheetURL), 8000, function(err, text){
      navLoaded = true;
      if (err || !text) return;
      var lines = text.trim().split('\n');
      if (lines.length < 2) return;
      var vals = lines[1].split(',');
      var raised = parseFloat((vals[0]||'').replace(/[$,%\s]/g,''));
      var net    = parseFloat((vals[1]||'').replace(/[$,%\s]/g,''));
      if (isNaN(raised)||isNaN(net)||net===0) return;

      var cF = (net/raised)*100, cA = cF*0.9475;
      animBar('nxi-ba','nxi-ad','nxi-ap', cA, 100);
      animBar('nxi-bf','nxi-fd','nxi-fp', cF, 400);
    });
  }

  function fmt(n){
    return '$'+n.toLocaleString('en-CA',{minimumFractionDigits:2,maximumFractionDigits:2});
  }

  function animBar(fillId, dId, pId, val, delay){
    setTimeout(function(){
      var fill=g(fillId), dEl=g(dId), pEl=g(pId);
      if(!fill||!dEl||!pEl) return;
      fill.style.width = Math.min(val,100)+'%';
      var t0=performance.now();
      (function step(ts){
        var p=Math.min((ts-t0)/1800,1);
        var v=1-Math.pow(1-p,3);
        dEl.textContent=fmt(val*v);
        pEl.textContent=(val*v).toFixed(2)+'%';
        if(p<1) requestAnimationFrame(step);
      })(t0);
    }, delay);
  }

  /* ── Weather data ────────────────────────────────── */
  var weatherLoaded = false;

  function loadWeather(){
    xhrJSON('https://ipapi.co/json/', 5000, function(err, d){
      if (err||!d||!d.city||d.latitude==null){ weatherLoaded=true; return; }
      xhrJSON('https://api.open-meteo.com/v1/forecast?latitude='+d.latitude+
        '&longitude='+d.longitude+'&current_weather=true', 5000, function(err2, wd){
        weatherLoaded = true;
        if (err2||!wd||!wd.current_weather) return;
        var el = g('nxi-weather');
        if(el){
          el.textContent = d.city+'  |  '+Math.round(wd.current_weather.temperature)+'\u00B0C';
          el.style.display = 'block';
        }
      });
    });
  }

  /* ── Fire data loads using MULTIPLE strategies ───── */
  // XHR is not subject to the same deferral as fetch().
  // Fire immediately AND on load event for maximum reliability.

  var dataFired = false;
  function fireData(){
    if (dataFired) return;
    dataFired = true;
    loadNAV();
    loadWeather();
  }

  // Try immediately
  fireData();

  // Also on load (in case XHR was deferred too)
  window.addEventListener('load', fireData);

  /* ── Exit: timed, never waits for data ───────────── */
  // The intro runs for a fixed duration. Data that arrives in time
  // is shown; data that doesn't is simply not displayed.
  // This guarantees the overlay ALWAYS exits.

  var exited = false;

  function doExit(){
    if (exited) return;
    exited = true;
    if (pctRAF) cancelAnimationFrame(pctRAF);

    var inner = g('nxi-inner');
    var foot  = g('nxi-foot');
    var motto = g('nxi-motto');

    // Phase 1: fade upper content
    if(inner){ inner.style.opacity='0'; }
    if(foot){ foot.style.borderTop='none'; }

    // Phase 2: enlarge motto, then fade overlay
    setTimeout(function(){
      if(inner) inner.style.display='none';
      if(motto){ motto.style.fontSize='2.8rem'; motto.style.letterSpacing='.25em'; }
      setTimeout(function(){
        ov.style.transition='opacity 1.2s ease';
        ov.style.opacity='0';
        setTimeout(function(){
          ov.remove();
          document.body.style.overflow='';
          document.documentElement.style.overflow='';
        },1300);
      },2500);
    },650);
  }

  // Fixed timeline: exit after 8 seconds no matter what.
  // CSS bar fills in 5s (1.8s delay + ~5s fill = done by ~7s).
  // This gives ~1s of "100%" display before exit begins.
  setTimeout(doExit, 8000);

  /* ── BFCache ─────────────────────────────────────── */
  window.addEventListener('pageshow', function(e){
    if(e.persisted){
      var o=g('nxi'); if(o) o.remove();
      document.body.style.overflow='';
      document.documentElement.style.overflow='';
    }
  });

})();
</script>
<?php
}
?>
