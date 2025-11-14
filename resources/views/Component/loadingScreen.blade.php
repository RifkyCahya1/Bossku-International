<div id="full-loader" role="status" aria-live="polite"
    style="position:fixed;inset:0;z-index:9999;background:#0b0b0b;display:flex;align-items:center;justify-content:center;overflow:hidden;box-sizing:border-box;padding:4vh 6vw;">
    <div style="text-align:center;color:#D6C7A1;padding:2.5vh 3vw;max-width:960px;width:100%;box-sizing:border-box;border-radius:12px;backdrop-filter: blur(4px);-webkit-backdrop-filter: blur(4px);">
        <div style="font-size:clamp(18px,3.5vw,48px);letter-spacing:.18em;font-weight:300;text-transform:uppercase;margin-bottom:0.5rem;opacity:0;animation:bs-fadeUp 1.4s ease forwards 0.4s;line-height:1;">
            Bossku Travel
        </div>
        <div style="color:#89A1B2;margin:0.75rem auto 1rem;font-size:clamp(12px,2.2vw,16px);opacity:0;animation:bs-fadeUp 1.4s ease forwards 1.2s;max-width:min(36rem,92%);">
            Welcome aboard. Your exquisite journey begins here.
        </div>
        <div aria-hidden="true" class="orbit-loader" style="margin:0 auto 0.5rem;"></div>
    </div>

    <style>
        :root {
            --ring-size: clamp(40px, 9.5vw, 88px);
            --ring-border: 1.6px;
            --accent-1: #D6C7A1;
            --accent-2: #89A1B2;
            --bg-fade: rgba(11, 11, 11, 0.95);
        }

        /* container transition + hidden state */
        #full-loader {
            transition: opacity 0.9s ease, visibility 0.9s ease, transform 0.9s ease;
            will-change: opacity, visibility, transform;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        #full-loader.bs-hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateY(-6px);
        }

        .orbit-loader {
            position: relative;
            width: var(--ring-size);
            height: var(--ring-size);
            opacity: 0;
            animation: bs-fadeIn 0.75s ease forwards 1.8s;
            filter: drop-shadow(0 0 10px rgba(214, 199, 161, 0.18));
            box-sizing: border-box;
        }

        .orbit-loader .ring {
            position: absolute;
            inset: 0;
            border-radius: 50%;
            border: var(--ring-border) solid rgba(214, 199, 161, 0.12);
            border-top-color: var(--accent-1);
            border-right-color: rgba(214, 199, 161, 0.28);
            box-sizing: border-box;
            animation: bs-spinOuter 3.6s cubic-bezier(0.55, 0.25, 0.35, 1) infinite;
        }

        .orbit-loader .ring.inner {
            inset: calc(var(--ring-size) * 0.09);
            border: var(--ring-border) solid rgba(137, 161, 178, 0.22);
            border-top-color: var(--accent-2);
            border-left-color: rgba(137, 161, 178, 0.38);
            animation: bs-spinInner 2.8s cubic-bezier(0.55, 0.25, 0.35, 1) infinite reverse;
            opacity: 0.9;
        }

        /* Create the two ring elements in CSS (no extra markup needed) */
        .orbit-loader::before,
        .orbit-loader::after {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: 50%;
            box-sizing: border-box;
        }

        .orbit-loader::before {
            border: var(--ring-border) solid rgba(214, 199, 161, 0.12);
            border-top-color: var(--accent-1);
            border-right-color: rgba(214, 199, 161, 0.28);
            animation: bs-spinOuter 3.6s linear infinite;
        }

        .orbit-loader::after {
            inset: calc(var(--ring-size) * 0.09);
            border: var(--ring-border) solid rgba(137, 161, 178, 0.22);
            border-top-color: var(--accent-2);
            border-left-color: rgba(137, 161, 178, 0.38);
            animation: bs-spinInner 2.8s linear infinite reverse;
            opacity: 0.9;
        }

        @keyframes bs-spinOuter {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes bs-spinInner {
            from {
                transform: rotate(360deg);
            }

            to {
                transform: rotate(0deg);
            }
        }

        @keyframes bs-fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bs-fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
                filter: blur(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
                filter: blur(0);
            }
        }

        /* Respect user preference for reduced motion */
        @media (prefers-reduced-motion: reduce) {

            .orbit-loader,
            .orbit-loader::before,
            .orbit-loader::after {
                animation: none !important;
                transform: none !important;
            }

            [style*="animation:bs-fadeUp"] {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }

            [style*="animation:bs-fadeIn"] {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
            }
        }

        /* Small screens adjustments */
        @media (max-width:480px) {
            :root {
                --ring-border: 1.2px;
            }

            .orbit-loader {
                margin-top: 8px;
            }
        }

        /* Medium screens fine tuning */
        @media (min-width:1200px) {
            :root {
                --ring-size: clamp(52px, 6.5vw, 96px);
            }
        }
    </style>

    <script>
        (function() {
            const loader = document.getElementById('full-loader');

            function hideLoader() {
                if (!loader) return;
                loader.classList.add('bs-hidden');
                setTimeout(() => loader?.parentNode?.removeChild(loader), 1000);
            }

            // Tampilkan selama ±4.5 detik total
            if (document.readyState === 'complete') {
                setTimeout(hideLoader, 4000);
            } else {
                window.addEventListener('load', () => setTimeout(hideLoader, 4000));
            }

            // Safety fallback
            setTimeout(hideLoader, 4500);
        })();
    </script>
</div>