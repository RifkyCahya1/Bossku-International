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
            maxZoom = 8.2;
            initialZoom = 5.4;
        } else if (width >= 1024) {
            minZoom = 5.2;
            maxZoom = 7.8;
            initialZoom = 5.4;
        } else if (width >= 768) {
            minZoom = 5.0;
            maxZoom = 7.6;
            initialZoom = 5.2;
        } else if (width >= 480) {
            minZoom = 4.6;
            maxZoom = 7.4;
            initialZoom = 4.8;
        } else {
            minZoom = 4.0;
            maxZoom = 7.0;
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

    let zoomCtrl = null;
    let markers = [];
    let markerCluster = null;

    const destinationsByIsland = {
        Java: [
            {
                name: "Borobudur",
                latlng: [-7.6079, 110.2038],
                type: "temple",
                icon: "temple",
                province: "Central Java",
                priority: 1,
            },
            {
                name: "Bromo",
                latlng: [-7.9425, 112.953],
                type: "volcano",
                icon: "volcano",
                province: "East Java",
                priority: 1,
            },
            {
                name: "National Monument (Monas)",
                latlng: [-6.2088, 106.8456],
                type: "city",
                icon: "city",
                province: "Jakarta",
                priority: 3,
            },
        ],
        Bali: [
            {
                name: "Bali",
                latlng: [-8.4095, 115.1889],
                type: "island",
                icon: "beach",
                province: "Bali",
                priority: 1,
            },
        ],
        Sumatra: [
            {
                name: "Bukittinggi",
                latlng: [-0.3056, 100.3692],
                type: "culture",
                icon: "culture",
                province: "West Sumatra",
                priority: 2,
            },
        ],
        Sulawesi: [
            {
                name: "Toraja",
                latlng: [-3.0972, 119.8667],
                type: "culture",
                icon: "culture",
                province: "South Sulawesi",
                priority: 1,
            },
            {
                name: "Makassar",
                latlng: [-5.1477, 119.4327],
                type: "city",
                icon: "city",
                province: "South Sulawesi",
                priority: 3,
            },
        ],
        Papua: [
            {
                name: "Raja Ampat",
                latlng: [-0.8615, 130.6426],
                type: "diving",
                icon: "diving",
                province: "West Papua",
                priority: 1,
            },
            {
                name: "Puncak Jaya",
                latlng: [-4.085421, 137.180868],
                type: "volcano",
                icon: "volcano",
                province: "Papua",
                priority: 2,
            },
            {
                name: "Lorentz National Park",
                latlng: [-4.629479482382966, 137.9725861289681],
                type: "wildlife",
                icon: "wildlife",
                province: "Papua",
                priority: 3,
            },
        ],
        Kalimantan: [
            {
                name: "Balikpapan",
                latlng: [-1.2379, 116.8529],
                type: "city",
                icon: "city",
                province: "East Kalimantan",
                priority: 2,
            },
            {
                name: "Pontianak",
                latlng: [-0.0263, 109.3425],
                type: "city",
                icon: "city",
                province: "West Kalimantan",
                priority: 3,
            },
        ],
        "Nusa Tenggara": [
            {
                name: "Komodo Island",
                latlng: [-8.5732, 119.4386],
                type: "wildlife",
                icon: "dragon",
                province: "East Nusa Tenggara",
                priority: 1,
            },
        ],
    };

    function getFilteredDestinations() {
        const filtered = [];

        Object.keys(destinationsByIsland).forEach((island) => {
            const sortedDestinations = [...destinationsByIsland[island]].sort(
                (a, b) => a.priority - b.priority,
            );
            const topDestinations = sortedDestinations.slice(0, 3);

            filtered.push(...topDestinations);
        });

        return filtered;
    }

    function createMap() {
        const cfg = getMapConfig();

        const mapElement = document.getElementById("map");
        if (cfg.isMobile) {
            mapElement.style.height = `${cfg.height * 0.7}px`;
        } else if (cfg.isTablet) {
            mapElement.style.height = `${cfg.height * 0.8}px`;
        } else {
            mapElement.style.height = `${cfg.height * 0.9}px`;
        }
        mapElement.style.width = "100%";

        const mapOptions = {
            zoomControl: false,
            minZoom: cfg.minZoom,
            maxZoom: cfg.maxZoom,
        };

        if (cfg.isDesktop) {
            Object.assign(mapOptions, {
                dragging: false,
                touchZoom: false,
                scrollWheelZoom: false,
                doubleClickZoom: false,
                boxZoom: false,
                keyboard: false,
                tap: false,
            });
        }

        const map = L.map("map", mapOptions).setView(
            [-2.5, 118],
            cfg.initialZoom,
        );

        if (!cfg.isDesktop) {
            map.dragging.enable();
            map.touchZoom.enable();
            map.scrollWheelZoom.enable();
            map.doubleClickZoom.enable();
        }

        setTimeout(() => map.invalidateSize(), 300);
        return map;
    }

    const map = createMap();

    function getDestinationIcon(type, isMobile, isDesktop) {
        const colors = {
            beach: "#FF6B6B",
            temple: "#4ECDC4",
            volcano: "#FFA726",
            mountain: "#8B4513",
            diving: "#1E88E5",
            wildlife: "#43A047",
            lake: "#039BE5",
            culture: "#AB47BC",
            city: "#78909C",
            dragon: "#E53935",
            water: "#29B6F6",
        };

        const color = colors[type] || "#666";

        // Perkecil ukuran marker
        const size = isDesktop ? 24 : isMobile ? 18 : 22; // Dikurangi 4-6px dari sebelumnya

        // Marker pin standar yang lebih kecil
        return L.divIcon({
            className: "custom-marker",
            html: `
            <div style="
                width: ${size}px;
                height: ${size}px;
                background: ${color};
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
                position: relative;
                border: 2px solid white;
                box-shadow: 0 2px 5px rgba(0,0,0,0.3);
            ">
                <div style="
                    position: absolute;
                    width: ${size / 3.5}px;  /* Lebih kecil */
                    height: ${size / 3.5}px; /* Lebih kecil */
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(45deg);
                    background: white;
                    border-radius: 50%;
                "></div>
            </div>
        `,
            iconSize: [size, size],
            iconAnchor: [size / 2, size],
            popupAnchor: [0, -size / 2],
        });
    }

    function getIconSymbol(type) {
        const symbols = {
            beach: "🏖️",
            temple: "🛕",
            volcano: "🌋",
            mountain: "⛰️",
            diving: "🤿",
            wildlife: "🐉",
            lake: "🏞️",
            culture: "🎎",
            city: "🏙️",
            dragon: "🐲",
            water: "🌊",
        };
        return symbols[type] || "📍";
    }

    function getCategoryIcon(type) {
        const icons = {
            beach: "🏖️",
            temple: "🛕",
            volcano: "🌋",
            mountain: "⛰️",
            diving: "🤿",
            wildlife: "🐅",
            lake: "🏞️",
            culture: "🎭",
            city: "🏙️",
            island: "🏝️",
            dragon: "🐉",
        };
        return icons[type] || "📍";
    }

    function getIslandByCoordinates(lat, lng) {
        if (lat > -9 && lat < -6 && lng > 105 && lng < 114.5) return "Java";
        if (lat > -8.9 && lat < -8 && lng > 114.5 && lng < 115.8) return "Bali";
        if (lat > -6 && lat < 6 && lng > 95 && lng < 106) return "Sumatra";
        if (lat > -9 && lat < 2 && lng > 119 && lng < 127) return "Sulawesi";
        if (lat > -10 && lat < 0 && lng > 125 && lng < 135) return "Papua";
        if (lat > -5 && lat < 5 && lng > 108 && lng < 119) return "Kalimantan";
        if (lat > -10 && lat < -8 && lng > 115.8 && lng < 125)
            return "Nusa Tenggara";
        return "Other";
    }

    function getIconColor(type) {
        const colors = {
            beach: "#FF6B6B",
            temple: "#4ECDC4",
            volcano: "#FFA726",
            mountain: "#8B4513",
            diving: "#1E88E5",
            wildlife: "#43A047",
            lake: "#039BE5",
            culture: "#AB47BC",
            city: "#78909C",
            dragon: "#E53935",
            water: "#29B6F6",
        };
        return colors[type] || "#666";
    }

    // Fungsi utama untuk menambahkan marker destinasi dengan popup responsif
    function addDestinationMarkers(map) {
        const cfg = getMapConfig();

        markers.forEach((marker) => map.removeLayer(marker));
        markers = [];

        const filteredDestinations = getFilteredDestinations();

        filteredDestinations.forEach((dest) => {
            const island = getIslandByCoordinates(
                dest.latlng[0],
                dest.latlng[1],
            );

            const marker = L.marker(dest.latlng, {
                icon: getDestinationIcon(
                    dest.icon,
                    cfg.isMobile,
                    cfg.isDesktop,
                ),
                title: dest.name,
            }).addTo(map);

            // Popup content responsif berdasarkan perangkat
            let popupContent;
            if (cfg.isDesktop) {
                popupContent = `
                    <div class="popup-container desktop-popup">
                        <div class="popup-header">
                            <div class="popup-icon" style="background: ${getIconColor(
                                dest.icon,
                            )}">
                                ${getIconSymbol(dest.icon)}
                            </div>
                            <div class="popup-title">
                                <h3>${dest.name}</h3>
                                <p>${dest.province}</p>
                            </div>
                        </div>
                        
                        <div class="popup-info">
                            <div class="info-item">
                                <span class="info-icon">${getCategoryIcon(
                                    dest.type,
                                )}</span>
                                <div class="info-content">
                                    <span class="info-label">Type</span>
                                    <span class="info-value">${dest.type}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="popup-footer">
                            <p>Click outside to close</p>
                        </div>
                    </div>
                `;
            } else {
                popupContent = `
                    <div class="popup-container mobile-popup">
                        <div class="popup-header">
                            <div class="popup-icon" style="background: ${getIconColor(
                                dest.icon,
                            )}">
                                ${getIconSymbol(dest.icon)}
                            </div>
                            <div class="popup-title">
                                <h3>${dest.name}</h3>
                                <p>${island} Island</p>
                            </div>
                        </div>
                        
                        <div class="popup-info">
                            <div class="info-row">
                                <span class="info-label">Province:</span>
                                <span class="info-value">${dest.province}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Type:</span>
                                <span class="info-value">${dest.type}</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Priority:</span>
                                <span class="info-value">
                                    ${
                                        dest.priority === 1
                                            ? "High"
                                            : dest.priority === 2
                                              ? "Medium"
                                              : "Low"
                                    }
                                </span>
                            </div>
                        </div>
                        
                        <div class="popup-footer">
                            <p>Tap outside to close</p>
                        </div>
                    </div>
                `;
            }

            marker.bindPopup(popupContent, {
                maxWidth: cfg.isMobile ? 280 : cfg.isDesktop ? 320 : 300,
                className: "custom-popup",
            });
            markers.push(marker);
        });
    }

    function createMarkerCluster() {
        const cfg = getMapConfig();
        return L.markerClusterGroup({
            maxClusterRadius: function (zoom) {
                return cfg.isMobile ? 50 : 60;
            },
            iconCreateFunction: function (cluster) {
                const count = cluster.getChildCount();
                const cfg = getMapConfig();
                const size = cfg.isMobile ? 35 : 40;

                return L.divIcon({
                    html: `<div style="
                        width: ${size}px;
                        height: ${size}px;
                        background: #3B82F6;
                        border-radius: 50%;
                        border: 3px solid white;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-weight: bold;
                        font-size: ${cfg.isMobile ? "12px" : "14px"};
                        box-shadow: 0 2px 5px rgba(0,0,0,0.3);
                    ">${count}</div>`,
                    className: "custom-cluster",
                    iconSize: [size, size],
                });
            },
            disableClusteringAtZoom: 7,
        });
    }

    function debounce(fn, wait = 150) {
        let t;
        return (...args) => {
            clearTimeout(t);
            t = setTimeout(() => fn.apply(this, args), wait);
        };
    }

    window.addEventListener(
        "resize",
        debounce(() => {
            const cfg = getMapConfig();

            const mapElement = document.getElementById("map");
            if (cfg.isMobile) {
                mapElement.style.height = `${cfg.height * 0.7}px`;
            } else if (cfg.isTablet) {
                mapElement.style.height = `${cfg.height * 0.8}px`;
            } else {
                mapElement.style.height = `${cfg.height * 0.9}px`;
            }

            map.setMinZoom(cfg.minZoom);
            map.setMaxZoom(cfg.maxZoom);

            if (cfg.isDesktop) {
                map.dragging.disable();
                map.touchZoom.disable();
                map.scrollWheelZoom.disable();
                map.doubleClickZoom.disable();
                map.boxZoom.disable();
                map.keyboard.disable();
                map.tap.disable();

                if (markerCluster) {
                    map.removeLayer(markerCluster);
                    markerCluster = null;
                }

                addDestinationMarkers(map);
            } else {
                map.dragging.enable();
                map.touchZoom.enable();
                map.scrollWheelZoom.enable();
                map.doubleClickZoom.enable();

                if (!markerCluster) {
                    markerCluster = createMarkerCluster();
                }

                markers.forEach((marker) => map.removeLayer(marker));
                markers = [];

                const filteredDestinations = getFilteredDestinations();
                filteredDestinations.forEach((dest) => {
                    const marker = L.marker(dest.latlng, {
                        icon: getDestinationIcon(
                            dest.icon,
                            cfg.isMobile,
                            false,
                        ),
                        title: dest.name,
                    });

                    const popupContent = `
                        <div class="popup-container cluster-popup">
                            <div class="popup-header">
                                <div class="popup-icon" style="background: ${getIconColor(
                                    dest.icon,
                                )}">
                                    ${getIconSymbol(dest.icon)}
                                </div>
                                <div class="popup-title">
                                    <h3>${dest.name}</h3>
                                    <p>${getIslandByCoordinates(
                                        dest.latlng[0],
                                        dest.latlng[1],
                                    )}</p>
                                </div>
                            </div>
                            <div class="popup-info">
                                <div class="info-row">
                                    <span class="info-label">Province:</span>
                                    <span class="info-value">${
                                        dest.province
                                    }</span>
                                </div>
                                <div class="info-row">
                                    <span class="info-label">Type:</span>
                                    <span class="info-value">${dest.type}</span>
                                </div>
                            </div>
                        </div>
                    `;

                    marker.bindPopup(popupContent, {
                        className: "cluster-custom-popup",
                    });
                    markerCluster.addLayer(marker);
                });

                map.addLayer(markerCluster);
            }

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

            map.invalidateSize();
        }, 200),
    );

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

            addDestinationMarkers(map);
        }, 500);
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

        const cfg = getMapConfig();
        const modal = document.createElement("div");
        modal.id = "dynamicModal";
        modal.className =
            "fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-[9999] opacity-0 scale-95 transition-all duration-300 ease-out px-4 py-6 overflow-y-auto";

        modal.innerHTML = `
    <div id="modalContent"
        class="relative bg-white rounded-2xl w-full max-w-2xl md:max-w-3xl lg:max-w-4xl shadow-2xl transform scale-95 transition-all duration-300 ease-out overflow-hidden max-h-[calc(100vh-48px)] flex flex-col my-auto">

        <!-- Tombol Close -->
        <button id="closeModal"
            class="absolute top-3 right-3 md:top-4 md:right-4 z-50 text-gray-700 hover:text-gray-900 bg-white/90 hover:bg-white rounded-full w-8 h-8 md:w-10 md:h-10 flex items-center justify-center text-xl md:text-2xl font-bold transition-all hover:scale-110 shadow-md border border-gray-200">
            &times;
        </button>

        <!-- Header dengan Gambar -->
        <div class="relative flex-shrink-0">
            <img src="${data.image}" alt="${data.name_en}"
                class="w-full h-48 md:h-56 lg:h-64 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-4 md:p-6 text-white">
                <div class="flex items-center mb-2">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center mr-3">
                        <span class="text-white text-lg md:text-xl">🗺️</span>
                    </div>
                    <div>
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold mb-1 drop-shadow-lg">${
                            data.name_en
                        }</h2>
                        <p class="text-sm md:text-base opacity-90 drop-shadow font-medium">Experience Travel in Indonesia</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Konten Utama - PERBAIKAN DI SINI -->
        <div class="flex-1 overflow-y-auto p-4 md:p-6 lg:p-8 scroll-smooth" style="scrollbar-width: thin; scrollbar-color: #cbd5e1 #f1f5f9;">
            <!-- Section INTERACTIVE MAP -->
            <div class="mb-6 md:mb-8">
                <div class="flex items-center mb-3">
                    <div class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-blue-50 flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg md:text-xl font-semibold text-gray-800">INTERACTIVE MAP</h3>
                        <h4 class="text-xl md:text-2xl font-bold text-gray-900 mt-1">Explore Indonesia's Beauty</h4>
                    </div>
                </div>
                
                <div class="bg-gray-50 rounded-xl p-4 md:p-5 border border-gray-100">
                    <p class="text-gray-700 leading-relaxed text-sm md:text-base">
                        ${
                            data.description ||
                            "Discover the timeless charm of Indonesia through our interactive map. From tropical beaches to misty highlands, each island offers unique experiences waiting for your exploration."
                        }
                    </p>
                </div>
            </div>

            <!-- Section Informasi -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                <!-- Card Location -->
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 md:p-5 border border-blue-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-start">
                        <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white flex items-center justify-center mr-3 md:mr-4 shadow-sm">
                            <span class="text-blue-600 text-xl md:text-2xl">📍</span>
                        </div>
                        <div class="flex-1">
                            <h5 class="font-bold text-gray-800 text-base md:text-lg mb-1">Location</h5>
                            <p class="text-gray-600 text-sm md:text-base font-medium">${
                                data.name_en || data.id
                            }</p>
                            <div class="mt-2 pt-2 border-t border-blue-200">
                                <span class="text-xs text-blue-600 font-semibold uppercase tracking-wide">Island Destination</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Province -->
                <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 md:p-5 border border-green-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-start">
                        <div class="w-12 h-12 md:w-14 md:h-14 rounded-full bg-white flex items-center justify-center mr-3 md:mr-4 shadow-sm">
                            <span class="text-green-600 text-xl md:text-2xl">🏛️</span>
                        </div>
                        <div class="flex-1">
                            <h5 class="font-bold text-gray-800 text-base md:text-lg mb-1">Province</h5>
                            <p class="text-gray-600 text-sm md:text-base font-medium">${
                                data.name_en || "Indonesia"
                            }</p>
                            <div class="mt-2 pt-2 border-t border-green-200">
                                <span class="text-xs text-green-600 font-semibold uppercase tracking-wide">Administrative Region</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Additional Info jika ada -->
                ${
                    data.population || data.area
                        ? `
                <div class="md:col-span-2 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-4 md:p-5 border border-purple-200 shadow-sm hover:shadow-md transition-shadow duration-300">
                    <div class="grid grid-cols-2 gap-4">
                        ${
                            data.population
                                ? `
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3 shadow-sm">
                                <span class="text-purple-600 text-lg">👥</span>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-700 text-sm">Population</h6>
                                <p class="text-gray-600 text-sm font-medium">${formatNumber(
                                    data.population,
                                )}</p>
                            </div>
                        </div>
                        `
                                : ""
                        }
                        ${
                            data.area
                                ? `
                        <div class="flex items-center">
                            <div class="w-10 h-10 rounded-full bg-white flex items-center justify-center mr-3 shadow-sm">
                                <span class="text-purple-600 text-lg">📐</span>
                            </div>
                            <div>
                                <h6 class="font-semibold text-gray-700 text-sm">Area</h6>
                                <p class="text-gray-600 text-sm font-medium">${formatArea(
                                    data.area,
                                )}</p>
                            </div>
                        </div>
                        `
                                : ""
                        }
                    </div>
                </div>
                `
                        : ""
                }
            </div>

            <!-- Section CTA Button -->
            <div class="border-t border-gray-200 pt-4 md:pt-6">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-center md:text-left">
                        <p class="text-gray-600 text-sm md:text-base">
                            Ready to explore more about <span class="font-semibold text-blue-700">${
                                data.name_en
                            }</span>?
                        </p>
                        <p class="text-gray-500 text-xs md:text-sm mt-1">
                            Click below to discover detailed information
                        </p>
                    </div>
                    <button onclick="window.location.href='/Province/${encodeURIComponent(
                        data.name_en,
                    )}'"
                        class="group relative bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900 text-white font-semibold px-6 py-3 md:px-8 md:py-3.5 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-out text-sm md:text-base min-w-[140px]">
                        <span class="flex items-center justify-center">
                            Learn More
                            <svg class="w-4 h-4 md:w-5 md:h-5 ml-2 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 rounded-xl border-2 border-blue-400/30 group-hover:border-blue-400/50 transition-colors duration-300"></div>
                    </button>
                </div>
                
                <!-- Disclaimer -->
                <div class="mt-4 pt-4 border-t border-gray-100">
                    <p class="text-gray-500 text-xs text-center">
                        All information is based on official tourism data. Click the close button or outside the modal to exit.
                    </p>
                </div>
            </div>
        </div>
    </div>
`;

        // Tambahkan CSS khusus untuk scroll
        const scrollStyle = document.createElement("style");
        scrollStyle.textContent = `
    #dynamicModal {
        overscroll-behavior: contain;
    }
    
    #dynamicModal .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    
    #dynamicModal .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    #dynamicModal .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    #dynamicModal .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    
    /* Pastikan modal bisa discroll */
    @media (max-height: 700px) {
        #modalContent {
            max-height: calc(100vh - 24px) !important;
        }
    }
`;
        document.head.appendChild(scrollStyle);

        document.body.appendChild(modal);

        // Event listener untuk mengatasi event bubbling
        const closeModalBtn = modal.querySelector("#closeModal");
        const modalContent = modal.querySelector("#modalContent");

        // Fungsi untuk mencegah event bubbling
        function stopPropagation(e) {
            e.stopPropagation();
        }

        // Tambahkan event listener untuk mencegah closing saat konten di-scroll
        modalContent.addEventListener("wheel", stopPropagation);
        modalContent.addEventListener("touchmove", stopPropagation);

        setTimeout(() => {
            modal.classList.remove("opacity-0", "scale-95");
            modal.classList.add("opacity-100", "scale-100");
            modalContent.classList.remove("scale-95");
            modalContent.classList.add("scale-100");

            // Force reflow untuk memastikan scroll bekerja
            modalContent.offsetHeight;
        }, 10);

        function closeModal() {
            modal.classList.remove("opacity-100", "scale-100");
            modal.classList.add("opacity-0", "scale-95");
            setTimeout(() => {
                modal.remove();
                // Hapus style yang ditambahkan
                scrollStyle.remove();
            }, 300);
        }

        closeModalBtn.addEventListener("click", closeModal);

        modal.addEventListener("click", (e) => {
            if (e.target === modal) closeModal();
        });

        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") closeModal();
        });

        // Fungsi utilitas
        function formatNumber(num) {
            if (!num) return "N/A";
            return new Intl.NumberFormat("en-US").format(num);
        }

        function formatArea(area) {
            if (!area) return "N/A";
            if (area > 1000) {
                return `${(area / 1000).toFixed(1)}k km²`;
            }
            return `${area} km²`;
        }

        document.body.appendChild(modal);

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
        "https://raw.githubusercontent.com/superpikar/indonesia-geojson/master/indonesia.geojson",
    )
        .then((res) => res.json())
        .then((data) => {
            var geojsonLayer = L.geoJSON(data, {
                style: {
                    color: "#1c1c1c",
                    weight: 0.4,
                    fillColor: "#60a5fa",
                    fillOpacity: 0.6,
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
                                fillOpacity: 0.8,
                            });
                            e.target.bringToFront();
                        },
                        mouseout: (e) => geojsonLayer.resetStyle(e.target),
                        click: (e) => {
                            const data = provinceData.find(
                                (p) =>
                                    p.id.toLowerCase() ===
                                    englishName.toLowerCase(),
                            );
                            if (data) showModal(data);
                            else alert("No data found for " + englishName);
                        },
                    });
                },
            }).addTo(map);

            addDestinationMarkers(map);

            const cfg = getMapConfig();
            if (!cfg.isDesktop) {
                markerCluster = createMarkerCluster();
                markers.forEach((marker) => markerCluster.addLayer(marker));
                map.addLayer(markerCluster);
            }

            geojsonLayer.eachLayer((layer) => {
                layer.bringToBack();
            });

            map.fitBounds(geojsonLayer.getBounds());
            map.setMaxBounds(geojsonLayer.getBounds());
            map.options.maxBoundsViscosity = 0.5;
        })
        .catch((err) => console.error("❌ Failed to load GeoJSON:", err));

    window.navigateToDestination = function (destinationName) {
        let targetDest = null;
        Object.keys(destinationsByIsland).forEach((island) => {
            const dest = destinationsByIsland[island].find(
                (d) => d.name === destinationName,
            );
            if (dest) targetDest = dest;
        });

        if (targetDest) {
            const cfg = getMapConfig();
            const zoomLevel = cfg.isDesktop ? 7 : 8;
            map.setView(targetDest.latlng, zoomLevel);

            setTimeout(() => {
                markers.forEach((marker) => {
                    const latLng = marker.getLatLng();
                    if (
                        Math.abs(latLng.lat - targetDest.latlng[0]) < 0.01 &&
                        Math.abs(latLng.lng - targetDest.latlng[1]) < 0.01
                    ) {
                        marker.openPopup();
                    }
                });
            }, 300);
        }
    };

    // Tambahkan CSS untuk popup responsif
    const style = document.createElement("style");
    style.textContent = `
        .custom-marker {
            background: transparent !important;
            border: none !important;
        }
        
        .custom-cluster {
            background: transparent !important;
        }
        
        .leaflet-tooltip {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 12px;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            backdrop-filter: blur(4px);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .leaflet-popup-content {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .custom-popup .leaflet-popup-content-wrapper,
        .cluster-custom-popup .leaflet-popup-content-wrapper {
            padding: 0 !important;
            border-radius: 12px !important;
            overflow: hidden !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15) !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }
        
        .popup-container {
            width: 100%;
            max-width: 90vw;
            min-width: unset;
        }
        
        .popup-header {
            display: flex;
            align-items: center;
            padding: 16px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
        }
        
        .popup-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 24px;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        .popup-title h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            line-height: 1.3;
        }
        
        .popup-title p {
            margin: 4px 0 0 0;
            font-size: 13px;
            opacity: 0.9;
            font-weight: 500;
        }
        
        .popup-info {
            padding: 16px;
            background: #f8fafc;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            padding: 10px;
            background: white;
            border-radius: 8px;
            margin-bottom: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .info-item:last-child {
            margin-bottom: 0;
        }
        
        .info-icon {
            font-size: 20px;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            border-radius: 8px;
            margin-right: 12px;
            flex-shrink: 0;
        }
        
        .info-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .info-label {
            font-size: 11px;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }
        
        .info-value {
            font-size: 14px;
            color: #1e293b;
            font-weight: 600;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .info-row:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .popup-footer {
            padding: 12px 16px;
            text-align: center;
            background: white;
            border-top: 1px solid #e2e8f0;
        }
        
        .popup-footer p {
            margin: 0;
            font-size: 11px;
            color: #94a3b8;
            font-style: italic;
        }
        
        @media (max-width: 480px) {
            .popup-container {
                min-width: 200px;
            }
            
            .popup-header {
                padding: 12px;
            }
            
            .popup-icon {
                width: 40px;
                height: 40px;
                font-size: 20px;
            }
            
            .popup-title h3 {
                font-size: 16px;
            }
            
            .popup-title p {
                font-size: 12px;
            }
            
            .popup-info {
                padding: 12px;
            }
            
            .info-item {
                padding: 8px;
            }
            
            .info-icon {
                width: 20px;
                height: 20px;
                font-size: 18px;
            }
            
            .info-label {
                font-size: 10px;
            }
            
            .info-value {
                font-size: 13px;
            }
        }
        
        @media (min-width: 481px) and (max-width: 767px) {
            .popup-container {
                min-width: 260px;
            }
        }
        
        @media (min-width: 768px) and (max-width: 1023px) {
            .popup-container {
                min-width: 280px;
            }
            
            .popup-header {
                padding: 18px;
            }
            
            .popup-title h3 {
                font-size: 20px;
            }
        }
        
        @media (min-width: 1024px) {
            .popup-container {
                min-width: 320px;
            }
            
            .popup-header {
                padding: 20px;
            }
            
            .popup-title h3 {
                font-size: 22px;
            }
            
            .popup-title p {
                font-size: 14px;
            }
            
            .info-value {
                font-size: 15px;
            }
        }
        
        .leaflet-control-zoom {
            border: none !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
        }
        
        .leaflet-control-zoom a {
            background: white !important;
            color: #333 !important;
            border: none !important;
            border-radius: 6px !important;
            margin: 4px !important;
            width: 20px !important;
            height: 20px !important;
            line-height: 32px !important;
        }
        
        .leaflet-control-zoom a:hover {
            background: #f0f0f0 !important;
        }
        
        .desktop-locked-map {
            cursor: default !important;
        }
        
        .desktop-locked-map .leaflet-marker-icon {
            cursor: pointer !important;
        }
        
        @keyframes popupFadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .custom-popup .leaflet-popup-content-wrapper,
        .cluster-custom-popup .leaflet-popup-content-wrapper {
            animation: popupFadeIn 0.3s ease-out;
        }
        
        .leaflet-popup-close-button {
            width: 28px !important;
            height: 28px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            background: rgba(255, 255, 255, 0.9) !important;
            border-radius: 50% !important;
            color: #333 !important;
            font-size: 20px !important;
            font-weight: bold !important;
            transition: all 0.2s !important;
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
            top: 8px !important;
            right: 8px !important;
        }
        
        .leaflet-popup-close-button:hover {
            background: white !important;
            color: #000 !important;
            transform: scale(1.1);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .custom-popup .leaflet-popup-tip,
        .cluster-custom-popup .leaflet-popup-tip {
            background: white !important;
            box-shadow: 0 3px 14px rgba(0, 0, 0, 0.15) !important;
        }

        .leaflet-pane,
        .leaflet-top,
        .leaflet-bottom {
            z-index: 400 !important;
        }

        .leaflet-popup {
            z-index: 9999 !important;
        }

        .leaflet-tooltip {
            z-index: 10000 !important;
        }

    `;
    document.head.appendChild(style);

    const cfg = getMapConfig();
    if (cfg.isDesktop) {
        map.getContainer().classList.add("desktop-locked-map");
    }
});
