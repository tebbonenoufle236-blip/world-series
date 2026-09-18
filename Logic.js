document.addEventListener("DOMContentLoaded", function () {

    /* =========================
       SEARCH
       ========================= */

    const searchInput = document.querySelector(".landing-page-search input");
    const searchButton = document.querySelector(".landing-page-search button");
    const cardsContainer = document.querySelector(".trending-cards");

    // Hide cards after the first 3 on page load (if present)
    if (cardsContainer) {
        cardsContainer.querySelectorAll(".card").forEach(function (card, index) {
            if (index >= 3) {
                card.style.display = "none";
            }
        });
    }

    function searchSeries() {
        if (!searchInput || !cardsContainer) return;

        const searchText = searchInput.value.trim().toLowerCase();
        const cards = cardsContainer.querySelectorAll(".card");

        if (searchText === "") {
            cards.forEach(function (card, index) {
                card.style.display = index < 3 ? "" : "none";
            });
            showSearchMessage("");
            return;
        }

        let found = false;

        cards.forEach(function (card) {
            const title = card.querySelector("h3");
            if (title && title.textContent.toLowerCase().includes(searchText)) {
                card.style.display = "";
                found = true;
            } else {
                card.style.display = "none";
            }
        });

        if (found) {
            showSearchMessage("");
        } else {
            showSearchMessage("لا يوجد مسلسل بهذا الاسم.");
        }
    }

    function showSearchMessage(text) {
        let message = document.getElementById("searchMessage");
        if (!message) {
            message = document.createElement("p");
            message.id = "searchMessage";
            const searchArea = document.querySelector(".landing-page-search");
            if (searchArea && searchArea.parentNode) {
                searchArea.parentNode.insertBefore(message, searchArea.nextSibling);
            }
        }
        message.textContent = text;
    }

    if (searchButton) {
        searchButton.addEventListener("click", searchSeries);
    }

    if (searchInput) {
        searchInput.addEventListener("keydown", function (event) {
            if (event.key === "Enter") {
                searchSeries();
            }
        });
    }

    /* =========================
       VIEW ALL
       ========================= */

    const viewAllButton = document.querySelector(".trending-header .btn");
    let allShown = false;

    const extraSeries = [
        {
            name: "Archive 81",
            category: "Horror and Mystery",
            image: "https://imgs.search.brave.com/n32xnaeSrUfG3bAJ2ZoPd1xuZpAYwCJLtwbLOo2MOHQ/rs:fit:500:0:1:0/g:ce/aHR0cHM6Ly9zdGF0/aWMuZmFzZWxoZGNk/bi5jb20vd3AtY29u/dGVudC91cGxvYWRz/LzIwMjIvMDEvTVY1/Qk5qbGxORGsxT1RJ/dE5tVmxaaTAwWVRV/eUxUZzRZMlF0WVdR/eU16QTBPVFpqWmpn/MlhrRXlYa0ZxY0dk/ZVFYVnlOalV4TWpj/MU9UTUAuX1YxX0ZN/anBnX1VYMTAwMF8t/LmpwZ19VWTEyMDAt/LTQwMHg2MDAuanBn",
            plot: "موظف أرشيف يُدعى دان يحصل على مهمة غامضة لترميم مجموعة من أشرطة الفيديو القديمة التي تعود إلى عام 1994. أثناء مشاهدته للتسجيلات، يبدأ في اكتشاف تحقيق مخرجة شابة حول مبنى غامض وطائفة خطيرة، ليجد نفسه مرتبطًا بالأحداث بطريقة لم يتوقعها."
        },
        {
            name: "Chernobyl",
            category: "Drama and History",
            image: "https://image.tmdb.org/t/p/w500/hlLXt2tOPT6RRnjiUmoxyG1LTFi.jpg",
            plot: "في عام 1986، يتسبب انفجار المفاعل الرابع في محطة تشيرنوبل النووية في واحدة من أسوأ الكوارث النووية في التاريخ. يتابع المسلسل العلماء والعمال ورجال الإطفاء والمسؤولين الذين يخاطرون بحياتهم للسيطرة على الكارثة، بينما يحاول البعض كشف الحقيقة وراء ما حدث."
        },
        {
            name: "The Last of Us",
            category: "Drama and Survival",
            image: "https://image.tmdb.org/t/p/w500/uKvVjHNqB5VmOrdxqAt2F7J78ED.jpg",
            plot: "بعد انتشار وباء دمّر الحضارة وأصبح العالم مليئًا بالمخاطر، يُكلَّف الناجي جويل بمرافقة فتاة صغيرة تُدعى إيلي عبر الولايات المتحدة. تتحول الرحلة الخطرة تدريجيًا إلى علاقة إنسانية عميقة، بينما يحاول الاثنان البقاء على قيد الحياة في عالم تغير بالكامل."
        },
        {
            name: "The Queen's Gambit",
            category: "Drama and Chess",
            image: "https://image.tmdb.org/t/p/w500/zU0htwkhNvBQdVSIKB9s6hgVeFK.jpg",
            plot: "بعد أن تصبح بيت هارمون يتيمة في التاسعة من عمرها، تكتشف موهبة استثنائية في الشطرنج بمساعدة عامل في دار الأيتام. ومع تقدمها في عالم المنافسات، تصعد بسرعة نحو القمة، لكن نجاحها يأتي وسط صراعات شخصية وإدمان وضغوط تهدد مستقبلها."
        }
    ];

    if (viewAllButton && cardsContainer) {
        viewAllButton.addEventListener("click", function () {
            if (!allShown) {
                extraSeries.forEach(function (series) {
                    const card = document.createElement("div");
                    card.className = "card extra-series";
                    card.innerHTML = `
                        <img class="thumb" src="${series.image}" alt="${series.name}">
                        <div class="card-info">
                            <div class="card-name">
                                <p>${series.category}</p>
                                <h3>${series.name}</h3>
                            </div>
                        </div>
                        <div class="card-description">
                            <p class="plot">${series.plot}</p>
                        </div>
                    `;
                    cardsContainer.appendChild(card);
                });

                cardsContainer.querySelectorAll(".card").forEach(function (card) {
                    card.style.display = "";
                });

                viewAllButton.textContent = "Show less";
                allShown = true;
            } else {
                cardsContainer.querySelectorAll(".extra-series").forEach(function (card) {
                    card.remove();
                });

                cardsContainer.querySelectorAll(".card").forEach(function (card, index) {
                    card.style.display = index < 3 ? "" : "none";
                });

                viewAllButton.textContent = "View all";
                allShown = false;
            }
        });
    }

    /* =========================
       SHOW / HIDE PASSWORD
       ========================= */

    function passwordButton(buttonID, inputID) {
        const button = document.getElementById(buttonID);
        const input = document.getElementById(inputID);
        if (!button || !input) return;

        button.addEventListener("click", function () {
            if (input.type === "password") {
                input.type = "text";
                button.textContent = "إخفاء كلمة المرور";
            } else {
                input.type = "password";
                button.textContent = "إظهار كلمة المرور";
            }
        });
    }

    passwordButton("showPassword", "password");
    passwordButton("showConfirmPassword", "confirm-password");

    // Client-side form validation removed so PHP handlers process the request.
});
