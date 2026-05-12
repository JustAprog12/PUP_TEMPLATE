<?php
  require 'db_connect.php';
  session_start();

  $role = $_SESSION['role'] ?? 'guest';
  $homeUrl = 'HomepageUnregistered.php';

  if ($role === 'admin') {
    $homeUrl = 'AdminDashBoard.php';
  } elseif ($role === 'vendor') {
    $homeUrl = 'HomePageVendor.php';
  } elseif ($role === 'user') {
    $homeUrl = 'HomePageRegistered.php';
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PUP Vendor – About Us</title>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet"/>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: 'DM Sans', sans-serif;
      background: #fff;
      color: #1a1a1a;
    }

    nav {
      background: #8b1a1a;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
    }

    nav .logo { color: #fff; font-weight: 600; font-size: 0.95rem; }
    nav a { color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.88rem; }
    nav a:hover { color: #fff; }
    .nav-right { display: flex; align-items: center; gap: 2rem; }

    .container { max-width: 900px; margin: 0 auto; padding: 3rem 2rem 5rem; }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.8rem;
      color: #8b1a1a;
    }

    .subtitle { color: #888; margin-top: 0.4rem; font-size: 0.95rem; }

    /* STATS */
    .stats {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 1rem;
      margin-top: 2rem;
    }

    .stat-box {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 1.3rem;
      text-align: center;
    }

    .stat-num {
      font-family: 'Playfair Display', serif;
      font-size: 2.2rem;
      color: #8b1a1a;
      font-weight: 700;
    }

    .stat-lbl { font-size: 0.78rem; color: #888; margin-top: 0.2rem; }

    /* DIVIDER LABEL */
    .section-label {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #8b1a1a;
      font-weight: 600;
      margin-top: 2.5rem;
      margin-bottom: 0.9rem;
      padding-bottom: 0.6rem;
      border-bottom: 2px solid #e0e0e0;
    }

    /* ABOUT TEXT */
    .about-text {
      font-size: 0.93rem;
      color: #555;
      line-height: 1.8;
    }

    /* TWO COL LAYOUT */
    .two-col {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 2.5rem;
      margin-top: 2.5rem;
    }

    /* TEAM */
    .team-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
      gap: 0.8rem;
      margin-top: 1rem;
    }

    .team-card {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 1rem;
      text-align: center;
      transition: border-color 0.2s;
    }

    .team-card:hover { border-color: #8b1a1a; }

    .avatar {
      width: 46px; height: 46px;
      border-radius: 50%;
      background: #8b1a1a;
      background-size: cover;
      background-position: center;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 700;
      font-size: 1rem;
      margin: 0 auto 0.6rem;
      position: relative;
      overflow: hidden;
    }

    .avatar span { position: relative; z-index: 1; }

    .team-name { font-size: 0.85rem; font-weight: 600; }
    .team-role { font-size: 0.75rem; color: #2d6a2d; margin-top: 0.2rem; }

    /* CONTACT */
    .contact-list { margin-top: 1rem; display: grid; gap: 0.7rem; }

    .contact-row {
      display: flex;
      justify-content: space-between;
      font-size: 0.88rem;
      padding: 0.7rem 0;
      border-bottom: 1px solid #f0f0f0;
      color: #555;
    }

    .contact-row strong { color: #1a1a1a; }

    /* CATEGORIES */
    .cat-list { display: flex; flex-wrap: wrap; gap: 0.5rem; margin-top: 1rem; }

    .cat-tag {
      border: 1px solid #e0e0e0;
      border-radius: 20px;
      padding: 0.3rem 0.9rem;
      font-size: 0.8rem;
      color: #555;
    }

    @media (max-width: 640px) {
      .stats { grid-template-columns: 1fr 1fr; }
      .two-col { grid-template-columns: 1fr; }
      h1 { font-size: 2rem; }
    }
  </style>
</head>
<body>

<nav>
  <div class="logo">PUP ★ All-Stop-Shops</div>
  <div class="nav-right">
    <a href="<?php echo htmlspecialchars($homeUrl); ?>">Home</a>
  </div>
</nav>

<div class="container">
  <h1>About Us.</h1>
  <p class="subtitle">The people and mission behind PUP Vendor.</p>

  <!-- STATS -->
  <div class="stats">
    <div class="stat-box">
      <div class="stat-num">10</div>
      <div class="stat-lbl">Active Vendors</div>
    </div>
    <div class="stat-box">
      <div class="stat-num">25</div>
      <div class="stat-lbl">Student Users</div>
    </div>
    <div class="stat-box">
      <div class="stat-num">10</div>
      <div class="stat-lbl">Reviews Collected</div>
    </div>
  </div>

  <!-- MISSION -->
  <div class="section-label">Our Mission</div>
  <p class="about-text">
    PUP Vendor is a campus-based platform built to connect students of the Polytechnic University of the Philippines with verified vendors and stalls within the university. We believe every student deserves easy access to affordable goods and transparent vendor information all in one place.
  </p>

  <!--  WHAT WE DO + CATEGORIES -->
  <div class="two-col">
    <div>
      <div class="section-label">What We Do</div>
      <p class="about-text">
        We provide a directory of verified campus stalls organized by category. Students can browse vendors, read honest peer reviews, and leave their own feedback. Vendors get a dashboard to track their performance and update their profiles.
      </p>
      <div class="cat-list">
        <div class="cat-tag">🍱 Food</div>
        <div class="cat-tag">☕ Drinks</div>
        <div class="cat-tag">🖨️ Print Services</div>
        <div class="cat-tag">📚 School Supplies</div>
        <div class="cat-tag">📸 Photobooth</div>
        <div class="cat-tag">🛍️ Anik-anik</div>
      </div>
    </div>

    <div>
      <div class="section-label">Contact & Support</div>
      <div class="contact-list">
        <div class="contact-row"><span>📧 Email</span><strong>PUP_All-Stop-Shops@pup.edu.ph</strong></div>
        <div class="contact-row"><span>📍 Location</span><strong>Sta. Mesa, Manila</strong></div>
        <div class="contact-row"><span>🕐 Hours</span><strong>Mon–Fri, 8AM–5PM</strong></div>
      </div>
    </div>
  </div>

  <!-- TEAM -->
  <div class="section-label" style="margin-top:2.5rem;">Meet the Team</div>
  <div class="team-grid">
    <div class="team-card">
      <div class="avatar" style="background-image:url('download1.jpg');"><span></span></div>
      <div class="team-name">Mark Joshua Apor</div>
      <div class="team-role">Backend Dev & Database Administrator</div>
    </div>
    
    <div class="team-card">
      <div class="avatar" style="background-image:url('Carlos, Sebastian Paul S..png');"><span></span></div>
      <div class="team-name">Sebastian Carlos</div>
      <div class="team-role">Frontend Dev</div>
    </div>

    <div class="team-card">
      <div class="avatar" style="background-image:url('Lacandazo, Dustin Z..jpg');"><span></span></div>
      <div class="team-name">Dustin Lacandazo</div>
      <div class="team-role">UI/UX Designer</div>
    </div>

    <div class="team-card">
      <div class="avatar" style="background-image:url('Mirabel.png');"><span></span></div>
      <div class="team-name">Pia Mirabel</div>
      <div class="team-role">UI/UX Designer</div>
    </div>

    <div class="team-card">
      <div class="avatar" style="background-image:url('download.jfif');"><span></span></div>
      <div class="team-name">Janrie Euhann Oasan</div>
      <div class="team-role">Frontend Dev</div>
    </div>
  

    
  </div>
  <!-- FEATURED REVIEWS -->
  <div class="section-label" style="margin-top:2.5rem;">What Students Say</div>
  <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(250px,1fr));gap:1rem;margin-top:1rem;">

    <div style="border:1px solid #e0e0e0;border-radius:8px;padding:1.2rem;">
      <div style="display:inline-block;background:#8b1a1a;color:#fff;font-size:0.72rem;font-weight:600;padding:0.2rem 0.6rem;border-radius:4px;margin-bottom:0.7rem;">Stall 22 · Chickenlicious · 9.8/10</div>
      <div style="display:flex;gap:2px;margin-bottom:0.6rem;">
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
      </div>
      <p style="font-size:0.88rem;color:#666;line-height:1.6;font-style:italic;">"Sulit na sulit! The fried chicken meals are filling and very student-friendly. Best sa campus!"</p>
      <div style="margin-top:0.9rem;display:flex;justify-content:space-between;font-size:0.78rem;color:#999;"><strong style="color:#1a1a1a;">Ana R.</strong><span>April 2026</span></div>
    </div>

    <div style="border:1px solid #e0e0e0;border-radius:8px;padding:1.2rem;">
      <div style="display:inline-block;background:#8b1a1a;color:#fff;font-size:0.72rem;font-weight:600;padding:0.2rem 0.6rem;border-radius:4px;margin-bottom:0.7rem;">Stall 08 · Kape Kuripot · 9.5/10</div>
      <div style="display:flex;gap:2px;margin-bottom:0.6rem;">
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
      </div>
      <p style="font-size:0.88rem;color:#666;line-height:1.6;font-style:italic;">"Perfect for early morning classes. Coffee is affordable and actually good. My go-to every day!"</p>
      <div style="margin-top:0.9rem;display:flex;justify-content:space-between;font-size:0.78rem;color:#999;"><strong style="color:#1a1a1a;">Carlo M.</strong><span>April 2026</span></div>
    </div>

    <div style="border:1px solid #e0e0e0;border-radius:8px;padding:1.2rem;">
      <div style="display:inline-block;background:#8b1a1a;color:#fff;font-size:0.72rem;font-weight:600;padding:0.2rem 0.6rem;border-radius:4px;margin-bottom:0.7rem;">Stall 08 · PrintBest · 9.3/10</div>
      <div style="display:flex;gap:2px;margin-bottom:0.6rem;">
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
        <div style="width:12px;height:12px;background:#2d6a2d;clip-path:polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);"></div>
      </div>
      <p style="font-size:0.88rem;color:#666;line-height:1.6;font-style:italic;">"Super mabilis mag-print dito! Rush ID services din available. Lifesaver during enrollment season."</p>
      <div style="margin-top:0.9rem;display:flex;justify-content:space-between;font-size:0.78rem;color:#999;"><strong style="color:#1a1a1a;">Maria L.</strong><span>April 2026</span></div>
    </div>

  </div>

</div>

</body>
</html>