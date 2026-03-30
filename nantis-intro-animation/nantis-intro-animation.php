<?php
/**
 * Plugin Name: NANTIS Intro Animation
 * Description: Full-screen intro overlay for the NANTIS homepage. Works on all devices.
 * Version: 8.0
 * Author: NANTIS
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* Enqueue the Architects Daughter font on front page */
add_action( 'wp_enqueue_scripts', 'nantis_intro_enqueue_font' );
function nantis_intro_enqueue_font() {
    if ( ! is_front_page() ) {
        return;
    }
    wp_enqueue_style(
        'nantis-architects-daughter',
        'https://fonts.googleapis.com/css2?family=Architects+Daughter&display=swap',
        array(),
        null
    );
}

/* Render intro overlay in footer — root front page only */
add_action( 'wp_footer', 'nantis_intro_render' );
function nantis_intro_render() {
    if ( ! is_front_page() ) {
        return;
    }
    if ( ! empty( $_COOKIE['nx_intro'] ) ) {
        return;
    }
    $path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
    if ( $path !== '' ) {
        return;
    }
    ?>
<!-- NANTIS Intro v8.0 — Pure CSS animations (no JS timers for sequencing) -->
<div id="nxi" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999999;background:#000;display:flex;flex-direction:column;align-items:center;justify-content:center;box-sizing:border-box;overflow:hidden">

  <!-- Main content -->
  <div id="nxi-main" style="display:flex;flex-direction:column;align-items:center;justify-content:center;flex:1;width:100%;gap:14px;padding:30px 20px 16px">

    <!-- Logo -->
    <img id="nxi-logo" src="<?php echo esc_url( plugins_url( 'logo.png', __FILE__ ) ); ?>" alt="NANTIS"
         style="width:120px;height:auto;filter:drop-shadow(0 0 20px rgba(0,168,232,.5))">

    <!-- Accent line -->
    <div id="nxi-line" style="height:2px;background:#00a8e8;border-radius:2px"></div>

    <!-- Company name -->
    <span id="nxi-name" style="color:#f0f2f5;font-size:2rem;font-weight:300;letter-spacing:.25em;text-transform:uppercase;font-family:'Architects Daughter',sans-serif">NANTIS</span>

    <!-- Subtitle -->
    <span id="nxi-sub" style="color:rgba(240,242,245,.6);font-size:.8rem;letter-spacing:.18em;text-transform:uppercase;font-family:sans-serif">Asset Management Inc.</span>

    <!-- Progress bar -->
    <div style="width:200px;margin-top:6px">
      <div style="width:100%;height:2px;background:rgba(0,168,232,.15);border-radius:2px">
        <div id="nxi-bar" style="height:2px;background:#00a8e8;border-radius:2px;box-shadow:0 0 8px rgba(0,168,232,.8)"></div>
      </div>
    </div>
    <span id="nxi-pct" style="color:#00a8e8;font-size:.6rem;letter-spacing:.15em;font-family:sans-serif">0%</span>

    <!-- Loading text -->
    <span id="nxi-load" style="color:rgba(240,242,245,.35);font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif">Loading data...</span>

    <!-- Location -->
    <span style="color:rgba(240,242,245,.2);font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;margin-top:2px">EST. 2023 &nbsp;|&nbsp; Montr&eacute;al &nbsp;|&nbsp; Canada</span>

    <!-- Weather -->
    <span id="nxi-weather" style="color:rgba(240,242,245,.6);font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;opacity:0;transition:opacity .5s ease"></span>
  </div>

  <!-- Footer: NAV bars + motto -->
  <div id="nxi-footer" style="width:100%;padding:20px 28px 28px;display:flex;flex-direction:column;align-items:center;gap:10px;border-top:1px solid rgba(0,168,232,.15)">

    <div style="width:100%;max-width:320px;margin-bottom:10px">
      <div style="color:rgba(240,242,245,.5);font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-bottom:10px">2025 &nbsp;|&nbsp; Class A &amp; Class F NAV</div>

      <!-- Class A bar -->
      <div style="margin-bottom:8px">
        <div style="color:#00c9d4;font-size:.55rem;letter-spacing:.15em;text-transform:uppercase;font-family:sans-serif;margin-bottom:4px">Class A</div>
        <div style="width:100%;height:18px;background:rgba(255,255,255,.06);border-radius:4px;position:relative;overflow:hidden">
          <div id="nxi-fill-a" style="height:100%;width:0%;background:linear-gradient(90deg,#006d75,#00c9d4);border-radius:4px;transition:width 1.8s cubic-bezier(.22,1,.36,1)"></div>
          <div style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:space-between;padding:0 8px">
            <span id="nxi-val-a" style="font-size:.6rem;color:#fff;font-family:sans-serif;font-weight:700"></span>
            <span id="nxi-pval-a" style="font-size:.6rem;color:#fff;font-family:sans-serif;font-weight:700"></span>
          </div>
        </div>
      </div>

      <!-- Class F bar -->
      <div>
        <div style="color:#00AEEF;font-size:.55rem;letter-spacing:.15em;text-transform:uppercase;font-family:sans-serif;margin-bottom:4px">Class F</div>
        <div style="width:100%;height:18px;background:rgba(255,255,255,.06);border-radius:4px;position:relative;overflow:hidden">
          <div id="nxi-fill-f" style="height:100%;width:0%;background:linear-gradient(90deg,#0a4a7a,#00AEEF);border-radius:4px;transition:width 1.8s cubic-bezier(.22,1,.36,1)"></div>
          <div style="position:absolute;top:0;left:0;right:0;bottom:0;display:flex;align-items:center;justify-content:space-between;padding:0 8px">
            <span id="nxi-val-f" style="font-size:.6rem;color:#fff;font-family:sans-serif;font-weight:700"></span>
            <span id="nxi-pval-f" style="font-size:.6rem;color:#fff;font-family:sans-serif;font-weight:700"></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Motto -->
    <span id="nxi-motto" style="color:#00a8e8;font-size:1.5rem;letter-spacing:.12em;text-transform:uppercase;text-align:center;font-family:'Architects Daughter',sans-serif">THINK OUTSIDE THE BOX<sup style="font-size:.4em;vertical-align:super;letter-spacing:0">&trade;</sup></span>
  </div>
</div>

<style>
/*
 * ALL animations are pure CSS @keyframes with animation-delay.
 * CSS animations run on the compositor thread and are NEVER
 * throttled by mobile browsers — they play without user interaction.
 *
 * Timeline:
 *   0.0s  — overlay appears
 *   0.2s  — logo pops in
 *   0.7s  — accent line grows
 *   1.0s  — "NANTIS" fades up
 *   1.3s  — subtitle fades up
 *   1.5s  — progress bar starts filling (3s duration)
 *   2.0s  — motto glow starts
 *   4.5s  — progress bar done, pct fades out, "Loading data..." pulses
 *   8.5s  — main content fades out
 *   9.2s  — motto enlarges
 *  11.7s  — entire overlay fades out
 *  12.7s  — overlay removed by animationend event
 */

/* Logo pop-in */
#nxi-logo {
  animation: nxPopIn .7s cubic-bezier(.34,1.56,.64,1) .2s both;
}
@keyframes nxPopIn {
  from { opacity:0; transform:scale(.4) translateY(20px); }
  to   { opacity:1; transform:scale(1) translateY(0); }
}

/* Accent line grow */
#nxi-line {
  animation: nxLineGrow .7s ease .7s both;
}
@keyframes nxLineGrow {
  from { width:0; }
  to   { width:200px; }
}

/* Name fade-up */
#nxi-name {
  animation: nxFadeUp .6s ease 1s both;
}

/* Subtitle fade-up */
#nxi-sub {
  animation: nxFadeUp .6s ease 1.3s both;
}
@keyframes nxFadeUp {
  from { opacity:0; transform:translateY(14px); }
  to   { opacity:1; transform:translateY(0); }
}

/* Progress bar fill (3s, starts at 1.5s) */
#nxi-bar {
  animation: nxBarFill 3s linear 1.5s both;
}
@keyframes nxBarFill {
  from { width:0%; }
  to   { width:100%; }
}

/* Percentage text — visible during bar fill, then fades out */
#nxi-pct {
  animation: nxPctFade .4s ease 4.5s both;
}
@keyframes nxPctFade {
  from { opacity:1; }
  to   { opacity:0; }
}

/* "Loading data..." — hidden, then pulses after bar completes */
#nxi-load {
  animation: nxLoadAppear .3s ease 4.5s both, nxPulse 1.5s ease-in-out 4.8s infinite;
}
@keyframes nxLoadAppear {
  from { opacity:0; }
  to   { opacity:.5; }
}
@keyframes nxPulse {
  0%,100% { opacity:.35; }
  50%     { opacity:.7; }
}

/* Motto glow (starts at 2s) */
#nxi-motto {
  animation: nxGlow 2.5s ease-in-out 2s infinite;
}
@keyframes nxGlow {
  0%,100% { color:#00a8e8; text-shadow:0 0 10px rgba(0,168,232,.3); }
  50%     { color:#33bcf5; text-shadow:0 0 30px rgba(0,168,232,.8); }
}

/* ── EXIT SEQUENCE (all CSS, no JS timers) ───────── */

/* Phase 1: main content fades out at 8.5s */
#nxi-main {
  animation: nxMainOut .6s ease 8.5s both;
}
@keyframes nxMainOut {
  from { opacity:1; }
  to   { opacity:0; visibility:hidden; }
}

/* Footer border disappears at 8.5s */
#nxi-footer {
  animation: nxBorderOut .3s ease 8.5s both;
}
@keyframes nxBorderOut {
  from { border-top-color:rgba(0,168,232,.15); }
  to   { border-top-color:transparent; }
}

/* Phase 2: motto enlarges at 9.2s — override the infinite glow with a
   new animation that also includes the glow + size change */
@keyframes nxMottoGrow {
  0%   { font-size:1.5rem; letter-spacing:.12em; }
  100% { font-size:2.8rem; letter-spacing:.25em; }
}

/* Phase 3: entire overlay fades out at 11.7s */
#nxi {
  animation: nxOverlayOut 1s ease 11.7s both;
}
@keyframes nxOverlayOut {
  from { opacity:1; }
  to   { opacity:0; }
}
</style>

<script>
(function(){
  var O=document.getElementById('nxi');
  if(!O)return;

  /* Set cookie so intro won't show again for 30 min */
  document.cookie='nx_intro=1;path=/;max-age=1800;SameSite=Lax';

  /* ── Percentage counter (CSS drives the bar, JS updates the text) ── */
  /* We use requestAnimationFrame here ONLY for the text counter.
     Even if rAF is throttled, the bar still fills via CSS animation.
     The counter is cosmetic — the intro completes regardless. */
  var pctEl=document.getElementById('nxi-pct');
  var barStart=null;
  var barDelay=1500; /* matches CSS animation-delay */
  var barDur=3000;   /* matches CSS animation duration */
  function updatePct(ts){
    if(!barStart)barStart=ts;
    var elapsed=ts-barStart-barDelay;
    if(elapsed<0){requestAnimationFrame(updatePct);return;}
    var p=Math.min(elapsed/barDur*100,100);
    if(pctEl)pctEl.textContent=Math.round(p)+'%';
    if(p<100)requestAnimationFrame(updatePct);
  }
  requestAnimationFrame(updatePct);

  /* ── Motto enlarge at 9.2s ── */
  /* We add the grow animation via JS at 9.2s because we need to
     override the infinite glow. CSS can't override an earlier
     animation declaration at a specific time without JS. BUT we
     also set a CSS fallback in case JS timers are frozen. */
  var motto=document.getElementById('nxi-motto');

  /* CSS fallback: if JS doesn't fire, the overlay still fades out at 11.7s.
     The motto just won't enlarge — acceptable degradation. */
  function mottoGrow(){
    if(!motto)return;
    motto.style.animation='nxMottoGrow .8s ease forwards, nxGlow 2.5s ease-in-out infinite';
  }

  /* Try setTimeout (works on desktop, may be delayed on mobile) */
  setTimeout(mottoGrow,9200);

  /* ── Remove overlay from DOM after fade-out completes ── */
  /* animationend fires when the nxOverlayOut CSS animation ends.
     This is CSS-driven, so it fires even on mobile without interaction. */
  O.addEventListener('animationend',function(e){
    if(e.animationName==='nxOverlayOut'){
      if(O.parentNode)O.parentNode.removeChild(O);
    }
  });

  /* ── Tap/click to skip immediately ── */
  function skip(){
    O.style.animation='none';
    O.style.transition='opacity .8s ease';
    O.style.opacity='0';
    setTimeout(function(){
      if(O.parentNode)O.parentNode.removeChild(O);
    },900);
  }
  O.addEventListener('click',skip);
  O.addEventListener('touchend',skip);

  /* ── Handle bfcache ── */
  window.addEventListener('pageshow',function(e){
    if(e.persisted&&O.parentNode){
      O.style.animation='none';
      O.style.transition='opacity .5s';
      O.style.opacity='0';
      setTimeout(function(){if(O.parentNode)O.parentNode.removeChild(O);},600);
    }
  });

  /* ── NAV data fetch (best-effort, cosmetic only) ── */
  var CSV='https://docs.google.com/spreadsheets/d/e/2PACX-1vQT6dFLvqEDKW6UBHoMsr237H3mFu1WjmfKDOCJT1KGf2AQV3eU3jMFQQta_J8qGE9KCAadjIEZXoms/pub?output=csv';

  function pn(s){return s?parseFloat(s.replace(/[$,%\s]/g,'')):NaN;}
  function fm(n){return '$'+n.toLocaleString('en-CA',{minimumFractionDigits:2,maximumFractionDigits:2});}

  function navBar(fId,dId,pId,dv,pv){
    var fl=document.getElementById(fId),
        de=document.getElementById(dId),
        pe=document.getElementById(pId);
    if(!fl||!de||!pe)return;
    fl.style.width=Math.min(pv,100)+'%';
    de.textContent=fm(dv);
    pe.textContent=pv.toFixed(2)+'%';
  }

  var ctrl=typeof AbortController!=='undefined'?new AbortController():null;
  var fetchOpts=ctrl?{signal:ctrl.signal}:{};
  var abortTimer=setTimeout(function(){if(ctrl)ctrl.abort();},5000);

  fetch('https://api.codetabs.com/v1/proxy?quest='+encodeURIComponent(CSV),fetchOpts)
    .then(function(r){return r.text();})
    .then(function(t){
      clearTimeout(abortTimer);
      var lines=t.trim().split('\n');
      if(lines.length<2)return;
      var v=lines[1].split(',');
      var raised=pn(v[0]),net=pn(v[1]);
      if(isNaN(raised)||isNaN(net)||net===0)return;
      var cF=(net/raised)*100,cA=cF*0.9475;
      navBar('nxi-fill-a','nxi-val-a','nxi-pval-a',cA,cA);
      navBar('nxi-fill-f','nxi-val-f','nxi-pval-f',cF,cF);
    })
    .catch(function(){clearTimeout(abortTimer);});

  /* ── Weather (best-effort) ── */
  fetch('https://ipapi.co/json/')
    .then(function(r){return r.json();})
    .then(function(d){
      if(!d.city||!d.latitude)return;
      return fetch('https://api.open-meteo.com/v1/forecast?latitude='+d.latitude+'&longitude='+d.longitude+'&current_weather=true')
        .then(function(r){return r.json();})
        .then(function(w){
          var el=document.getElementById('nxi-weather');
          if(el){
            el.textContent=d.city+'  |  '+Math.round(w.current_weather.temperature)+'\u00B0C';
            el.style.opacity='1';
          }
        });
    })
    .catch(function(){});

})();
</script>
<?php
}
