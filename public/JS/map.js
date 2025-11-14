document.addEventListener("DOMContentLoaded", function () {
    var map = L.map("map", {
        zoomControl: false,
        dragging: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        touchZoom: false,
        tap: false,
        minZoom: 5.4,
        maxZoom: 5.4,
    }).setView([-2.5, 118], 5);

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
               class="w-full h-96 object-cover">
          <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
          <h2 class="absolute bottom-4 left-6 text-white text-3xl font-bold drop-shadow-lg">${
              data.name_en
          }</h2>
        </div>

        <!-- Konten -->
        <div class="p-6">
          <p class="text-gray-700 leading-relaxed mb-6">${data.description}</p>
          <div class="flex justify-end">
            <button 
              onclick="window.location.href='/Province/${encodeURIComponent(
                  data.name_en
              )}'"
              class="bg-gradient-to-r from-blue-700 to-blue-900 text-white font-medium px-6 py-2.5 rounded-lg shadow-md hover:shadow-lg hover:scale-105 transition-all duration-300 ease-out">
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
