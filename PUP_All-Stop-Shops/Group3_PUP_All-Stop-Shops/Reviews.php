<?php
    require 'db_connect.php';
    session_start();
  
    $role = $_SESSION['role'] ?? 'guest';

    // Determine the homepage based on user session role
    $home_link = 'HomePageUnRegistered.php';
    if ($role === 'vendor') {
      $home_link = 'HomePageVendor.php';
    } elseif ($role === 'user') {
      $home_link = 'HomePageRegistered.php';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>PUP Vendor – Reviews</title>
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
    .nav-links { display: flex; gap: 1.5rem; }
    nav a { color: rgba(255,255,255,0.8); text-decoration: none; font-size: 0.88rem; }
    nav a:hover { color: #fff; }

    .container { max-width: 1200px; margin: 0 auto; padding: 3rem 2rem; }

    h1 {
      font-family: 'Playfair Display', serif;
      font-size: 2.8rem;
      color: #8b1a1a;
    }

    .subtitle { color: #888; margin-top: 0.4rem; font-size: 0.95rem; }

    /* SUMMARY CARDS */
    .summary {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 1rem;
      margin-top: 2rem;
    }

    .card {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 1.3rem;
    }

    .card-title {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #8b1a1a;
      font-weight: 600;
      border-bottom: 1px solid #e0e0e0;
      padding-bottom: 0.7rem;
      margin-bottom: 1rem;
    }

    .card-row {
      display: flex;
      justify-content: space-between;
      font-size: 0.9rem;
      padding: 0.3rem 0;
    }

    .card-row span:last-child { font-weight: 600; color: #8b1a1a; }

    /* FILTERS */
    .section-label {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #8b1a1a;
      font-weight: 600;
      margin-top: 2.5rem;
      margin-bottom: 1rem;
    }

    .chips { display: flex; gap: 0.5rem; margin-bottom: 1.2rem; }

    .chip {
      border: 1px solid #ddd;
      border-radius: 20px;
      padding: 0.3rem 0.9rem;
      font-size: 0.8rem;
      cursor: pointer;
      background: #fff;
      font-family: 'DM Sans', sans-serif;
      transition: all 0.15s;
    }

    .chip:hover, .chip.active {
      background: #8b1a1a;
      border-color: #8b1a1a;
      color: #fff;
    }

    /* REVIEW CARDS */
    .reviews-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 1rem;
    }

    .review-card {
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      padding: 1.2rem;
      transition: border-color 0.2s;
    }

    .review-card:hover { border-color: #8b1a1a; }

    .badge {
      display: inline-block;
      background: #8b1a1a;
      color: #fff;
      font-size: 0.72rem;
      font-weight: 600;
      padding: 0.2rem 0.6rem;
      border-radius: 4px;
      margin-bottom: 0.7rem;
    }

    .stars { display: flex; gap: 2px; margin-bottom: 0.6rem; }

    .star {
      width: 12px; height: 12px;
      background: #2d6a2d;
      clip-path: polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);
    }
    .star.empty { background: #ddd; }

    .review-text {
      font-size: 0.88rem;
      color: #666;
      line-height: 1.6;
      font-style: italic;
    }

    .review-link {
      color: inherit;
      text-decoration: none;
      cursor: pointer;
    }

    .review-link:hover {
      color: #8b1a1a;
      text-decoration: underline;
    }

    .review-meta {
      margin-top: 0.9rem;
      display: flex;
      justify-content: space-between;
      font-size: 0.78rem;
      color: #999;
    }

    .review-meta strong { color: #1a1a1a; }

    /* FORM */
    .form-section {
      margin-top: 2.5rem;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      overflow: hidden;
    }

    .form-header {
      background: #f9f9f9;
      padding: 1rem 1.3rem;
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: #8b1a1a;
      font-weight: 600;
      border-bottom: 1px solid #e0e0e0;
      cursor: pointer;
      display: flex;
      justify-content: space-between;
    }

    .form-body { padding: 1.5rem; display: none; }
    .form-body.open { display: block; }

    .form-body label { font-size: 0.8rem; color: #888; display: block; margin-bottom: 0.3rem; }

    .form-body input,
    .form-body select,
    .form-body textarea {
      width: 100%;
      border: 1px solid #ddd;
      border-radius: 6px;
      padding: 0.5rem 0.8rem;
      font-size: 0.9rem;
      font-family: 'DM Sans', sans-serif;
      margin-bottom: 1rem;
      outline: none;
    }

    .form-body input:focus,
    .form-body textarea:focus { border-color: #8b1a1a; }

    .btn {
      background: #8b1a1a;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 0.6rem 1.2rem;
      font-size: 0.88rem;
      font-family: 'DM Sans', sans-serif;
      cursor: pointer;
      width: 100%;
    }

    .btn:hover { background: #a82020; }

    @media (max-width: 600px) {
      .summary { grid-template-columns: 1fr; }
      h1 { font-size: 2rem; }
    }
  </style>
</head>
<body>

<nav>
  <div class="logo">PUP ★ All-Stop-Shops</div>
  <div class="nav-links">
    <a href="<?php echo htmlspecialchars($home_link, ENT_QUOTES, 'UTF-8'); ?>">Home</a>
    <a href="AboutUs.php">About Us</a>
  </div>
</nav>

<div class="container">
  <h1>Reviews.</h1>
  <p class="subtitle">What students say about campus vendors.</p>

  <!-- SUMMARY -->
  <div class="summary">
    <div class="card">
      <div class="card-title">Review Summary</div>
      <div class="card-row"><span>Total Reviews</span><span>12</span></div>
      <div class="card-row"><span>Average Rating</span><span>8.0/10</span></div>
      <div class="card-row"><span>Stalls Reviewed</span><span>9</span></div>
    </div>
    <div class="card">
      <div class="card-title">Top Rated This Month</div>
      <div class="card-row"><span>🏆 J.I.B. Food and Beverage (Stall 19)</span><span>8.5/10</span></div>
      <div class="card-row"><span>🥈 Blessings Digital Photocopy (Stall 9)</span><span>8.5/10</span></div>
      <div class="card-row"><span>🥉 Waffle Time (Stall 17)</span><span>8.0/10</span></div>
    </div>
  </div>

  <!-- REVIEWS -->
  <div class="section-label">Browse by Category</div>
  <div class="chips">
    <button class="chip active" onclick="filter('all', this)">All</button>
    <button class="chip" onclick="filter('food', this)">Food</button>
    <button class="chip" onclick="filter('print', this)">Print Services</button>
    <button class="chip" onclick="filter('supplies', this)">School Supplies</button>
    <button class="chip" onclick="filter('others', this)">Others</button>
  </div>

  <div class="reviews-grid" id="grid">

    <!-- FOOD -->
    <div class="review-card" data-cat="food">
      <div class="badge">Stall 20 · 4th J · 8/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="Canteen_StallsUI.php">"Overall satisfied."</a></p>
      <div class="review-meta"><strong>Vince</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="food">
      <div class="badge">Stall 20 · 4th J · 8/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="Canteen_StallsUI.php">"Very satisfied."</a></p>
      <div class="review-meta"><strong>Sammy</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="food">
      <div class="badge">Stall 17 · Waffle Time · 7/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="Canteen_StallsUI.php">"7/10."</a></p>
      <div class="review-meta"><strong>Emma</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="food">
      <div class="badge">Stall 17 · Waffle Time · 9/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
      <p class="review-text"><a class="review-link" href="Canteen_StallsUI.php">"9/10."</a></p>
      <div class="review-meta"><strong>Naeomi</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="food">
      <div class="badge">Stall 19 · J.I.B. Food and Beverage · 10/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
      <p class="review-text"><a class="review-link" href="Canteen_StallsUI.php">"10/10 Perfect."</a></p>
      <div class="review-meta"><strong>Louis</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="food">
      <div class="badge">Stall 19 · J.I.B. Food and Beverage · 7/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="Canteen_StallsUI.php">"7/10."</a></p>
      <div class="review-meta"><strong>Shyn</strong><span>May 2026</span></div>
    </div>

    <!-- PRINT SERVICES -->
    <div class="review-card" data-cat="print">
      <div class="badge">Stall 8 · PrintBest · 6.5/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="SchoolSupplies_StallsUI.php">"6.5/10."</a></p>
      <div class="review-meta"><strong>Kevin</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="print">
      <div class="badge">Stall 8 · PrintBest · 8/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="SchoolSupplies_StallsUI.php">"Very satisfied."</a></p>
      <div class="review-meta"><strong>Quiel</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="print">
      <div class="badge">Stall 9 · Blessings Digital Photocopy · 9/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div></div>
      <p class="review-text"><a class="review-link" href="SchoolSupplies_StallsUI.php">"9/10."</a></p>
      <div class="review-meta"><strong>Tricia</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="print">
      <div class="badge">Stall 9 · Blessings Digital Photocopy · 8/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="SchoolSupplies_StallsUI.php">"8/10."</a></p>
      <div class="review-meta"><strong>Jane</strong><span>May 2026</span></div>
    </div>

    <!-- SCHOOL SUPPLIES -->
    <div class="review-card" data-cat="supplies">
      <div class="badge">Stall 4 · School Supplies · 7/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="Vanity_StallsUI.php">"7/10."</a></p>
      <div class="review-meta"><strong>Paul</strong><span>May 2026</span></div>
    </div>
    <div class="review-card" data-cat="supplies">
      <div class="badge">Stall 4 · School Supplies · 8/10</div>
      <div class="stars"><div class="star"></div><div class="star"></div><div class="star"></div><div class="star"></div><div class="star empty"></div></div>
      <p class="review-text"><a class="review-link" href="Vanity_StallsUI.php">"8/10."</a></p>
      <div class="review-meta"><strong>Miguel</strong><span>May 2026</span></div>
    </div>
  

  <!-- LEAVE A REVIEW -->
  <div class="form-section">
    <div class="form-header" onclick="toggleForm()">
      <span>Leave a Review</span><span id="arrow">⌄</span>
    </div>
    <div class="form-body" id="form-body">
      <label>Your Name</label>
      <input type="text" placeholder="e.g. Juan dela Cruz"/>
      <label>Vendor / Stall</label>
      <select>
        <optgroup label="Food">
          <option>Stall 13 – Fudbook Kitchenette</option>
          <option>Stall 14 – Flavored Drinks & Groceries</option>
          <option>Stall 15 – Puroy's Eatery</option>
          <option>Stall 16 – Flavors of Lagoon</option>
          <option>Stall 17 – Waffle Time</option>
          <option>Stall 18 – Liza's Eatery</option>
          <option>Stall 19 – J.I.B. Food and Beverage</option>
          <option>Stall 20 – 4th J</option>
          <option>Stall 21 – Cup of Tea</option>
          <option>Stall 22 – Chickenlicious</option>
          <option>Stall 23 – Mirese Ann</option>
          <option>Stall 24 – David's Wings</option>
          <option>Stall 25 – Prutas Con Yelo</option>
          <option>Stall 26 – Don Jon</option>
          <option>Stall 27 – Varda</option>
          <option>Stall 02 – SariSip & Crunch</option>
          <option>Stall 03 – Trinas @ PUP</option>
          <option>Stall 06 – Pepper's Food Stall</option>
          <option>Stall 08 – Kape Kuripot</option>
          <option>Stall 09 – Potato Corner</option>
          <option>Stall 11 – Cuadro De J</option>
          <option>Stall 12 – Go! Go! Healthy</option>
        </optgroup>
        <optgroup label="Print Services">
          <option>Stall 08 – PrintBest</option>
          <option>Stall 09 – Blessings Services</option>
          <option>Stall 10 – JCM Printing Services</option>
          <option>Stall 04 – KAKZ BYTE</option>
        </optgroup>
        <optgroup label="School Supplies">
          <option>Stall 01 – School Supplies</option>
          <option>Stall 11 – School Supplies and Print Services</option>
        </optgroup>
        <optgroup label="Others">
          <option>Stall 15 – FlickTure Studios</option>
          <option>Stall 22 – PUPreneuers</option>
          <option>Stall 16 – Anik-anik</option>
        </optgroup>
      </select>
      <label>Rating (1–10)</label>
      <input type="number" min="1" max="10" placeholder="e.g. 9"/>
      <label>Your Review</label>
      <textarea rows="3" placeholder="Share your experience..."></textarea>
      <button class="btn" type="button" onclick="handleReviewSubmit()">Submit Review</button>
    </div>
  </div>

</div>

<script>
  const isGuest = <?php echo $role === 'guest' ? 'true' : 'false'; ?>;

  function requireAuth() {
    if (isGuest) {
      alert('Please sign up or sign in first to leave a review.');
      window.location.href = 'Registration.php';
      return false;
    }
    return true;
  }
  function filter(cat, el) {
    document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
    el.classList.add('active');
    document.querySelectorAll('.review-card').forEach(card => {
      card.style.display = (cat === 'all' || card.dataset.cat === cat) ? '' : 'none';
    });
  }

  function toggleForm() {
    if (!requireAuth()) {
      return;
    }
    const body = document.getElementById('form-body');
    const arrow = document.getElementById('arrow');
    body.classList.toggle('open');
    arrow.textContent = body.classList.contains('open') ? '⌃' : '⌄';
  }

  function handleReviewSubmit() {
    if (!requireAuth()) {
      return;
    }
    alert('Review submitted! Salamat!!');
  }
</script>
</body>
</html>