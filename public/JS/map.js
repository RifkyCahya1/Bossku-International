document.addEventListener("DOMContentLoaded", function () {
    function getMapConfig() {
        const width = window.innerWidth;
        const height = window.innerHeight;
        const isDesktop = width >= 1024;
        const isTablet = width >= 768 && width < 1024;
        const isMobile = width < 768;

        let minZoom, maxZoom, initialZoom;
        if (width >= 1440) {
            minZoom = 5.2;
            maxZoom = 6.2;
            initialZoom = 5.4;
        } else if (width >= 1024) {
            minZoom = 5.2;
            maxZoom = 5.8;
            initialZoom = 5.4;
        } else if (width >= 768) {
            minZoom = 5.0;
            maxZoom = 5.6;
            initialZoom = 5.2;
        } else if (width >= 480) {
            minZoom = 4.6;
            maxZoom = 5.4;
            initialZoom = 4.8;
        } else {
            // Very small screens (e.g., phones)
            minZoom = 4.0;
            maxZoom = 5.0;
            initialZoom = 4.2;
        }

        return {
            isDesktop,
            isTablet,
            isMobile,
            minZoom,
            maxZoom,
            initialZoom,
            width,
            height,
        };
    }

    // Save zoom control manually
    let zoomCtrl = null;

    function createMap() {
        const cfg = getMapConfig();

        // Dynamically set map height for responsiveness
        const mapElement = document.getElementById("map");
        if (cfg.isMobile) {
            mapElement.style.height = `${cfg.height * 0.7}px`; // 70% of screen height on mobile
        } else if (cfg.isTablet) {
            mapElement.style.height = `${cfg.height * 0.8}px`; // 80% on tablet
        } else {
            mapElement.style.height = `${cfg.height * 0.9}px`; // 90% on desktop
        }
        mapElement.style.width = "100%";

        const map = L.map("map", {
            zoomControl: false, // We handle manually
            dragging: true, // Enable dragging on all devices (flip from original if you want to disable on desktop)
            scrollWheelZoom: cfg.isDesktop,
            doubleClickZoom: false,
            boxZoom: false,
            keyboard: false,
            touchZoom: true,
            tap: true,
            minZoom: cfg.minZoom,
            maxZoom: cfg.maxZoom,
        }).setView([-2.5, 118], cfg.initialZoom);

        // Add zoom control if desktop
        if (cfg.isDesktop) {
            zoomCtrl = L.control.zoom({ position: "topleft" }).addTo(map);
        }

        setTimeout(() => map.invalidateSize(), 300);
        return map;
    }

    const map = createMap();

    // Debounce function
    function debounce(fn, wait = 150) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn.apply(this, args), wait);
        };
    }

    // Handle window resize
    window.addEventListener(
        "resize",
        debounce(() => {
            const cfg = getMapConfig();

            // Update map height dynamically
            const mapElement = document.getElementById("map");
            if (cfg.isMobile) {
                mapElement.style.height = `${cfg.height * 0.7}px`;
            } else if (cfg.isTablet) {
                mapElement.style.height = `${cfg.height * 0.8}px`;
            } else {
                mapElement.style.height = `${cfg.height * 0.9}px`;
            }

            // Adjust dragging (enabled on all now, but you can customize)
            if (!map.dragging.enabled()) {
                map.dragging.enable();
            }

            // Toggle zoom control
            if (cfg.isDesktop) {
                if (!zoomCtrl) {
                    zoomCtrl = L.control
                        .zoom({ position: "topleft" })
                        .addTo(map);
                }
            } else {
                if (zoomCtrl) {
                    map.removeControl(zoomCtrl);
                    zoomCtrl = null;
                }
            }

            map.setMinZoom(cfg.minZoom);
            map.setMaxZoom(cfg.maxZoom);
            map.invalidateSize();
        }, 200)
    );

    // Handle orientation change (especially for mobile)
    window.addEventListener("orientationchange", () => {
        setTimeout(() => {
            const cfg = getMapConfig();
            const mapElement = document.getElementById("map");
            if (cfg.isMobile) {
                mapElement.style.height = `${cfg.height * 0.7}px`;
            } else if (cfg.isTablet) {
                mapElement.style.height = `${cfg.height * 0.8}px`;
            } else {
                mapElement.style.height = `${cfg.height * 0.9}px`;
            }
            map.invalidateSize();
        }, 500); // Delay to allow orientation to settle
    });

    map.getContainer().style.background = "#f4f4f4";

    let provinceData = [];

    fetch("JSON/province.json")
        .then((response) => response.json())
        .then((data) => {
            provinceData = data;
            console.log("✅ Province data loaded:", data);
        })
        .catch((err) => console.error("❌ Failed to load province.json:", err));

    function showModal(data) {
        const existingModal = document.getElementById("dynamicModal");
        if (existingModal) existingModal.remove();

        const modal = document.createElement("div");
        modal.id = "dynamicModal";
        modal.className =
            "fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[9999] opacity-0 scale-95 transition-all duration-300 ease-out";

        modal.innerHTML = `
      <div id="modalContent"
           class="relative bg-white rounded-2xl max-w-4xl w-11/12 md:w-2/3 shadow-2xl transform scale-95 transition-all duration-300 ease-out overflow-hidden">

        <!-- Tombol X -->
        <button id="closeModal"
          class="absolute top-3 right-4 z-50 text-white bg-black/40 hover:bg-black/60 rounded-full w-10 h-10 flex items-center justify-center text-3xl font-bold transition-transform hover:scale-110">
          &times;
        </button>

        <!-- Gambar -->
        <div class="relative">
          <img src="${data.image}" alt="${data.name_en}"
               class="w-full h-64 md:h-96 object-cover"> <!-- Made height responsive -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          <h2 class="absolute bottom-4 left-6 text-white text-2xl md:text-3xl font-bold drop-shadow-lg">${
              data.name_en
          }</h2>
        </div>

        <!-- Konten -->
        <div class="p-4 md:p-6">
          <p class="text-gray-700 leading-relaxed mb-4 md:mb-6 text-sm md:text-base">${
              data.description
          }</p>
          <div class="flex justify-end">
            <button 
              onclick="window.location.href='/Province/${encodeURIComponent(
                  data.name_en
              )}'"
              class="bg-gradient-to-r from-blue-700 to-blue-900 text-white font-medium px-4 py-2 md:px-6 md:py-2.5 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 ease-out text-sm md:text-base">
              Learn More
            </button>
          </div>
        </div>
      </div>
    `;

        document.body.appendChild(modal);

        const closeModalBtn = modal.querySelector("#closeModal");
        const modalContent = modal.querySelector("#modalContent");

        setTimeout(() => {
            modal.classList.remove("opacity-0", "scale-95");
            modal.classList.add("opacity-100", "scale-100");
            modalContent.classList.remove("scale-95");
            modalContent.classList.add("scale-100");
        }, 10);

        function closeModal() {
            modal.classList.remove("opacity-100", "scale-100");
            modal.classList.add("opacity-0", "scale-95");
            setTimeout(() => modal.remove(), 300);
        }

        closeModalBtn.addEventListener("click", closeModal);

        modal.addEventListener("click", (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeModal();
        });
    }

    const provinceTranslations = {
        Aceh: "Aceh",
        "Sumatera Utara": "North Sumatra",
        "Sumatera Barat": "West Sumatra",
        Riau: "Riau",
        "Kepulauan Riau": "Riau Islands",
        Jambi: "Jambi",
        Bengkulu: "Bengkulu",
        "Sumatera Selatan": "South Sumatra",
        Lampung: "Lampung",
        "Bangka Belitung": "Bangka Belitung Islands",
        Banten: "Banten",
        "Jakarta Raya": "Jakarta",
        "Jawa Barat": "West Java",
        "Jawa Tengah": "Central Java",
        "DI Yogyakarta": "Yogyakarta",
        "Jawa Timur": "East Java",
        Bali: "Bali",
        "Nusa Tenggara Barat": "West Nusa Tenggara",
        "Nusa Tenggara Timur": "East Nusa Tenggara",
        "Kalimantan Barat": "West Kalimantan",
        "Kalimantan Tengah": "Central Kalimantan",
        "Kalimantan Selatan": "South Kalimantan",
        "Kalimantan Timur": "East Kalimantan",
        "Kalimantan Utara": "North Kalimantan",
        "Sulawesi Utara": "North Sulawesi",
        Gorontalo: "Gorontalo",
        "Sulawesi Tengah": "Central Sulawesi",
        "Sulawesi Barat": "West Sulawesi",
        "Sulawesi Selatan": "South Sulawesi",
        "Sulawesi Tenggara": "Southeast Sulawesi",
        Maluku: "Maluku",
        "Maluku Utara": "North Maluku",
        "Papua Barat": "West Papua",
        Papua: "Papua",
    };

    fetch(
        "https://raw.githubusercontent.com/superpikar/indonesia-geojson/master/indonesia.geojson"
    )
        .then((res) => res.json())
        .then((data) => {
            var geojsonLayer = L.geoJSON(data, {
                style: {
                    color: "#1c1c1c",
                    weight: 0.4,
                    fillColor: "#60a5fa",
                    fillOpacity: 0.8,
                },
                onEachFeature: function (feature, layer) {
                    const name =
                        feature.properties.Propinsi ||
                        feature.properties.PROVINSI ||
                        feature.properties.provinsi ||
                        feature.properties.state ||
                        feature.properties.NAME_1 ||
                        feature.properties.NAME ||
                        "Tidak diketahui";

                    const englishName = provinceTranslations[name] || name;

                    layer.bindTooltip(englishName, {
                        sticky: true,
                        direction: "top",
                        offset: [0, -10],
                        className: "custom-tooltip",
                    });

                    layer.on({
                        mouseover: (e) => {
                            e.target.setStyle({
                                fillColor: "#facc15",
                                weight: 0.8,
                            });
                            e.target.bringToFront();
                        },
                        mouseout: (e) => geojsonLayer.resetStyle(e.target),
                        click: (e) => {
                            const data = provinceData.find(
                                (p) =>
                                    p.id.toLowerCase() ===
                                    englishName.toLowerCase()
                            );
                            if (data) showModal(data);
                            else alert("No data found for " + englishName);
                        },
                    });
                },
            }).addTo(map);

            map.fitBounds(geojsonLayer.getBounds());
        })
        .catch((err) => console.error("❌ Failed to load GeoJSON:", err));
});
