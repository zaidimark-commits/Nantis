<?php
/**
 * Plugin Name: NANTIS Intro Animation
 * Description: Full-screen intro overlay for the NANTIS homepage. Works on all devices.
 * Version: 7.0
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

    /* Already seen the intro — skip */
    if ( ! empty( $_COOKIE['nx_intro'] ) ) {
        return;
    }

    /* Only on root "/" — not /fr/ or other language paths */
    $path = trim( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ), '/' );
    if ( $path !== '' ) {
        return;
    }
    ?>
<!-- NANTIS Intro v7.0 -->
<div id="nxi" style="position:fixed;top:0;left:0;width:100%;height:100%;z-index:9999999;background:#000;display:flex;flex-direction:column;align-items:center;justify-content:center;opacity:1;box-sizing:border-box;overflow:hidden">

  <!-- Main content -->
  <div id="nxi-main" style="display:flex;flex-direction:column;align-items:center;justify-content:center;flex:1;width:100%;gap:14px;padding:30px 20px 16px;opacity:1">

    <!-- Logo (place logo.png in the plugin folder) -->
    <img id="nxi-logo" src="<?php echo esc_url( plugins_url( 'logo.png', __FILE__ ) ); ?>" alt="NANTIS" style="width:120px;height:auto;opacity:0;transform:scale(.4) translateY(20px);filter:drop-shadow(0 0 20px rgba(0,168,232,.5))">

    <!-- Accent line -->
    <div id="nxi-line" style="width:0;height:2px;background:#00a8e8;border-radius:2px"></div>

    <!-- Company name -->
    <span id="nxi-name" style="color:#f0f2f5;font-size:2rem;font-weight:300;letter-spacing:.25em;text-transform:uppercase;font-family:'Architects Daughter',sans-serif;opacity:0;transform:translateY(14px)">NANTIS</span>

    <!-- Subtitle -->
    <span id="nxi-sub" style="color:rgba(240,242,245,.6);font-size:.8rem;letter-spacing:.18em;text-transform:uppercase;font-family:sans-serif;opacity:0;transform:translateY(14px)">Asset Management Inc.</span>

    <!-- Progress bar -->
    <div style="width:200px;margin-top:6px">
      <div style="width:100%;height:2px;background:rgba(0,168,232,.15);border-radius:2px">
        <div id="nxi-bar" style="width:0%;height:2px;background:#00a8e8;border-radius:2px;box-shadow:0 0 8px rgba(0,168,232,.8)"></div>
      </div>
    </div>
    <span id="nxi-pct" style="color:#00a8e8;font-size:.6rem;letter-spacing:.15em;font-family:sans-serif">0%</span>

    <!-- Loading text -->
    <span id="nxi-load" style="color:rgba(240,242,245,.35);font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;opacity:0">Loading data...</span>

    <!-- Location -->
    <span style="color:rgba(240,242,245,.2);font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;margin-top:2px">EST. 2023 &nbsp;|&nbsp; Montr&eacute;al &nbsp;|&nbsp; Canada</span>

    <!-- Weather -->
    <span id="nxi-weather" style="color:rgba(240,242,245,.6);font-size:.6rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;opacity:0"></span>
  </div>

  <!-- Footer: NAV bars + motto -->
  <div id="nxi-footer" style="width:100%;padding:20px 28px 28px;display:flex;flex-direction:column;align-items:center;gap:10px;border-top:1px solid rgba(0,168,232,.15)">

    <div style="width:100%;max-width:320px;margin-bottom:10px">
      <div style="color:rgba(240,242,245,.5);font-size:.55rem;letter-spacing:.2em;text-transform:uppercase;font-family:sans-serif;text-align:center;margin-bottom:10px">2025 &nbsp;|&nbsp; Class A &amp; Class F NAV</div>

      <!-- Class A bar -->
      <div style="margin-bottom:8px">
        <div style="color:#00c9d4;font-size:.55rem;letter-spacing:.15em;text-transform:uppercase;font-family:sans-serif;margin-bottom:4px">Class A</div>
        <div style="width:100%;height:18px;background:rgba(255,255,255,.06);border-radius:4px;position:relative;overflow:hidden">
          <div id="nxi-fill-a" style="height:100%;width:0%;background:linear-gradient(90deg,#006d75,#00c9d4);border-radius:4px"></div>
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
          <div id="nxi-fill-f" style="height:100%;width:0%;background:linear-gradient(90deg,#0a4a7a,#00AEEF);border-radius:4px"></div>
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
@keyframes nxiGlow{0%,100%{color:#00a8e8;text-shadow:0 0 10px rgba(0,168,232,.3)}50%{color:#33bcf5;text-shadow:0 0 30px rgba(0,168,232,.8)}}
@keyframes nxiPulse{0%,100%{opacity:.35}50%{opacity:.7}}
</style>

<script>
(function(){
  var O=document.getElementById('nxi');
  if(!O)return;

  /* ── Cookie: don't show again for 30 min ─────────── */
  document.cookie='nx_intro=1;path=/;max-age=1800;SameSite=Lax';

  /* ── Refs ─────────────────────────────────────────── */
  var M=document.getElementById('nxi-main'),
      F=document.getElementById('nxi-footer'),
      logo=document.getElementById('nxi-logo'),
      line=document.getElementById('nxi-line'),
      nm=document.getElementById('nxi-name'),
      sub=document.getElementById('nxi-sub'),
      bar=document.getElementById('nxi-bar'),
      pct=document.getElementById('nxi-pct'),
      ld=document.getElementById('nxi-load'),
      motto=document.getElementById('nxi-motto');

  /* ── Utility: apply CSS transition then set props ── */
  function anim(el,tr,props,ms){
    setTimeout(function(){
      el.style.transition=tr;
      for(var k in props)el.style[k]=props[k];
    },ms);
  }

  /* ── Entrance sequence (all setTimeout, no rAF) ──── */
  anim(logo,'.7s cubic-bezier(.34,1.56,.64,1)',{opacity:'1',transform:'scale(1) translateY(0)'},200);
  anim(line,'.7s ease',{width:'200px'},700);
  anim(nm,'.6s ease',{opacity:'1',transform:'translateY(0)'},1000);
  anim(sub,'.6s ease',{opacity:'1',transform:'translateY(0)'},1300);

  /* ── Progress bar via setInterval (immune to rAF throttling) ── */
  var prog=0,barDur=3000,tick=50;
  var bTimer=setInterval(function(){
    prog+=tick/barDur*100;
    if(prog>=100){
      prog=100;
      clearInterval(bTimer);
      pct.style.transition='opacity .4s';
      pct.style.opacity='0';
      ld.style.transition='opacity .5s';
      ld.style.opacity='1';
      ld.style.animation='nxiPulse 1.5s ease-in-out infinite';
    }
    bar.style.width=Math.round(prog)+'%';
    pct.textContent=Math.round(prog)+'%';
  },tick);

  /* ── Motto glow ──────────────────────────────────── */
  setTimeout(function(){motto.style.animation='nxiGlow 2.5s ease-in-out infinite';},2000);

  /* ── Exit logic ──────────────────────────────────── */
  var done=false;
  function exit(){
    if(done)return;
    done=true;
    clearInterval(bTimer);

    /* Phase 1: fade out main content */
    M.style.transition='opacity .6s ease';
    M.style.opacity='0';
    F.style.borderTop='none';

    /* Phase 2: enlarge motto */
    setTimeout(function(){
      M.style.display='none';
      motto.style.transition='font-size .8s ease,letter-spacing .8s ease';
      motto.style.fontSize='2.8rem';
      motto.style.letterSpacing='.25em';

      /* Phase 3: fade out overlay */
      setTimeout(function(){
        O.style.transition='opacity 1s ease';
        O.style.opacity='0';
        setTimeout(function(){
          if(O.parentNode)O.parentNode.removeChild(O);
        },1100);
      },2500);
    },650);
  }

  /*
   * HARD TIMEOUT — overlay closes after 12 s no matter what.
   * Uses BOTH setTimeout and a Date.now() polling fallback.
   * This solves the mobile "stuck unless touched" issue:
   * some mobile browsers heavily throttle setTimeout in
   * certain states, so we also poll every 500 ms.
   */
  var deadline=Date.now()+12000;

  setTimeout(exit,12000);

  var guardian=setInterval(function(){
    if(Date.now()>=deadline){
      clearInterval(guardian);
      exit();
    }
  },500);

  /* Also allow tap/click to skip immediately (nice for mobile UX) */
  O.addEventListener('click',function(){exit();});
  O.addEventListener('touchend',function(){exit();});

  /* Handle visibility changes — if user switches away and comes back,
     check if deadline has passed */
  document.addEventListener('visibilitychange',function(){
    if(!document.hidden && Date.now()>=deadline){
      exit();
    }
  });

  /* Handle bfcache (back/forward) */
  window.addEventListener('pageshow',function(e){
    if(e.persisted&&O.parentNode){
      O.style.transition='opacity .5s';
      O.style.opacity='0';
      setTimeout(function(){if(O.parentNode)O.parentNode.removeChild(O);},600);
    }
  });

  /* ── NAV data fetch ──────────────────────────────── */
  var CSV='https://docs.google.com/spreadsheets/d/e/2PACX-1vQT6dFLvqEDKW6UBHoMsr237H3mFu1WjmfKDOCJT1KGf2AQV3eU3jMFQQta_J8qGE9KCAadjIEZXoms/pub?output=csv';

  function pn(s){return s?parseFloat(s.replace(/[$,%\s]/g,'')):NaN;}
  function fm(n){return '$'+n.toLocaleString('en-CA',{minimumFractionDigits:2,maximumFractionDigits:2});}

  function navBar(fId,dId,pId,dv,pv,delay){
    setTimeout(function(){
      var fl=document.getElementById(fId),
          de=document.getElementById(dId),
          pe=document.getElementById(pId);
      if(!fl||!de||!pe)return;
      fl.style.transition='width 1.8s cubic-bezier(.22,1,.36,1)';
      fl.style.width=Math.min(pv,100)+'%';
      var el=0,dur=1800,t=30;
      var c=setInterval(function(){
        el+=t;
        var p=Math.min(el/dur,1),v=1-Math.pow(1-p,3);
        de.textContent=fm(dv*v);
        pe.textContent=(pv*v).toFixed(2)+'%';
        if(p>=1)clearInterval(c);
      },t);
    },delay);
  }

  /* Fetch with a 6-second timeout to prevent hanging on mobile */
  var ctrl=typeof AbortController!=='undefined'?new AbortController():null;
  var fetchOpts=ctrl?{signal:ctrl.signal}:{};
  var fetchTimeout=setTimeout(function(){if(ctrl)ctrl.abort();},6000);

  fetch('https://api.codetabs.com/v1/proxy?quest='+encodeURIComponent(CSV),fetchOpts)
    .then(function(r){return r.text();})
    .then(function(t){
      clearTimeout(fetchTimeout);
      var lines=t.trim().split('\n');
      if(lines.length<2)return;
      var v=lines[1].split(',');
      var raised=pn(v[0]),net=pn(v[1]);
      if(isNaN(raised)||isNaN(net)||net===0)return;
      var cF=(net/raised)*100,cA=cF*0.9475;
      navBar('nxi-fill-a','nxi-val-a','nxi-pval-a',cA,cA,300);
      navBar('nxi-fill-f','nxi-val-f','nxi-pval-f',cF,cF,600);
      /* After data animation, trigger exit (unless hard timeout already did) */
      setTimeout(exit,5300);
    })
    .catch(function(){clearTimeout(fetchTimeout);});

  /* ── Weather (best-effort, non-blocking) ─────────── */
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
            el.style.transition='opacity .5s';
            el.style.opacity='1';
          }
        });
    })
    .catch(function(){});

})();
</script>
<?php
}
