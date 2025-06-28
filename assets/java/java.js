      document.addEventListener("DOMContentLoaded", function() {
            const counters = document.querySelectorAll("strong[id$='-count']");

            function animateCounter(counter) {
                const target = +counter.getAttribute("data-target");
                let current = 0;
                const increment = Math.ceil(target / 100); // Kecepatan peningkatan angka
                const duration = 2000; // Durasi animasi dalam ms (2 detik)
                const intervalTime = duration / (target / increment);

                function updateCounter() {
                    current += increment;
                    if (current >= target) {
                        counter.innerText = target; // Pastikan nilai akhir sesuai target
                    } else {
                        counter.innerText = current;
                        setTimeout(updateCounter, intervalTime);
                    }
                }

                updateCounter();
            }

            function handleScrollAnimation() {
                counters.forEach(counter => {
                    const rect = counter.getBoundingClientRect();
                    if (rect.top < window.innerHeight && counter.innerText === "0") {
                        animateCounter(counter);
                    }
                });
            }

            window.addEventListener("scroll", handleScrollAnimation);
            handleScrollAnimation(); // Menjalankan animasi jika elemen sudah terlihat saat halaman dimuat
        });
