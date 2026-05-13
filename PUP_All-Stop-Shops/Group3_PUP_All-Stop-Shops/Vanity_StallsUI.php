<?php
    require 'db_connect.php';
    session_start();

    if (!isset($_SESSION['role'])) {
        $_SESSION['role'] = 'guest';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller - Stalls UI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap');
        .font-playfair { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[white] min-h-screen p-8 font-sans">

    <!-- Main Container -->
    <div class="bg-white max-w-[1500x] mx-auto rounded-md shadow-sm min-h-[800px]">
            
        <!-- Top Navigation -->
        <nav class="flex justify-between items-center px-8 py-4">
            <div class="text-[#c1121f] font-playfair text-[18px] font-semibold tracking-wide">
                PUP ★ All-Stop-Shops
            </div>

            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <div class="relative">
                    <input type="text" id="searchInput" placeholder="Search stalls..." class="border border-gray-300 rounded-full pl-4 pr-10 py-2 text-sm w-64 focus:outline-none focus:border-[#f83a45]">
                    <svg class="w-4 h-4 text-gray-500 absolute right-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <!-- Action Button -->
                <button class="bg-[#f83a45] hover:bg-red-600 text-white px-8 py-2 rounded font-medium text-sm transition-colors">
                    <div class="nav-links">
                        <a href="AboutUs.php" class="text-white text-sm font-medium">About Us</a>
                    </div>
                </button>
            </div>
        </nav>
        <div class="h-px bg-gray-200 shadow-[0_4px_4px_rgba(0,0,0,0.08)] w-screen relative left-1/2 right-1/2 -mx-[50vw]"></div>

        <!-- Page Header -->
        <div class="px-10 mt-8 mb-4 flex flex-wrap items-end justify-between gap-4">
            <div>
                <h1 id="categoryTitle" class="font-playfair text-[3.25rem] leading-none text-gray-900 inline-block">Vanity/School Supplies</h1>
                <span id="categorySubtitle" class="text-gray-500 text-base ml-3 align-bottom tracking-wide">Stalls</span>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <select id="categorySelect" class="border border-gray-300 rounded-full px-4 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#f83a45]">
                    <option value="Canteen_StallsUI.php" selected>Vanity & School Supplies</option>
                    <option value="SchoolSupplies_StallsUI.php">Services</option>
                    <option value="Canteen_StallsUI.php">Food</option>
                </select>
                <select id="sortSelect" class="border border-gray-300 rounded-full px-4 py-2 text-sm text-gray-700 focus:outline-none focus:border-[#f83a45]">
                    <option value="default" selected>Sort: Default</option>
                    <option value="name-asc">Sort: A-Z</option>
                    <option value="rating-desc">Sort: Most Reviewed</option>
                    <option value="stall-asc">Sort: Stall Number</option>
                </select>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-10">
            
            <!-- LEFT COLUMN: Stall List (Takes up 2/3 width) -->
            <div id="stallsList" class="lg:col-span-2 flex flex-col gap-6">
                
                <!-- Stall Card 1 -->
                <div class="stall-card bg-[#f9f9f6] border border-gray-200 rounded-2xl flex overflow-hidden shadow-sm">
                    <div class="w-44 sm:w-48 md:w-52 h-28 sm:h-32 md:h-36 bg-[#f0f0f0] flex-shrink-0">
                        <img src="685141249_2615691825553124_2477145673121265945_n.jpg" alt="Fast Food" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-center">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="stall-name font-bold text-gray-900 text-lg">N/A</h3>
                            <span class="font-bold text-gray-900">Stall 1</span>
                        </div>
                        <p class="text-[#ffb800] font-bold text-sm mb-4">Review: 8/10</p>
                        
                        <!-- Weight/Input Badge -->
                        <div class="bg-white border border-gray-200 rounded-full px-4 py-1.5 w-max flex items-center gap-6 shadow-sm">
                             <button type="button" onclick="handleReviewClick('Reviews.php')" class="text-left" style="font-weight: bold; font-size: 0.875rem;">Leave a Comment?</button>
                            <svg class="w-3.5 h-3.5 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stall Card 2 -->
                <div class="stall-card bg-[#f9f9f6] border border-gray-200 rounded-2xl flex overflow-hidden shadow-sm">
                    <div class="w-44 sm:w-48 md:w-52 h-28 sm:h-32 md:h-36 bg-[#e2e2e4] flex-shrink-0">
                        <!-- Placeholder Image (Ginger) -->
                        <img src="685119452_2595374397525717_6481216069526346707_n.jpg" alt="Ginger" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-center">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="stall-name font-bold text-gray-900 text-lg">N/A</h3>
                            <span class="font-bold text-gray-900">Stall 2</span>
                        </div>
                        <p class="text-[#ffb800] font-bold text-sm mb-4">Review: 9.5/10</p>
                        
                        <div class="bg-white border border-gray-200 rounded-full px-4 py-1.5 w-max flex items-center gap-6 shadow-sm">
                             <button type="button" onclick="handleReviewClick('Reviews.php')" class="text-left" style="font-weight: bold; font-size: 0.875rem;">Leave a Comment?</button>
                            <svg class="w-3.5 h-3.5 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Stall Card 3 -->
                <div class="stall-card bg-[#f9f9f6] border border-gray-200 rounded-2xl flex overflow-hidden shadow-sm">
                    <div class="w-44 sm:w-48 md:w-52 h-28 sm:h-32 md:h-36 bg-[#ececf0] flex-shrink-0">
                        <img src="680596054_1504468554425319_1781611860445423912_n.jpg" alt="Stall" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 flex-1 flex flex-col justify-center">
                        <div class="flex justify-between items-start mb-1">
                            <h3 class="stall-name font-bold text-gray-900 text-lg">N/A</h3>
                            <span class="font-bold text-gray-900">Stall 11</span>
                        </div>
                        <p class="text-[#ffb800] font-bold text-sm mb-4">Review: 10/10</p>
                        
                        <div class="bg-white border border-gray-200 rounded-full px-4 py-1.5 w-max flex items-center gap-6 shadow-sm">
                             <button type="button" onclick="handleReviewClick('Reviews.php')" class="text-left" style="font-weight: bold; font-size: 0.875rem;">Leave a Comment?</button>
                            <svg class="w-3.5 h-3.5 text-gray-400 cursor-pointer hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Overview & Reviews (Takes up 1/3 width) -->
            <div class="flex flex-col gap-6">
                
                <!-- Overview Card -->
                 <div class="bg-[#f9f9f6] border border-gray-200 rounded-2xl p-5 shadow-sm">
                    <h2 class="font-bold text-gray-900 mb-6">Selected Stall Overview</h2>
                    
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Rating</span>
                            <span class="text-gray-800" id="overviewRating">0/10</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Service</span>
                            <span class="text-gray-800" id="overviewService">N/A</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Owner</span>
                            <span class="text-gray-800" id="overviewOwner">John Doe/Jane Doe</span>
                        </div>
                        <br>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Last updated: </span>
                        <span class="font-bold text-gray-900 text-lg" id="overviewLastUpdated">0 seconds ago</span>
                    </div>

                    <br>

                    <button class="w-full bg-[#416a23] hover:bg-[#34551c] text-white py-3 px-4 rounded-lg text-sm font-medium flex justify-between items-center transition-colors">
                        <div class="nav-links">
                            <a href="Reviews.php" class="text-white text-sm font-medium">Check Overall Feedback (FORMS)</a>
                        </div>
                        <span>→</span>
                    </button>
                </div>

                <!-- Review Card -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm w-3/4">
                    <button type="button" onclick="handleReviewClick('Reviews.php')" class="flex gap-1 mb-3 cursor-pointer group" title="Would you like to share your feedback?">
                        <svg class="w-4 h-4 text-gray-800 group-hover:text-yellow-400 group-hover:fill-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        <svg class="w-4 h-4 text-gray-800 group-hover:text-yellow-400 group-hover:fill-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        <svg class="w-4 h-4 text-gray-800 group-hover:text-yellow-400 group-hover:fill-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        <svg class="w-4 h-4 text-gray-800 group-hover:text-yellow-400 group-hover:fill-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        <svg class="w-4 h-4 text-gray-800 group-hover:text-yellow-400 group-hover:fill-yellow-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                    </button>

                    <button type="button" onclick="handleReviewClick('Reviews.php')" class="font-bold text-gray-900 text-[15px] cursor-pointer hover:text-yellow-500 transition-colors" title="Would you like to share your feedback?">Review title</button>
                    <p class="text-xs text-gray-500 mt-1 mb-5">Review body</p>

                    <!-- Profile Info -->
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Reviewer+Name&background=0D8ABC&color=fff&rounded=true&size=32" alt="Reviewer" class="w-8 h-8 rounded-full">
                        <div>
                            <p class="text-xs font-bold text-gray-500">Reviewer name</p>
                            <p class="text-[10px] text-gray-400">Date</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <script>
        const isGuest = <?php echo json_encode($_SESSION['role'] === 'guest'); ?>;

        function handleReviewClick(url) {
            if (isGuest) {
                alert('Please sign up or sign in first to leave a review.');
                window.location.href = 'Registration.php';
                return;
            }
            window.location.href = url;
        }

        const staticData = [
            { service: 'Very Satisfied', owner: 'David Maritinez', updated: '2 days ago' },
            { service: 'Extremely Satisfied', owner: 'Shane Makasinag', updated: '2 week ago' },
            { service: 'Highly Recommended', owner: 'Aaron Ligazpi', updated: 'Yesterday' },
            { service: 'Highly Recommended', owner: 'Juan Dela Cruz', updated: '3 hours ago' }
        ];

        const stallsList = document.getElementById('stallsList');
        const stallCards = Array.from(stallsList.querySelectorAll('.stall-card'));
        const categorySelect = document.getElementById('categorySelect');
        const sortSelect = document.getElementById('sortSelect');
        const categoryTitle = document.getElementById('categoryTitle');
        const categorySubtitle = document.getElementById('categorySubtitle');

        document.getElementById('searchInput').addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();

            stallCards.forEach(card => {
                const stallName = card.querySelector('.stall-name').textContent.toLowerCase();
                if (stallName.includes(searchTerm)) {
                    card.style.display = 'flex'; // show the card (flex to restore it properly)
                } else {
                    card.style.display = 'none'; // hide the card
                }
            });
        });

        categorySelect.addEventListener('change', function(e) {
            const targetUrl = e.target.value;
            if (targetUrl && targetUrl !== window.location.pathname.split('/').pop()) {
                window.location.href = targetUrl;
            }
        });

        const parseRating = (card) => {
            const ratingText = card.querySelector('.text-\\[\\#ffb800\\]').textContent;
            const value = ratingText.replace('Review:', '').replace('/10', '').trim();
            const parsed = parseFloat(value);
            return Number.isNaN(parsed) ? 0 : parsed;
        };

        const parseStallNumber = (card) => {
            const label = card.querySelector('span.font-bold.text-gray-900').textContent;
            const value = label.replace('Stall', '').trim();
            const parsed = parseInt(value, 10);
            return Number.isNaN(parsed) ? 0 : parsed;
        };

        const sortCards = (mode) => {
            let sorted = [...stallCards];

            if (mode === 'name-asc') {
                sorted.sort((a, b) => {
                    const nameA = a.querySelector('.stall-name').textContent.trim().toLowerCase();
                    const nameB = b.querySelector('.stall-name').textContent.trim().toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (mode === 'rating-desc') {
                sorted.sort((a, b) => parseRating(b) - parseRating(a));
            } else if (mode === 'stall-asc') {
                sorted.sort((a, b) => parseStallNumber(a) - parseStallNumber(b));
            }

            sorted.forEach(card => stallsList.appendChild(card));
        };

        sortSelect.addEventListener('change', function(e) {
            sortCards(e.target.value);
        });

        // Hover functionality to update the overview card
        stallCards.forEach((card, index) => {
            // Add cursor styling to indicate interactivity
            card.classList.add('cursor-pointer', 'transition-all', 'hover:shadow-md'); 

            card.addEventListener('mouseenter', function() {
                const ratingFullText = this.querySelector('.text-\\[\\#ffb800\\]').textContent;
                const ratingText = ratingFullText.replace('Review: ', '').trim();
                
                // Get consistent static data based on the stall's index
                const stallData = staticData[index % staticData.length];

                // Update Overview Section texts (excluding the Stall Overview Name)
                document.getElementById('overviewRating').textContent = ratingText;
                document.getElementById('overviewService').textContent = stallData.service;
                document.getElementById('overviewOwner').textContent = stallData.owner;
                document.getElementById('overviewLastUpdated').textContent = stallData.updated;
                
                // Highlight the active stall card border
                stallCards.forEach(c => {
                    c.classList.remove('border-[#f83a45]');
                    c.classList.add('border-gray-200');
                });
                
                this.classList.remove('border-gray-200');
                this.classList.add('border-[#f83a45]');
            });
        });
    </script>
</body>
</html>