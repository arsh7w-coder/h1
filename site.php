<?php
/* ------------------------------------------------------------------
   ATELIER NOIR — a small editorial page about women's fashion
   and modelling. All names, quotes and brands below are fictional.
   ------------------------------------------------------------------ */

$hour = (int) date('G');
$greeting = $hour < 12 ? 'Good Morning' : ($hour < 18 ? 'Good Afternoon' : 'Good Evening');
$today = date('l, j F Y');
$year = date('Y');

$stats = [
    ['value' => '12',  'label' => 'Seasonal Collections'],
    ['value' => '40+', 'label' => 'Muses Featured'],
    ['value' => '06',  'label' => 'Global Ateliers'],
];

$trends = [
    ['num' => '01', 'title' => 'Sculpted Tailoring',   'desc' => 'Sharp shoulders and cinched waists, built from structured wool and gabardine, softened only by a single curved seam.'],
    ['num' => '02', 'title' => 'Fluid Silk Draping',    'desc' => 'Bias-cut silk that moves before the body does — liquid hemlines and cowl necks in place of hard edges.'],
    ['num' => '03', 'title' => 'Modern Monochrome',     'desc' => 'One color, head to hem. Tonal layering replaces print, letting fabric and cut carry the whole look.'],
    ['num' => '04', 'title' => 'Textural Knitwear',     'desc' => 'Hand-loomed cables and boucle in place of prints — a season that prefers touch over pattern.'],
];

$models = [
    ['name' => 'Elena Marchetti', 'role' => 'Editorial Muse',    'quote' => 'A great look should photograph the same as it feels — unhurried.'],
    ['name' => 'Amara Okafor',    'role' => 'Runway Lead',       'quote' => 'The walk is punctuation. The clothes are the sentence.'],
    ['name' => 'Sofia Lindqvist', 'role' => 'Print Campaign',    'quote' => 'Stillness is a skill. The camera finds it before it finds anything else.'],
    ['name' => 'Noor Aziz',       'role' => 'Atelier Fit Model', 'quote' => 'A garment tells you where it is wrong long before a mirror does.'],
];

$looks = [
    ['title' => 'The Ivory Column',   'tag' => 'Evening'],
    ['title' => 'Structured Noir',    'tag' => 'Tailoring'],
    ['title' => 'Blush Draped Slip',  'tag' => 'Daywear'],
    ['title' => 'Brass Trench',       'tag' => 'Outerwear'],
    ['title' => 'Wine Velvet Gown',   'tag' => 'Evening'],
    ['title' => 'Ecru Knit Set',      'tag' => 'Studio'],
];

/* Newsletter handling */
$subscribed = false;
$form_error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $subscribed = true;
    } else {
        $form_error = 'That doesn\'t look like a valid email address — try again.';
    }
}

function croquis($id) {
    return '<svg class="croquis" viewBox="0 0 100 170" aria-hidden="true">
        <path d="M50,6 C45,6 44,11 49,13" />
        <line x1="22" y1="13" x2="78" y2="13" />
        <path d="M38,13 L62,13 L55,38
                 C61,52 67,58 76,78
                 C84,106 87,126 84,150
                 L16,150
                 C13,126 16,106 24,78
                 C33,58 39,52 45,38 Z" />
    </svg>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Atelier Noir — Fashion &amp; Modelling Journal</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,600;1,500&family=Work+Sans:wght@300;400;500&family=Jost:wght@400;500&display=swap" rel="stylesheet">
<style>
  :root{
    --ink:#17140f;
    --ink-soft:#242017;
    --bone:#f4efe3;
    --bone-line:#e2dac8;
    --brass:#b98b4e;
    --wine:#7a2e3a;
    --stone:#a49d8c;
    --stone-dark:#6b6558;

    --font-display:'Playfair Display', serif;
    --font-body:'Work Sans', sans-serif;
    --font-eyebrow:'Jost', sans-serif;
  }

  *{box-sizing:border-box;}
  html{scroll-behavior:smooth;}
  body{
    margin:0;
    background:var(--bone);
    color:var(--ink);
    font-family:var(--font-body);
    font-weight:300;
    line-height:1.6;
  }
  img,svg{display:block;max-width:100%;}
  a{color:inherit;}
  .wrap{max-width:1120px;margin:0 auto;padding:0 32px;}

  .eyebrow{
    font-family:var(--font-eyebrow);
    text-transform:uppercase;
    letter-spacing:.22em;
    font-size:.72rem;
    color:var(--brass);
  }

  /* croquis line-art motif, reused as the page's signature element */
  .croquis{width:64px;height:auto;}
  .croquis path,.croquis line{
    fill:none;
    stroke:currentColor;
    stroke-width:1.4;
    stroke-linecap:round;
    stroke-linejoin:round;
  }

  /* ---------- masthead ---------- */
  .masthead{
    background:var(--ink);
    color:var(--bone);
    padding:18px 0 0;
  }
  .masthead .wrap{
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
  }
  .masthead .date-line{
    color:var(--stone);
    margin-bottom:14px;
  }
  .wordmark{
    font-family:var(--font-display);
    font-size:clamp(2.2rem,5vw,3.4rem);
    letter-spacing:.06em;
    margin:0 0 18px;
  }
  .wordmark em{color:var(--brass);font-style:normal;}
  nav.primary{
    display:flex;
    flex-wrap:wrap;
    justify-content:center;
    gap:28px;
    border-top:1px solid rgba(244,239,227,.14);
    padding:16px 0;
    width:100%;
    font-family:var(--font-eyebrow);
    text-transform:uppercase;
    letter-spacing:.14em;
    font-size:.78rem;
  }
  nav.primary a{text-decoration:none;color:var(--stone);transition:color .2s ease;}
  nav.primary a:hover,nav.primary a:focus-visible{color:var(--bone);}

  /* ---------- hero ---------- */
  .hero{
    background:var(--ink);
    color:var(--bone);
    padding:64px 0 88px;
  }
  .hero .wrap{
    display:grid;
    grid-template-columns:1.3fr .7fr;
    gap:48px;
    align-items:center;
  }
  .hero h1{
    font-family:var(--font-display);
    font-weight:500;
    font-size:clamp(2.4rem,5vw,4rem);
    line-height:1.08;
    margin:14px 0 22px;
  }
  .hero h1 span{display:block;font-style:italic;color:var(--brass);font-weight:500;}
  .hero p{
    color:var(--stone);
    max-width:46ch;
    font-size:1.05rem;
    margin-bottom:30px;
  }
  .btn{
    display:inline-block;
    font-family:var(--font-eyebrow);
    text-transform:uppercase;
    letter-spacing:.14em;
    font-size:.78rem;
    text-decoration:none;
    padding:14px 28px;
    border:1px solid var(--brass);
    color:var(--bone);
    transition:background .2s ease,color .2s ease;
  }
  .btn:hover,.btn:focus-visible{background:var(--brass);color:var(--ink);}
  .hero-figure{
    justify-self:center;
    color:var(--brass);
    opacity:.9;
  }
  .hero-figure .croquis{width:180px;}

  .stat-row{
    display:flex;
    gap:44px;
    margin-top:52px;
    padding-top:32px;
    border-top:1px solid rgba(244,239,227,.14);
    flex-wrap:wrap;
  }
  .stat-row .stat-value{
    font-family:var(--font-display);
    font-size:1.9rem;
    color:var(--bone);
  }
  .stat-row .stat-label{
    color:var(--stone);
    font-size:.82rem;
    margin-top:4px;
  }

  /* ---------- section heading pattern ---------- */
  .section{padding:88px 0;}
  .section-head{
    max-width:640px;
    margin-bottom:52px;
  }
  .section-head h2{
    font-family:var(--font-display);
    font-weight:500;
    font-size:clamp(1.8rem,3.4vw,2.6rem);
    margin:10px 0 0;
  }
  .on-dark .section-head h2{color:var(--bone);}
  .on-dark .section-head .eyebrow{color:var(--brass);}

  /* ---------- trends ---------- */
  .trend-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:1px;
    background:var(--bone-line);
    border:1px solid var(--bone-line);
  }
  .trend-card{
    background:var(--bone);
    padding:36px;
  }
  .trend-card .num{
    font-family:var(--font-display);
    font-style:italic;
    color:var(--brass);
    font-size:1.1rem;
  }
  .trend-card h3{
    font-family:var(--font-display);
    font-weight:600;
    font-size:1.35rem;
    margin:10px 0 12px;
  }
  .trend-card p{color:var(--stone-dark);margin:0;}

  /* ---------- pull quote ---------- */
  .pullquote{
    background:var(--ink);
    color:var(--bone);
    text-align:center;
    padding:96px 0;
  }
  .pullquote blockquote{
    font-family:var(--font-display);
    font-style:italic;
    font-size:clamp(1.5rem,3.4vw,2.3rem);
    max-width:760px;
    margin:0 auto;
    line-height:1.4;
  }
  .pullquote cite{
    display:block;
    margin-top:24px;
    font-style:normal;
    font-family:var(--font-eyebrow);
    letter-spacing:.14em;
    text-transform:uppercase;
    font-size:.75rem;
    color:var(--brass);
  }

  /* ---------- models ---------- */
  .model-row{
    display:grid;
    grid-template-columns:80px 1fr;
    gap:28px;
    align-items:start;
    padding:32px 0;
    border-top:1px solid var(--bone-line);
  }
  .model-row:last-child{border-bottom:1px solid var(--bone-line);}
  .model-row .croquis{color:var(--brass);}
  .model-row.reverse{grid-template-columns:1fr 80px;}
  .model-row.reverse .croquis-wrap{order:2;}
  .model-row h3{
    font-family:var(--font-display);
    font-weight:600;
    font-size:1.4rem;
    margin:0 0 4px;
  }
  .model-row .role{
    font-family:var(--font-eyebrow);
    text-transform:uppercase;
    letter-spacing:.12em;
    font-size:.74rem;
    color:var(--brass);
    margin-bottom:10px;
    display:block;
  }
  .model-row p.quote{
    font-style:italic;
    color:var(--stone-dark);
    margin:0;
    max-width:52ch;
  }

  /* ---------- lookbook ---------- */
  .lookbook{background:var(--ink);color:var(--bone);}
  .look-grid{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:20px;
  }
  .look-card{
    border:1px solid rgba(244,239,227,.16);
    padding:28px 20px 24px;
    text-align:center;
    transition:border-color .2s ease;
  }
  .look-card:hover{border-color:var(--brass);}
  .look-card .croquis{margin:0 auto 18px;color:var(--brass);width:52px;}
  .look-card .tag{
    font-family:var(--font-eyebrow);
    text-transform:uppercase;
    letter-spacing:.12em;
    font-size:.68rem;
    color:var(--stone);
    display:block;
    margin-bottom:8px;
  }
  .look-card h4{
    font-family:var(--font-display);
    font-weight:500;
    font-size:1.05rem;
    margin:0;
  }

  /* ---------- newsletter ---------- */
  .newsletter .wrap{
    max-width:560px;
    text-align:center;
  }
  .newsletter form{
    display:flex;
    gap:10px;
    margin-top:28px;
    flex-wrap:wrap;
    justify-content:center;
  }
  .newsletter input[type=email]{
    flex:1 1 260px;
    padding:14px 16px;
    border:1px solid var(--stone);
    background:transparent;
    font-family:var(--font-body);
    font-size:.95rem;
    color:var(--ink);
  }
  .newsletter input[type=email]:focus-visible{outline:2px solid var(--brass);outline-offset:2px;}
  .newsletter button{
    font-family:var(--font-eyebrow);
    text-transform:uppercase;
    letter-spacing:.14em;
    font-size:.78rem;
    padding:14px 26px;
    background:var(--ink);
    color:var(--bone);
    border:1px solid var(--ink);
    cursor:pointer;
  }
  .newsletter button:hover,.newsletter button:focus-visible{background:var(--wine);border-color:var(--wine);}
  .form-note{margin-top:14px;font-size:.85rem;color:var(--stone-dark);}
  .form-note.success{color:var(--wine);}

  /* ---------- footer ---------- */
  footer{
    background:var(--ink);
    color:var(--stone);
    padding:40px 0;
  }
  footer .wrap{
    display:flex;
    justify-content:space-between;
    align-items:center;
    flex-wrap:wrap;
    gap:16px;
    font-size:.85rem;
  }
  footer nav{display:flex;gap:22px;flex-wrap:wrap;}
  footer a{text-decoration:none;color:var(--stone);}
  footer a:hover,footer a:focus-visible{color:var(--bone);}

  a:focus-visible,button:focus-visible{outline:2px solid var(--brass);outline-offset:3px;}

  @media (max-width:840px){
    .hero .wrap{grid-template-columns:1fr;}
    .hero-figure{display:none;}
    .trend-grid{grid-template-columns:1fr;}
    .look-grid{grid-template-columns:repeat(2,1fr);}
    .model-row,.model-row.reverse{grid-template-columns:56px 1fr;}
    .model-row.reverse .croquis-wrap{order:0;}
  }
  @media (max-width:520px){
    .look-grid{grid-template-columns:1fr;}
    footer .wrap{flex-direction:column;text-align:center;}
  }
  @media (prefers-reduced-motion:reduce){html{scroll-behavior:auto;}*{transition:none !important;}}
</style>
</head>
<body>

<header class="masthead">
  <div class="wrap">
    <p class="date-line eyebrow"><?= htmlspecialchars($greeting) ?> · <?= htmlspecialchars($today) ?></p>
    <p class="wordmark">ATELIER <em>NOIR</em></p>
    <nav class="primary">
      <a href="#trends">Collections</a>
      <a href="#models">Muses</a>
      <a href="#lookbook">Lookbook</a>
      <a href="#newsletter">Journal</a>
    </nav>
  </div>
</header>

<section class="hero">
  <div class="wrap">
    <div>
      <p class="eyebrow">A Small Journal Of Fashion &amp; Modelling</p>
      <h1>Clothing is a sentence.<span>The right model is punctuation.</span></h1>
      <p>Notes from the fitting room and the runway — on cut, movement, and the women who carry a
         collection from sketch to street. Updated each season, written in-house.</p>
      <a class="btn" href="#lookbook">View This Season's Looks</a>
    </div>
    <div class="hero-figure"><?= croquis('hero') ?></div>
  </div>
  <div class="wrap">
    <div class="stat-row">
      <?php foreach ($stats as $s): ?>
        <div>
          <div class="stat-value"><?= htmlspecialchars($s['value']) ?></div>
          <div class="stat-label"><?= htmlspecialchars($s['label']) ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="trends" class="section">
  <div class="wrap">
    <div class="section-head">
      <p class="eyebrow">Current Season</p>
      <h2>Defining this season's silhouette</h2>
    </div>
    <div class="trend-grid">
      <?php foreach ($trends as $t): ?>
        <div class="trend-card">
          <div class="num"><?= htmlspecialchars($t['num']) ?></div>
          <h3><?= htmlspecialchars($t['title']) ?></h3>
          <p><?= htmlspecialchars($t['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="pullquote">
  <div class="wrap">
    <blockquote>
      "A collection is only finished the moment it moves — on a body, down a runway, out a door."
      <cite>— House Notes, Atelier Noir</cite>
    </blockquote>
  </div>
</section>

<section id="models" class="section">
  <div class="wrap">
    <div class="section-head">
      <p class="eyebrow">Muses</p>
      <h2>Faces of the season</h2>
    </div>
    <?php foreach ($models as $i => $m): ?>
      <div class="model-row <?= $i % 2 === 1 ? 'reverse' : '' ?>">
        <div class="croquis-wrap"><?= croquis('m'.$i) ?></div>
        <div>
          <h3><?= htmlspecialchars($m['name']) ?></h3>
          <span class="role"><?= htmlspecialchars($m['role']) ?></span>
          <p class="quote">&ldquo;<?= htmlspecialchars($m['quote']) ?>&rdquo;</p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<section id="lookbook" class="section lookbook">
  <div class="wrap">
    <div class="section-head on-dark">
      <p class="eyebrow">Lookbook</p>
      <h2>Six looks from the current collection</h2>
    </div>
    <div class="look-grid">
      <?php foreach ($looks as $l): ?>
        <div class="look-card">
          <?= croquis('l'.$l['title']) ?>
          <span class="tag"><?= htmlspecialchars($l['tag']) ?></span>
          <h4><?= htmlspecialchars($l['title']) ?></h4>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section id="newsletter" class="section newsletter">
  <div class="wrap">
    <p class="eyebrow">The Journal</p>
    <h2 style="font-family:var(--font-display);font-weight:500;font-size:1.8rem;margin:10px 0 0;">
      One dispatch, each new season
    </h2>
    <?php if ($subscribed): ?>
      <p class="form-note success">You're on the list — the next dispatch lands with the new season.</p>
    <?php else: ?>
      <form method="post" action="#newsletter" novalidate>
        <input type="email" name="email" placeholder="you@email.com" required
               value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
        <button type="submit">Subscribe</button>
      </form>
      <?php if ($form_error): ?>
        <p class="form-note"><?= htmlspecialchars($form_error) ?></p>
      <?php else: ?>
        <p class="form-note">No spam — one seasonal note, unsubscribe anytime.</p>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</section>

<footer>
  <div class="wrap">
    <span>&copy; <?= htmlspecialchars($year) ?> Atelier Noir. A fictional fashion journal.</span>
    <nav>
      <a href="#trends">Collections</a>
      <a href="#models">Muses</a>
      <a href="#lookbook">Lookbook</a>
    </nav>
  </div>
</footer>

</body>
</html>
