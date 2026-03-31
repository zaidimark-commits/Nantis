<?php
/**
 * Plugin Name: NANTIS Intro Animation
 * Version: 6.0
 * Description: Splash screen with progress bar, NAV data, and weather.
 *              Desktop auto-starts. Mobile waits for GO tap.
 */

add_action( 'wp_footer', 'nantis_intro_cb' );

function nantis_intro_cb() {
    if ( ! is_front_page() ) {
        return;
    }
    if ( ! empty( $_COOKIE['nx_intro'] ) ) {
        return;
    }
    ?>
<div id="nxi" style="position:fixed!important;top:0!important;left:0!important;width:100%!important;height:100%!important;z-index:9999999!important;background:#000!important;display:flex!important;flex-direction:column!important;align-items:center!important;justify-content:center!important;gap:0!important;box-sizing:border-box!important;overflow:hidden!important">

  <!-- Main content area -->
  <div id="nxi-inner" style="display:flex!important;flex-direction:column!important;align-items:center!important;justify-content:center!important;flex:1!important;width:100%!important;gap:20px!important;padding-top:40px!important">

    <img src="https://nantis.ca/wp-content/uploads/2026/03/logo.png"
         style="width:130px!important;height:auto!important;display:block!important;filter:drop-shadow(0 0 24px rgba(0,168,232,.55))!important;animation:nxPop .8s cubic-bezier(.34,1.56,.64,1) .2s both!important"
         alt="NANTIS">

    <div style="width:200px!important;height:2px!important;background:#00a8e8!important;border-radius:2px!important;animation:nxGrow .8s ease .7s both!important"></div>

    <span style="color:#f0f2f5!important;font-size:2.4rem!important;font-weight:300!important;letter-spacing:.25em!important;text-transform:uppercase!important;font-family:'Architects Daughter',sans-serif!important;animation:nxUp .7s ease 1s both!important">NANTIS</span>

    <span style="color:rgba(240,242,245,.6)!important;font-size:.85rem!important;letter-spacing:.18em!important;text-transform:uppercase!important;font-family:sans-serif!important;animation:nxUp .7s ease 1.3s both!important">Asset Management Inc.</span>

    <!-- Progress bar -->
    <div style="width:275px!important;margin-top:10px!important">
      <div style="width:100%!important;height:3px!important;background:rgba(0,168,232,.15)!important;border-radius:2px!important">
        <div id="nxi-bar" style="width:0%!important;height:3px!important;background:#00a8e8!important;border-radius:2px!important;transition:width .15s linear!important;box-shadow:0 0 8px rgba(0,168,232,.8)!important"></div>
      </div>
    </div>

    <span id="nxi-bar-pct" style="color:#00a8e8!important;font-size:.75rem!important;letter-spacing:.15em!important;font-family:sans-serif!important;display:block!important;margin-top:4px!important;text-align:center!important;transition:opacity .4s ease!important">0%</span>

    <span id="nxi-status" style="color:rgba(240,242,245,.35)!important;font-size:.69rem!important;letter-spacing:.2em!important;text-transform:uppercase!important;font-family:sans-serif!important;display:none!important;margin-top:2px!important;text-align:center!important;animation:nxGlow 1.5s ease-in-out infinite!important">Loading data...</span>

    <span style="color:rgba(240,242,245,.2)!important;font-size:.75rem!important;letter-spacing:.2em!important;text-transform:uppercase!important;font-family:sans-serif!important;display:block!important;margin-top:4px!important">EST. 2023 &nbsp;|&nbsp; Montr&eacute;al &nbsp;|&nbsp; Canada</span>

    <span id="nxi-weather" style="color:rgba(240,242,245,.6)!important;font-size:.75rem!important;letter-spacing:.2em!important;text-transform:uppercase!important;font-family:sans-serif!important;display:none!important;margin-top:2px!important"></span>

  </div>

  <!-- Footer: NAV bars + motto -->
  <div id="nxi-footer" style="width:100%!important;padding:28px 40px 36px!important;display:flex!important;flex-direction:column!important;align-items:center!important;gap:12px!important;border-top:1px solid rgba(0,168,232,.15)!important">
    <div style="width:100%!important;max-width:400px!important;margin-bottom:16px!important">
      <div style="color:rgba(240,242,245,.5)!important;font-size:.69rem!important;letter-spacing:.2em!important;text-transform:uppercase!important;font-family:sans-serif!important;text-align:center!important;margin-bottom:10px!important">2025 &nbsp;|&nbsp; Class A &amp; Class F NAV</div>

      <!-- Class A -->
      <div style="margin-bottom:8px!important">
        <div style="color:#00c9d4!important;font-size:.69rem!important;letter-spacing:.15em!important;text-transform:uppercase!important;font-family:sans-serif!important;margin-bottom:4px!important">Class A</div>
        <div style="width:100%!important;height:23px!important;background:rgba(255,255,255,.06)!important;border-radius:4px!important;position:relative!important;overflow:hidden!important">
          <div id="nxi-bar-a" style="height:100%!important;width:0%!important;background:linear-gradient(90deg,#006d75,#00c9d4)!important;border-radius:4px!important;transition:width 1.8s cubic-bezier(.22,1,.36,1)!important"></div>
          <div style="position:absolute!important;top:0!important;left:0!important;right:0!important;bottom:0!important;display:flex!important;align-items:center!important;justify-content:space-between!important;padding:0 8px!important">
            <span id="nxi-nav-a-dollar" style="font-size:.75rem!important;color:#fff!important;font-family:sans-serif!important;font-weight:700!important"></span>
            <span id="nxi-nav-a-pct" style="font-size:.75rem!important;color:#fff!important;font-family:sans-serif!important;font-weight:700!important"></span>
          </div>
        </div>
      </div>

      <!-- Class F -->
      <div>
        <div style="color:#00AEEF!important;font-size:.69rem!important;letter-spacing:.15em!important;text-transform:uppercase!important;font-family:sans-serif!important;margin-bottom:4px!important">Class F</div>
        <div style="width:100%!important;height:23px!important;background:rgba(255,255,255,.06)!important;border-radius:4px!important;position:relative!important;overflow:hidden!important">
          <div id="nxi-bar-f" style="height:100%!important;width:0%!important;background:linear-gradient(90deg,#0a4a7a,#00AEEF)!important;border-radius:4px!important;transition:width 1.8s cubic-bezier(.22,1,.36,1)!important"></div>
          <div style="position:absolute!important;top:0!important;left:0!important;right:0!important;bottom:0!important;display:flex!important;align-items:center!important;justify-content:space-between!important;padding:0 8px!important">
            <span id="nxi-nav-f-dollar" style="font-size:.75rem!important;color:#fff!important;font-family:sans-serif!important;font-weight:700!important"></span>
            <span id="nxi-nav-f-pct" style="font-size:.75rem!important;color:#fff!important;font-family:sans-serif!important;font-weight:700!important"></span>
          </div>
        </div>
      </div>
    </div>

    <span id="nxi-motto" style="color:#00a8e8!important;font-size:1.5rem!important;letter-spacing:.12em!important;text-transform:uppercase!important;text-align:center!important;font-family:'Architects Daughter',sans-serif!important;display:block!important;animation:nxGlow 2.5s ease-in-out 2s infinite!important;transition:font-size 1s ease,letter-spacing 1s ease!important">THINK OUTSIDE THE BOX<sup style="font-size:.4em!important;vertical-align:super!important;letter-spacing:0!important">&trade;</sup></span>
  </div>
</div>

<style>
@keyframes nxPop{0%{opacity:0;transform:scale(.3) translateY(30px)}100%{opacity:1;transform:scale(1) translateY(0)}}
@keyframes nxUp{0%{opacity:0;transform:translateY(20px)}100%{opacity:1;transform:translateY(0)}}
@keyframes nxGrow{0%{width:0}100%{width:200px}}
@keyframes nxGlow{0%,100%{color:#00a8e8;text-shadow:0 0 10px rgba(0,168,232,.3)}50%{color:#33bcf5;text-shadow:0 0 30px rgba(0,168,232,.8)}}
</style>

<script>
(function(){
  "use strict";

  /* ── Helpers ─────────────────────────────────────── */

  function $(id){ return document.getElementById(id); }

  function getCookie(n){
    var m = document.cookie.match(new RegExp('(?:^|; )' + n + '=([^;]*)'));
    return m ? m[1] : null;
  }

  function setCookie(n, v, ms){
    document.cookie = n + '=' + v + '; path=/; expires=' +
      new Date(Date.now() + ms).toUTCString() + '; SameSite=Lax';
  }

  /** Fetch with a timeout (AbortController where supported, else race). */
  function fetchWithTimeout(url, ms){
    if (typeof AbortController !== 'undefined') {
      var ctrl = new AbortController();
      var tid  = setTimeout(function(){ ctrl.abort(); }, ms);
      return fetch(url, { signal: ctrl.signal })
        .finally(function(){ clearTimeout(tid); });
    }
    // Fallback: race against a rejection timer
    return Promise.race([
      fetch(url),
      new Promise(function(_, rej){
        setTimeout(function(){ rej(new Error('timeout')); }, ms);
      })
    ]);
  }

  /* ── Early bail-out ──────────────────────────────── */

  var overlay = $('nxi');
  if (!overlay) return;

  if (getCookie('nx_intro')) {
    overlay.parentNode.removeChild(overlay);
    return;
  }

  // Set cookie (30 min)
  setCookie('nx_intro', '1', 1800000);

  // Lock body scroll while overlay is visible
  document.body.style.overflow   = 'hidden';
  document.documentElement.style.overflow = 'hidden';

  /* ── DOM refs ────────────────────────────────────── */

  var inner     = $('nxi-inner');
  var footer    = $('nxi-footer');
  var bar       = $('nxi-bar');
  var pctEl     = $('nxi-bar-pct');
  var statusTxt = $('nxi-status');
  var motto     = $('nxi-motto');

  /* ── Progress tracker ────────────────────────────── */
  // Real progress: bar tracks actual data loading, not a fake timer.
  // Steps: bar-anim(30%) → NAV-fetched(70%) → weather-fetched(90%) → done(100%)

  var progress    = 0;
  var barInterval = null;

  function setProgress(target){
    if (target <= progress) return;
    progress = Math.min(target, 100);
    if (bar)   bar.style.width   = Math.round(progress) + '%';
    if (pctEl) pctEl.textContent = Math.round(progress) + '%';
    if (progress >= 100) {
      if (statusTxt) statusTxt.style.display = 'none';
      if (pctEl)     pctEl.style.opacity     = '0';
    }
  }

  /** Smoothly animate progress from current to target over durationMs. */
  function animateProgress(target, durationMs){
    var startVal  = progress;
    var startTime = Date.now();
    if (barInterval) clearInterval(barInterval);
    barInterval = setInterval(function(){
      var elapsed = Date.now() - startTime;
      var pct     = Math.min(elapsed / durationMs, 1);
      var val     = startVal + (target - startVal) * pct;
      setProgress(val);
      if (pct >= 1) clearInterval(barInterval);
    }, 30);
  }

  /* ── Exit sequence ───────────────────────────────── */

  var exitDone = false;

  function removeOverlay(){
    overlay.style.transition = 'opacity 1.2s ease';
    overlay.style.opacity    = '0';
    setTimeout(function(){
      if (overlay.parentNode) overlay.parentNode.removeChild(overlay);
      document.body.style.overflow   = '';
      document.documentElement.style.overflow = '';
    }, 1300);
  }

  function doExit(){
    if (exitDone) return;
    exitDone = true;
    if (barInterval) clearInterval(barInterval);
    setProgress(100);

    inner.style.transition = 'opacity .6s ease';
    inner.style.opacity    = '0';
    footer.style.borderTop = 'none';

    setTimeout(function(){
      inner.style.display       = 'none';
      motto.style.fontSize      = '2.8rem';
      motto.style.letterSpacing = '.25em';
      setTimeout(removeOverlay, 2500);
    }, 650);
  }

  /* ── Data fetchers ───────────────────────────────── */

  var navDone     = false;
  var weatherDone = false;

  function checkAllDone(){
    if (navDone && weatherDone) {
      setProgress(100);
      // Give user time to see the final data before exiting
      setTimeout(doExit, 2200);
    }
  }

  function fetchNAV(){
    var SHEET_URL = 'https://docs.google.com/spreadsheets/d/e/' +
      '2PACX-1vQT6dFLvqEDKW6UBHoMsr237H3mFu1WjmfKDOCJT1KGf2AQV3eU3jMFQQta_J8qGE9KCAadjIEZXoms' +
      '/pub?output=csv';

    function parseNum(s){ return s ? parseFloat(s.replace(/[$,%\s]/g, '')) : NaN; }
    function fmt(n){
      return '$' + n.toLocaleString('en-CA', {
        minimumFractionDigits: 2, maximumFractionDigits: 2
      });
    }

    function animNAVBar(fillId, dollarId, pctId, dollarVal, pctVal, delay){
      setTimeout(function(){
        var fill = $(fillId);
        var dEl  = $(dollarId);
        var pEl  = $(pctId);
        if (!fill || !dEl || !pEl) return;
        fill.style.width = Math.min(pctVal, 100) + '%';
        var start = null;
        function step(ts){
          if (!start) start = ts;
          var p = Math.min((ts - start) / 1800, 1);
          var v = 1 - Math.pow(1 - p, 3);          // ease-out cubic
          dEl.textContent = fmt(dollarVal * v);
          pEl.textContent = (pctVal * v).toFixed(2) + '%';
          if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
      }, delay);
    }

    fetchWithTimeout(
      'https://api.codetabs.com/v1/proxy?quest=' + encodeURIComponent(SHEET_URL),
      8000
    )
    .then(function(r){
      if (!r.ok) throw new Error('HTTP ' + r.status);
      return r.text();
    })
    .then(function(text){
      var lines = text.trim().split('\n');
      if (lines.length < 2) throw new Error('No data rows');
      var vals   = lines[1].split(',');
      var raised = parseNum(vals[0]);
      var net    = parseNum(vals[1]);
      if (isNaN(raised) || isNaN(net) || net === 0) throw new Error('Bad NAV data');

      var classF = (net / raised) * 100;
      var classA = classF * 0.9475;

      animNAVBar('nxi-bar-a', 'nxi-nav-a-dollar', 'nxi-nav-a-pct', classA, classA, 300);
      animNAVBar('nxi-bar-f', 'nxi-nav-f-dollar', 'nxi-nav-f-pct', classF, classF, 600);

      setProgress(70);
      navDone = true;
      checkAllDone();
    })
    .catch(function(){
      // NAV fetch failed — mark done so we still exit gracefully
      navDone = true;
      setProgress(70);
      checkAllDone();
    });
  }

  function fetchWeather(){
    fetchWithTimeout('https://ipapi.co/json/', 5000)
    .then(function(r){
      if (!r.ok) throw new Error('HTTP ' + r.status);
      return r.json();
    })
    .then(function(d){
      var city = d.city || '';
      var lat  = d.latitude;
      var lon  = d.longitude;
      if (!city || lat == null) throw new Error('No location');

      return fetchWithTimeout(
        'https://api.open-meteo.com/v1/forecast?latitude=' + lat +
        '&longitude=' + lon + '&current_weather=true',
        5000
      )
      .then(function(r){
        if (!r.ok) throw new Error('HTTP ' + r.status);
        return r.json();
      })
      .then(function(wd){
        var temp = Math.round(wd.current_weather.temperature);
        var el   = $('nxi-weather');
        if (el) {
          el.textContent  = city + '  |  ' + temp + '\u00B0C';
          el.style.display = 'block';
        }
      });
    })
    .catch(function(){
      // Weather is non-critical — silently continue
    })
    .finally(function(){
      weatherDone = true;
      setProgress(90);
      checkAllDone();
    });
  }

  /* ── Start sequence ──────────────────────────────── */

  var started = false;

  function startEverything(){
    if (started) return;
    started = true;

    if (statusTxt) statusTxt.style.display = 'block';

    // Animate bar to 30% over 1.5s (visual feedback while fetching)
    animateProgress(30, 1500);

    fetchNAV();
    fetchWeather();

    // Hard deadline: if data hasn't loaded in 15s, exit anyway
    setTimeout(function(){
      if (!exitDone) doExit();
    }, 15000);
  }

  /* ── Auto-start on all devices ─────────────────────
   * Mobile browsers (especially iOS Safari) can throttle
   * setTimeout and defer fetch() until user interaction.
   * We use multiple triggers to guarantee startup:
   *   1. setTimeout (works on desktop, most Android)
   *   2. requestAnimationFrame chain (more reliable on mobile)
   *   3. Touch/click on overlay as fallback
   *   4. visibilitychange as final safety net
   * startEverything() is idempotent — only runs once.
   * ─────────────────────────────────────────────────── */

  // Primary: timer after intro animations
  setTimeout(startEverything, 1800);

  // Secondary: rAF chain — fires even when setTimeout is throttled
  var rafCount = 0;
  function rafStart(){
    rafCount++;
    // ~1.8s worth of frames (roughly 108 frames at 60fps)
    if (rafCount >= 108) {
      startEverything();
    } else if (!started) {
      requestAnimationFrame(rafStart);
    }
  }
  requestAnimationFrame(rafStart);

  // Tertiary: any touch/click on the overlay kicks it off immediately
  overlay.addEventListener('touchstart', function(){ startEverything(); }, { passive: true });
  overlay.addEventListener('click', function(){ startEverything(); });

  // Safety net: if page becomes visible and we still haven't started
  document.addEventListener('visibilitychange', function(){
    if (document.visibilityState === 'visible' && !started) {
      startEverything();
    }
  });

  /* ── BFCache: clean up on back-navigation ────────── */

  window.addEventListener('pageshow', function(e){
    if (e.persisted) {
      var el = $('nxi');
      if (el && el.parentNode) el.parentNode.removeChild(el);
      document.body.style.overflow   = '';
      document.documentElement.style.overflow = '';
    }
  });

})();
</script>
    <?php
}
?>
