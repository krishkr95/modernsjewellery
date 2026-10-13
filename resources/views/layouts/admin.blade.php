<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="min-h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
    <title>{{ $title ?? 'Modern Jewellery House - Haute Joaillerie Management' }}</title>

    <!-- Theme FOUC Prevention -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js & Chart.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Admin 3D & 360 Studio Alpine Component Helper -->
    <script>
        window.rmjAdminStudio = function(config) {
            return {
                enabled3d: Boolean(config.enabled3d),
                modelUrl: config.modelUrl || '',
                autorotate: config.autorotate !== undefined ? config.autorotate : true,
                speed: config.speed || 'slow',
                showColors: config.showColors !== undefined ? config.showColors : true,
                defaultColor: config.defaultColor || 'yellow',
                bgColor: config.bgColor || '#0d0d0f',
                smoothness: config.smoothness || 'ultra',
                showPreview: false,
                fileName: '',
                get isRmj() {
                    return Boolean(this.modelUrl && (this.modelUrl.indexOf('rendermyjewelry.com') !== -1 || this.modelUrl.indexOf('rendermyjewelry') !== -1));
                },
                get previewSrc() {
                    if (!this.modelUrl) return '';
                    const match = this.modelUrl.match(/src=["']([^"']+)["']/i);
                    return match ? match[1] : this.modelUrl;
                },
                onInputCode() {
                    if (this.modelUrl && this.modelUrl.trim().length > 0) {
                        this.enabled3d = true;
                    }
                },
                onFileSelected(e) {
                    if (e && e.target && e.target.files && e.target.files.length > 0) {
                        this.fileName = e.target.files[0].name;
                        this.enabled3d = true;
                    }
                }
            };
        };
    </script>

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        html {
            min-height: 100%;
            height: auto;
            background-color: #EEF2F6;
            color: #0F172A;
        }

        html.dark {
            background-color: #0B0F19;
            color: #F8FAFC;
        }

        body {
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: #EEF2F6;
            color: #0F172A;
            min-height: 100vh;
            height: auto;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            transition: background-color 0.25s ease, color 0.25s ease;
            overflow-x: hidden;
        }

        html.dark body {
            background-color: #0B0F19;
            color: #F8FAFC;
        }

        .admin-shell, .admin-main {
            background-color: #EEF2F6 !important;
        }
        html.dark .admin-shell, html.dark .admin-main {
            background-color: #0B0F19 !important;
        }

        /* Luxury Tabular Numbers Utility */
        .tnum {
            font-variant-numeric: tabular-nums;
            font-feature-settings: 'tnum';
            letter-spacing: -0.01em;
        }

        /* ================= BULLETPROOF GRID SYSTEM ================= */
        .grid { display: grid !important; }
        .grid-cols-1 { grid-template-columns: repeat(1, minmax(0, 1fr)) !important; }
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
        .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; }
        .grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        .grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)) !important; }

        @media (min-width: 640px) {
            .sm\:grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
            .sm\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)) !important; }
            .sm\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
        }

        @media (min-width: 1024px) {
            .lg\:grid-cols-12 { grid-template-columns: repeat(12, minmax(0, 1fr)) !important; }
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)) !important; }
            .lg\:col-span-4 { grid-column: span 4 / span 4 !important; }
            .lg\:col-span-8 { grid-column: span 8 / span 8 !important; }
            .lg\:col-span-12 { grid-column: span 12 / span 12 !important; }
        }

        /* Dashboard Custom Named Grids */
        .dash-kpi-grid {
            display: grid !important;
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 12px !important;
        }
        @media (min-width: 640px) {
            .dash-kpi-grid {
                gap: 16px !important;
            }
        }
        @media (min-width: 1024px) {
            .dash-kpi-grid {
                grid-template-columns: repeat(4, minmax(0, 1fr)) !important;
                gap: 20px !important;
            }
        }

        .dash-row-target-stats {
            display: grid !important;
            grid-template-columns: 100% !important;
            gap: 16px !important;
            width: 100% !important;
        }
        @media (min-width: 1024px) {
            .dash-row-target-stats {
                grid-template-columns: 360px calc(100% - 380px) !important;
                gap: 20px !important;
            }
        }

        .dash-row-orders-growth {
            display: grid !important;
            grid-template-columns: 100% !important;
            gap: 16px !important;
            width: 100% !important;
        }
        @media (min-width: 1024px) {
            .dash-row-orders-growth {
                grid-template-columns: calc(100% - 440px) 420px !important;
                gap: 20px !important;
            }
        }
        @media (min-width: 1280px) {
            .dash-row-orders-growth {
                grid-template-columns: calc(100% - 480px) 460px !important;
                gap: 24px !important;
            }
        }

        /* ================= NEUMORPHISM DESIGN SYSTEM ================= */

        /* 1. Shell & Main Layout */
        .admin-shell {
            display: flex;
            flex-direction: row;
            min-height: 100vh;
            position: relative;
            width: 100%;
            overflow-x: hidden;
        }

        /* 2. Neumorphic Sidebar */
        .admin-sidebar {
            width: 270px;
            min-width: 270px;
            flex-shrink: 0;
            background: #F0F4F8;
            box-shadow: 6px 0 20px rgba(166, 175, 195, 0.28);
            border-right: 1px solid rgba(255, 255, 255, 0.7);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            z-index: 50;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.25s ease;
        }

        html.dark .admin-sidebar {
            background: #0E1422 !important;
            box-shadow: 8px 0 24px rgba(0, 0, 0, 0.75);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }

        @media (max-width: 1023px) {
            .admin-sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                transform: translateX(-100%);
                z-index: 100;
                box-shadow: 10px 0 32px rgba(0,0,0,0.45);
            }
            .admin-sidebar.mobile-open {
                transform: translateX(0);
            }
        }

        /* Sidebar backdrop overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 90;
            background: rgba(11, 15, 25, 0.65);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
        .sidebar-overlay.visible { display: block; }

        /* Main content area */
        .admin-main {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        /* 3. Header */
        .admin-header {
            height: 70px;
            background: #EEF2F6;
            border-bottom: 1px solid rgba(226, 232, 240, 0.8);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 40;
            transition: background-color 0.25s ease, border-color 0.25s ease;
        }

        @media (max-width: 640px) {
            .admin-header {
                height: 64px;
                padding: 0 14px;
            }
        }

        html.dark .admin-header {
            background: #0B0F19 !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        /* 4. Extruded Neumorphic Cards (Refined Light & Dark) */
        .kpi-card, .content-card, .neu-card {
            background: #F4F7FB !important;
            border-radius: 20px !important;
            border: 1px solid rgba(255, 255, 255, 0.85) !important;
            box-shadow: 6px 6px 16px rgba(166, 175, 195, 0.32), -6px -6px 16px #FFFFFF !important;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.25s ease;
            position: relative;
        }

        @media (max-width: 640px) {
            .kpi-card, .content-card, .neu-card {
                border-radius: 16px !important;
                box-shadow: 4px 4px 12px rgba(166, 175, 195, 0.26), -4px -4px 12px #FFFFFF !important;
            }
        }

        html.dark .kpi-card, 
        html.dark .content-card, 
        html.dark .neu-card {
            background: #141C2B !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 6px 6px 20px rgba(0, 0, 0, 0.65), -3px -3px 12px rgba(255, 255, 255, 0.025) !important;
        }

        @media (max-width: 640px) {
            html.dark .kpi-card, html.dark .content-card, html.dark .neu-card {
                box-shadow: 4px 4px 14px rgba(0, 0, 0, 0.7), -2px -2px 8px rgba(255, 255, 255, 0.02) !important;
            }
        }

        /* Automatic styling for legacy admin containers */
        .admin-main .rounded-xl.border:not(.no-neu), 
        .admin-main .rounded-2xl.border:not(.no-neu),
        .admin-main .rounded-3xl.border:not(.no-neu) {
            background: #F4F7FB !important;
            border-radius: 20px !important;
            border: 1px solid rgba(255, 255, 255, 0.85) !important;
            box-shadow: 6px 6px 16px rgba(166, 175, 195, 0.32), -6px -6px 16px #FFFFFF !important;
        }
        html.dark .admin-main .rounded-xl.border:not(.no-neu), 
        html.dark .admin-main .rounded-2xl.border:not(.no-neu),
        html.dark .admin-main .rounded-3xl.border:not(.no-neu) {
            background: #141C2B !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 6px 6px 20px rgba(0, 0, 0, 0.65), -3px -3px 12px rgba(255, 255, 255, 0.025) !important;
        }

        /* 5. Inset Neumorphic Input Wells */
        .sub-input,
        .admin-main input[type="text"],
        .admin-main input[type="email"],
        .admin-main input[type="password"],
        .admin-main input[type="number"],
        .admin-main input[type="url"],
        .admin-main input[type="date"],
        .admin-main select,
        .admin-main textarea {
            background: #EDF2F7 !important;
            border: 1px solid rgba(255, 255, 255, 0.9) !important;
            border-radius: 12px !important;
            box-shadow: inset 3px 3px 6px rgba(166, 175, 195, 0.45), inset -3px -3px 6px #FFFFFF !important;
            color: #1E293B !important;
            font-family: inherit;
            transition: all 0.2s ease;
        }
        .sub-input:focus,
        .admin-main input[type="text"]:focus,
        .admin-main select:focus,
        .admin-main textarea:focus {
            border-color: #DFB76C !important;
            box-shadow: inset 3px 3px 6px rgba(166, 175, 195, 0.45), inset -3px -3px 6px #FFFFFF, 0 0 0 2px rgba(223, 183, 108, 0.25) !important;
            outline: none !important;
        }

        html.dark .sub-input,
        html.dark .admin-main input[type="text"],
        html.dark .admin-main input[type="email"],
        html.dark .admin-main input[type="password"],
        html.dark .admin-main input[type="number"],
        html.dark .admin-main input[type="url"],
        html.dark .admin-main input[type="date"],
        html.dark .admin-main select,
        html.dark .admin-main textarea {
            background: #0B0F19 !important;
            border: 1px solid rgba(255, 255, 255, 0.09) !important;
            box-shadow: inset 2px 2px 6px rgba(0, 0, 0, 0.75), inset -2px -2px 6px rgba(255, 255, 255, 0.02) !important;
            color: #F8FAFC !important;
        }
        html.dark .sub-input:focus,
        html.dark .admin-main input[type="text"]:focus,
        html.dark .admin-main select:focus,
        html.dark .admin-main textarea:focus {
            border-color: #D4AF37 !important;
            box-shadow: inset 2px 2px 6px rgba(0, 0, 0, 0.75), inset -2px -2px 6px rgba(255, 255, 255, 0.02), 0 0 0 2px rgba(212, 175, 55, 0.3) !important;
        }

        /* 6. Neumorphic Action Buttons */
        .sub-btn, .inactive-tab-pill {
            background: #F4F7FB !important;
            border-radius: 12px !important;
            border: 1px solid rgba(255, 255, 255, 0.7) !important;
            box-shadow: 4px 4px 10px rgba(166, 175, 195, 0.35), -4px -4px 10px #FFFFFF !important;
            color: #475569 !important;
            cursor: pointer;
            transition: all 0.18s ease;
        }
        .sub-btn:hover, .inactive-tab-pill:hover {
            box-shadow: 5px 5px 12px rgba(166, 175, 195, 0.45), -5px -5px 12px #FFFFFF !important;
            color: #1E293B !important;
            transform: translateY(-1px);
        }
        .sub-btn:active, .inactive-tab-pill:active {
            box-shadow: inset 2px 2px 5px rgba(166, 175, 195, 0.45), inset -2px -2px 5px #FFFFFF !important;
            transform: translateY(0);
        }

        html.dark .sub-btn, html.dark .inactive-tab-pill {
            background: #141C2B !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, 0.6), -3px -3px 8px rgba(255, 255, 255, 0.02) !important;
            color: #CBD5E1 !important;
        }
        html.dark .sub-btn:hover, html.dark .inactive-tab-pill:hover {
            box-shadow: 5px 5px 14px rgba(0, 0, 0, 0.75), -4px -4px 10px rgba(255, 255, 255, 0.03) !important;
            color: #FFFFFF !important;
        }
        html.dark .sub-btn:active, html.dark .inactive-tab-pill:active {
            box-shadow: inset 2px 2px 6px rgba(0, 0, 0, 0.8), inset -2px -2px 6px rgba(255, 255, 255, 0.03) !important;
        }

        /* 7. Signature Gold Gradient Neumorphic Buttons & Active Pills */
        .gold-active-pill, .luxora-gold-active, .luxora-gold-pill, .btn-gold {
            background: linear-gradient(135deg, #ECC274 0%, #D4AF37 50%, #BD9226 100%) !important;
            color: #ffffff !important;
            box-shadow: 4px 4px 14px rgba(184, 134, 11, 0.38), -3px -3px 8px rgba(255, 255, 255, 0.8) !important;
            border: 1px solid rgba(255, 255, 255, 0.35) !important;
            border-radius: 999px !important;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            transition: all 0.2s ease;
        }
        .btn-gold:hover, .gold-active-pill:hover {
            box-shadow: 6px 6px 18px rgba(184, 134, 11, 0.5), -4px -4px 10px rgba(255, 255, 255, 0.9) !important;
            transform: translateY(-1px);
        }
        .btn-gold:active, .gold-active-pill:active {
            box-shadow: inset 3px 3px 8px rgba(120, 80, 5, 0.5), inset -2px -2px 6px rgba(255, 255, 255, 0.3) !important;
            transform: translateY(0);
        }

        html.dark .gold-active-pill, 
        html.dark .luxora-gold-active, 
        html.dark .luxora-gold-pill, 
        html.dark .btn-gold {
            background: linear-gradient(135deg, #DFB76C 0%, #C99C48 50%, #B8860B 100%) !important;
            box-shadow: 4px 4px 16px rgba(0, 0, 0, 0.65), 0 0 16px rgba(212, 175, 55, 0.35) !important;
            border: 1px solid rgba(212, 175, 55, 0.45) !important;
        }

        /* 8. Neumorphic Navigation Item */
        .nav-item {
            display: flex;
            align-items: center;
            padding: 9px 14px;
            border-radius: 14px;
            font-size: 0.84rem;
            font-weight: 600;
            color: #1E293B !important;
            transition: all 0.2s ease;
            text-decoration: none;
            gap: 12px;
            margin-bottom: 4px;
        }
        .nav-item:hover {
            background: #E2E8F0;
            box-shadow: 3px 3px 8px rgba(166, 175, 195, 0.3), -3px -3px 8px #FFFFFF;
            color: #0F172A !important;
            transform: translateX(2px);
        }
        html.dark .nav-item {
            color: #F1F5F9 !important;
        }
        html.dark .nav-item:hover {
            background: #1E293B !important;
            box-shadow: 3px 3px 8px rgba(0, 0, 0, 0.6), -3px -3px 8px rgba(255, 255, 255, 0.03);
            color: #FFFFFF !important;
        }

        .nav-item.active-gold {
            background: linear-gradient(135deg, #ECC274 0%, #D4AF37 50%, #BD9226 100%) !important;
            color: #ffffff !important;
            box-shadow: 4px 4px 12px rgba(184, 134, 11, 0.4), -3px -3px 8px rgba(255, 255, 255, 0.8) !important;
            border-radius: 999px !important;
        }
        html.dark .nav-item.active-gold {
            box-shadow: 4px 4px 14px rgba(0, 0, 0, 0.7), 0 0 14px rgba(212, 175, 55, 0.35) !important;
        }

        .nav-section-title {
            font-size: 0.7rem;
            font-weight: 800;
            color: #475569 !important;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 10px 14px 4px 14px;
            margin-top: 6px;
        }
        html.dark .nav-section-title {
            color: #CBD5E1 !important;
        }

        /* 9. Order Status & Channel Badges */
        .order-pill, .pill-delivered, .pill-processing, .pill-cancel, .pill-pending, .pill-shipped {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap !important;
            transition: all 0.2s ease;
        }
        .pill-delivered {
            background: #E6F8F3;
            color: #0D9488;
            border: 1px solid #A7F3D0;
        }
        .pill-processing {
            background: #FEF6E4;
            color: #D97706;
            border: 1px solid #FDE68A;
        }
        .pill-cancel {
            background: #FDECEE;
            color: #E11D48;
            border: 1px solid #FECDD3;
        }
        .pill-pending {
            background: #EEF4FF;
            color: #2563EB;
            border: 1px solid #BFDBFE;
        }
        .pill-shipped {
            background: #F5EEFD;
            color: #9333EA;
            border: 1px solid #E9D5FF;
        }

        html.dark .pill-delivered {
            background: rgba(16, 185, 129, 0.16) !important;
            color: #34D399 !important;
            border: 1px solid rgba(16, 185, 129, 0.35) !important;
        }
        html.dark .pill-processing {
            background: rgba(245, 158, 11, 0.16) !important;
            color: #FBBF24 !important;
            border: 1px solid rgba(245, 158, 11, 0.35) !important;
        }
        html.dark .pill-cancel {
            background: rgba(244, 63, 94, 0.16) !important;
            color: #FB7185 !important;
            border: 1px solid rgba(244, 63, 94, 0.35) !important;
        }
        html.dark .pill-pending {
            background: rgba(59, 130, 246, 0.16) !important;
            color: #60A5FA !important;
            border: 1px solid rgba(59, 130, 246, 0.35) !important;
        }
        html.dark .pill-shipped {
            background: rgba(168, 85, 247, 0.16) !important;
            color: #C084FC !important;
            border: 1px solid rgba(168, 85, 247, 0.35) !important;
        }

        /* 10. Table Enhancements */
        .table-responsive-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: 16px;
        }
        .admin-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
        }
        .admin-table th {
            padding: 12px 14px;
            font-size: 0.72rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #1E293B !important;
            border-bottom: 2px solid #CBD5E1;
            background: transparent;
            white-space: nowrap;
        }
        html.dark .admin-table th {
            color: #F1F5F9 !important;
            border-bottom: 2px solid rgba(255, 255, 255, 0.12);
        }
        .admin-table td {
            padding: 13px 14px;
            border-bottom: 1px solid #E2E8F0;
            font-size: 0.82rem;
            color: #0F172A;
            vertical-align: middle;
            transition: background 0.15s ease;
        }
        html.dark .admin-table td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            color: #F8FAFC;
        }
        .admin-table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.7);
        }
        html.dark .admin-table tbody tr:hover td {
            background: rgba(255, 255, 255, 0.04);
        }
        .admin-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* ================= HIGH-CONTRAST GLOBAL READABILITY BOOSTER ================= */
        .admin-main h1, .admin-main h2, .admin-main h3, .card-title {
            color: #0F172A !important;
        }
        html.dark .admin-main h1,
        html.dark .admin-main h2,
        html.dark .admin-main h3,
        html.dark .card-title {
            color: #FFFFFF !important;
        }

        .admin-main .text-slate-900,
        .admin-main .text-slate-800,
        .admin-main .text-slate-700 {
            color: #0F172A !important;
        }
        html.dark .admin-main .text-slate-900,
        html.dark .admin-main .text-slate-800,
        html.dark .admin-main .text-slate-700 {
            color: #F8FAFC !important;
        }

        .admin-main .text-slate-600 {
            color: #1E293B !important;
        }
        html.dark .admin-main .text-slate-600 {
            color: #E2E8F0 !important;
        }

        .admin-main .text-slate-500 {
            color: #334155 !important;
        }
        html.dark .admin-main .text-slate-500 {
            color: #CBD5E1 !important;
        }

        .admin-main .text-slate-400 {
            color: #475569 !important;
        }
        html.dark .admin-main .text-slate-400 {
            color: #CBD5E1 !important;
        }

        /* Ensure labels are crystal clear */
        .admin-main label {
            color: #1E293B !important;
            font-weight: 700 !important;
        }
        html.dark .admin-main label {
            color: #F1F5F9 !important;
        }

        /* Neutralize washed-out inline colors */
        .admin-main [style*="color:#94A3B8"],
        .admin-main [style*="color: #94A3B8"] {
            color: #475569 !important;
        }
        .admin-main [style*="color:#64748B"],
        .admin-main [style*="color: #64748B"] {
            color: #1E293B !important;
        }

        html.dark .admin-main [style*="color:#94A3B8"],
        html.dark .admin-main [style*="color: #94A3B8"],
        html.dark .admin-main [style*="color:#64748B"],
        html.dark .admin-main [style*="color: #64748B"] {
            color: #CBD5E1 !important;
        }

        html.dark .admin-main [style*="color:#1E293B"],
        html.dark .admin-main [style*="color: #1E293B"],
        html.dark .admin-main [style*="color:#0F172A"],
        html.dark .admin-main [style*="color: #0F172A"] {
            color: #FFFFFF !important;
        }

        /* Input text & placeholder */
        .sub-input,
        .admin-main input,
        .admin-main select,
        .admin-main textarea {
            color: #0F172A !important;
            font-weight: 500;
        }
        html.dark .sub-input,
        html.dark .admin-main input,
        html.dark .admin-main select,
        html.dark .admin-main textarea {
            color: #FFFFFF !important;
        }
        ::placeholder {
            color: #64748B !important;
            opacity: 1 !important;
        }
        html.dark ::placeholder {
            color: #94A3B8 !important;
            opacity: 1 !important;
        }

        /* KPI Card text */
        .kpi-card span.uppercase {
            color: #334155 !important;
            font-weight: 800 !important;
        }
        html.dark .kpi-card span.uppercase {
            color: #CBD5E1 !important;
            font-weight: 800 !important;
        }

        /* Target Gauge cards & sub-widgets */
        .admin-main .rounded-xl.bg-slate-100\/60,
        .admin-main [class*="bg-slate-100"] {
            background-color: #E2E8F0 !important;
        }
        html.dark .admin-main .rounded-xl.bg-slate-100\/60,
        html.dark .admin-main [class*="bg-slate-100"] {
            background-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Status tab badges */
        .sub-btn .tnum,
        a.sub-btn span.tnum,
        .inactive-tab-pill .tnum {
            background: #E2E8F0 !important;
            color: #0F172A !important;
            font-weight: 800 !important;
        }
        html.dark .sub-btn .tnum,
        html.dark a.sub-btn span.tnum,
        html.dark .inactive-tab-pill .tnum {
            background: rgba(255, 255, 255, 0.15) !important;
            color: #FFFFFF !important;
            font-weight: 800 !important;
        }

        /* Scrollbar styles */
        .scrollbar-none::-webkit-scrollbar { display: none; }
        .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body x-data="{ 
    mobileOpen: false,
    darkMode: document.documentElement.classList.contains('dark'),
    toggleDark() {
        this.darkMode = !this.darkMode;
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
            localStorage.theme = 'dark';
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.theme = 'light';
        }
        window.dispatchEvent(new CustomEvent('theme-changed', { detail: { dark: this.darkMode } }));
    }
}">

<div class="admin-shell">

    <!-- Mobile Drawer Backdrop Overlay -->
    <div class="sidebar-overlay" :class="{ 'visible': mobileOpen }" @click="mobileOpen = false"></div>

    <!-- ================= NEUMORPHIC SIDEBAR ================= -->
    <aside class="admin-sidebar" :class="{ 'mobile-open': mobileOpen }">
        
        <!-- Brand Header with Mobile Close Button -->
        <div style="height:70px;display:flex;align-items:center;justify-content:space-between;padding:0 20px;border-bottom:1px solid rgba(226,232,240,0.6);"
             class="dark:border-white/5">
            <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
                <img src="{{ asset('assets/images/logo.png') }}" 
                     alt="Modern Jewellery House Logo" 
                     style="width: 36px; height: 36px; border-radius: 999px; object-fit: cover; flex-shrink: 0; box-shadow: 0 1px 3px rgba(0,0,0,0.2); border: 1.5px solid rgba(212,175,55,0.5);">
                <div style="display:flex;flex-direction:column;line-height:1.15;">
                    <span style="font-family:'Playfair Display',serif;font-size:0.95rem;font-weight:700;letter-spacing:-0.02em;" class="text-slate-900 dark:text-white">Modern Jewellery House</span>
                    <span style="font-size:0.62rem;color:#B8860B;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;">Haute Joaillerie Atelier</span>
                </div>
            </a>
            <!-- Mobile Close Button (X) -->
            <button type="button" @click="mobileOpen = false"
                    style="display:none;width:34px;height:34px;border:none;border-radius:10px;align-items:center;justify-content:center;cursor:pointer;"
                    id="sidebar-close-btn" class="sub-btn">
                <svg width="16" height="16" fill="none" stroke="#64748B" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <style>
                @media (max-width: 1023px) { #sidebar-close-btn { display:flex !important; } }
            </style>
        </div>

        <!-- Nav Items -->
        <div style="flex:1;overflow-y:auto;padding:16px 12px;" class="sidebar-scrollable">

            <div class="nav-section-title">Operations</div>

            <!-- 1. Dashboard -->
            <a href="{{ route('admin.dashboard') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- 2. All Orders -->
            <a href="{{ route('admin.orders.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.orders*') ? 'active-gold gold-active-pill' : '' }}"
               style="justify-content:space-between;">
                <span style="display:flex;align-items:center;gap:12px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    <span>All Orders</span>
                </span>
                <span style="font-size:0.68rem;padding:2px 7px;border-radius:999px;font-weight:700;background:rgba(217,119,6,0.15);color:#D97706;">Live</span>
            </a>

            <!-- 3. Fine Jewellery Catalog (Products) -->
            <a href="{{ route('admin.products.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.products*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                <span>Haute Products</span>
            </a>

            <!-- 4. Vault Inventory -->
            <a href="{{ route('admin.inventory.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.inventory*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                <span>Vault Inventory</span>
            </a>

            <!-- 5. Patrons & Clients -->
            <a href="{{ route('admin.customers.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.customers*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>Patrons & Clients</span>
            </a>

            <div class="nav-section-title">Catalog & Privileges</div>

            <!-- 6. Collections -->
            <a href="{{ route('admin.collections.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.collections*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                <span>Curated Series</span>
            </a>

            <!-- 7. Categories -->
            <a href="{{ route('admin.categories.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.categories*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <span>Departments</span>
            </a>

            <!-- 8. Coupons -->
            <a href="{{ route('admin.coupons.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.coupons*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
                <span>Privilege Passes</span>
            </a>

            <!-- 8.5. Homepage Banners & Slider Media -->
            <a href="{{ route('admin.banners.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.banners*') ? 'active-gold gold-active-pill' : '' }}"
               style="justify-content:space-between;">
                <span style="display:flex;align-items:center;gap:12px;">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>Homepage Banners</span>
                </span>
                <span style="font-size:0.68rem;padding:2px 7px;border-radius:999px;font-weight:700;background:rgba(217,119,6,0.18);color:#B45309;">Slider</span>
            </a>

            <!-- 9. Testimonials / Reviews -->
            <a href="{{ route('admin.reviews.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.reviews*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                </svg>
                <span>Testimonials</span>
            </a>

            <div class="nav-section-title">Administration</div>

            <!-- 10. Maison Settings -->
            <a href="{{ route('admin.settings.index') }}" @click="mobileOpen = false"
               class="nav-item {{ request()->routeIs('admin.settings*') ? 'active-gold gold-active-pill' : '' }}">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <span>Maison Settings</span>
            </a>

            <!-- 11. Public Storefront -->
            <a href="{{ route('home') }}" target="_blank"
               class="nav-item">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <span>Storefront &rarr;</span>
            </a>

        </div>

        <!-- Sidebar Footer: Log Out & Dark Mode Pill -->
        <div style="padding:14px 18px;border-top:1px solid rgba(226,232,240,0.6);display:flex;align-items:center;justify-content:space-between;"
             class="dark:border-white/5">
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" style="display:flex;align-items:center;gap:8px;background:none;border:none;cursor:pointer;font-size:0.82rem;font-weight:600;color:#64748B;" class="dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Sign Out</span>
                </button>
            </form>

            <!-- Dark Mode Switch -->
            <button type="button" @click="toggleDark()"
                    style="width:44px;height:24px;border-radius:999px;position:relative;cursor:pointer;border:none;transition:background 0.2s;"
                    :style="darkMode ? 'background:#3B82F6;' : 'background:#CBD5E1;'"
                    title="Toggle Theme">
                <span style="position:absolute;top:2px;width:20px;height:20px;border-radius:50%;background:#ffffff;box-shadow:0 1px 4px rgba(0,0,0,0.25);transition:left 0.2s;display:flex;align-items:center;justify-content:center;font-size:10px;"
                      :style="darkMode ? 'left:22px;' : 'left:2px;'">
                    <span x-show="!darkMode">☀️</span>
                    <span x-show="darkMode">🌙</span>
                </span>
            </button>
        </div>

    </aside>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="admin-main">

        <!-- Top Header -->
        <header class="admin-header">
            <!-- Left: Mobile Toggle + Brand / Desktop Search Bar -->
            <div style="display:flex;align-items:center;gap:12px;flex:1;max-width:420px;">
                <!-- Mobile Hamburger Button -->
                <button type="button" @click="mobileOpen = true"
                        style="display:none;width:38px;height:38px;border-radius:12px;align-items:center;justify-content:center;cursor:pointer;flex-shrink:0;"
                        id="mobile-menu-btn" class="sub-btn">
                    <svg width="20" height="20" fill="none" stroke="#64748B" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <style>
                    @media (max-width: 1023px) { #mobile-menu-btn { display:flex !important; } }
                </style>

                <!-- Mobile Brand Display -->
                <div class="flex items-center gap-2 sm:hidden">
                    <span style="font-family:'Playfair Display',serif;font-style:italic;font-size:1.25rem;font-weight:700;line-height:1;" class="text-slate-900 dark:text-white">Luxora</span>
                    <span style="font-size:0.65rem;color:#C59B4E;font-weight:700;">لكسورا</span>
                </div>

                <!-- Inset Neumorphic Search Pill (Visible on Desktop & Tablet) -->
                <div style="position:relative;flex:1;" class="hidden sm:block">
                    <input type="text" placeholder="Search orders, catalog, patrons..."
                           style="width:100%;border-radius:999px !important;padding:8px 16px 8px 36px;font-size:0.78rem;outline:none;"
                           class="sub-input">
                    <svg width="14" height="14" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"
                         style="position:absolute;left:13px;top:50%;transform:translateY(-50%);">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Right: Date Chip, Theme Toggle, Notification Bell, User Profile -->
            <div style="display:flex;align-items:center;gap:10px;">
                <!-- Neumorphic Date Chip (Desktop only) -->
                <div style="display:none;align-items:center;gap:6px;font-size:0.75rem;font-weight:600;padding:6px 12px;border-radius:999px;" class="sub-btn header-date-chip">
                    <svg width="13" height="13" fill="none" stroke="#94A3B8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span>{{ now()->format('l, jS F') }}</span>
                </div>
                <style>
                    @media (min-width: 768px) { .header-date-chip { display:flex !important; } }
                </style>

                <!-- Quick Header Theme Toggle Button -->
                <button type="button" @click="toggleDark()"
                        style="width:36px;height:36px;border-radius:12px;display:flex;align-items:center;justify-content:center;cursor:pointer;"
                        class="sub-btn" :title="darkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                    <span x-show="!darkMode" style="font-size:14px;">🌙</span>
                    <span x-show="darkMode" style="font-size:14px;">☀️</span>
                </button>

                <!-- Neumorphic Bell with interactive dropdown -->
                <div style="position:relative;" x-data="{ open: false }">
                    <button type="button" @click="open = !open" @click.outside="open = false"
                            style="width:36px;height:36px;border-radius:12px;display:flex;align-items:center;justify-content:center;position:relative;"
                            class="sub-btn" title="Notifications">
                        <svg width="17" height="17" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span style="position:absolute;top:4px;right:4px;width:14px;height:14px;background:#3B82F6;color:#fff;border-radius:50%;font-size:8px;font-weight:700;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 5px rgba(59,130,246,0.5);">3</span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div x-show="open" x-transition x-cloak
                         style="position:absolute;right:0;top:44px;width:300px;border-radius:18px;z-index:100;padding:14px;"
                         class="content-card">
                        <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:10px;border-bottom:1px solid rgba(226,232,240,0.6);margin-bottom:8px;"
                             class="dark:border-white/10">
                            <span style="font-size:0.8rem;font-weight:700;" class="text-slate-900 dark:text-white">VIP Notifications</span>
                            <span style="font-size:0.65rem;background:#EFF6FF;color:#3B82F6;padding:2px 7px;border-radius:999px;font-weight:700;" class="dark:bg-blue-950/60 dark:text-blue-400">3 New</span>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:6px;">
                            <a href="{{ route('admin.orders.index') }}" style="display:flex;align-items:flex-start;gap:8px;padding:8px;border-radius:10px;text-decoration:none;" class="sub-btn">
                                <span style="width:7px;height:7px;border-radius:50%;background:#10B981;margin-top:5px;flex-shrink:0;"></span>
                                <div>
                                    <p style="font-size:0.74rem;font-weight:700;margin:0;" class="text-slate-900 dark:text-white">VIP Order #MJH-8813</p>
                                    <p style="font-size:0.64rem;color:#64748B;margin:0;" class="dark:text-slate-400">AED 1,269,650 from Zara Hassan</p>
                                </div>
                            </a>
                            <a href="{{ route('admin.orders.index') }}" style="display:flex;align-items:flex-start;gap:8px;padding:8px;border-radius:10px;text-decoration:none;" class="sub-btn">
                                <span style="width:7px;height:7px;border-radius:50%;background:#3B82F6;margin-top:5px;flex-shrink:0;"></span>
                                <div>
                                    <p style="font-size:0.74rem;font-weight:700;margin:0;" class="text-slate-900 dark:text-white">Royal Patron Acquisition</p>
                                    <p style="font-size:0.64rem;color:#64748B;margin:0;" class="dark:text-slate-400">AED 950,000 Sheikha Fatima</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Neumorphic User Profile with Dropdown -->
                <div style="position:relative;" x-data="{ userMenu: false }">
                    <button type="button" @click="userMenu = !userMenu" @click.outside="userMenu = false"
                            style="display:flex;align-items:center;gap:8px;background:none;border:none;cursor:pointer;padding:3px 6px;border-radius:999px;"
                            class="sub-btn">
                        <div style="text-align:right;line-height:1.2;padding-left:3px;" class="hidden md:block">
                            <span style="display:block;font-size:0.78rem;font-weight:700;" class="text-slate-900 dark:text-white">{{ auth()->user()->name ?? 'Ahmed Al-Farsi' }}</span>
                            <span style="display:block;font-size:0.64rem;color:#94A3B8;" class="dark:text-slate-400">Master Atelier Director</span>
                        </div>
                        <div style="position:relative;">
                            <img src="{{ auth()->user()?->avatar_url }}"
                                 alt="{{ auth()->user()?->name ?? 'User' }}"
                                 class="user-avatar-img"
                                 style="width:32px;height:32px;border-radius:50%;object-fit:cover;border:2px solid #D4AF37;">
                            <span style="position:absolute;bottom:0;right:0;width:7px;height:7px;border-radius:50%;background:#10B981;border:1.5px solid #ffffff;"></span>
                        </div>
                        <svg width="11" height="11" fill="none" stroke="#94A3B8" viewBox="0 0 24 24"
                             :style="userMenu ? 'transform:rotate(180deg)' : ''" style="transition:transform 0.18s;margin-right:2px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <!-- User Menu Dropdown -->
                    <div x-show="userMenu" x-transition x-cloak
                         style="position:absolute;right:0;top:44px;width:240px;border-radius:18px;z-index:100;padding:12px;"
                         class="content-card">
                        <div style="padding-bottom:8px;border-bottom:1px solid rgba(226,232,240,0.6);margin-bottom:6px;"
                             class="dark:border-white/10">
                            <div style="display:flex;align-items:center;gap:10px;">
                                <img src="{{ auth()->user()?->avatar_url }}"
                                     alt="{{ auth()->user()?->name ?? 'User' }}"
                                     class="user-avatar-img"
                                     style="width:36px;height:36px;border-radius:50%;object-fit:cover;border:1.5px solid #D4AF37;">
                                <div style="overflow:hidden;flex:1;">
                                    <p style="font-size:0.8rem;font-weight:700;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="text-slate-900 dark:text-white">{{ auth()->user()->name ?? 'Ahmed Al-Farsi' }}</p>
                                    <p style="font-size:0.68rem;color:#94A3B8;margin:0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;" class="dark:text-slate-400">{{ auth()->user()->email ?? 'director@luxora-jewels.com' }}</p>
                                </div>
                            </div>
                        </div>
                        <div style="display:flex;flex-direction:column;gap:3px;">
                            <button type="button" @click="$dispatch('open-avatar-modal'); userMenu = false" class="nav-item" style="width:100%;text-align:left;display:flex;align-items:center;gap:8px;background:none;border:none;cursor:pointer;padding:7px 10px;font-size:0.78rem;">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span>Change Profile Picture</span>
                            </button>
                            <a href="{{ route('admin.settings.index') }}" class="nav-item" style="padding:7px 10px;font-size:0.78rem;">
                                <span>Maison Settings</span>
                            </a>
                            <a href="{{ route('home') }}" target="_blank" class="nav-item" style="padding:7px 10px;font-size:0.78rem;">
                                <span>Live Boutique</span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST" style="margin-top:4px;padding-top:4px;border-top:1px solid rgba(226,232,240,0.6);" class="dark:border-white/10">
                                @csrf
                                <button type="submit" class="nav-item" style="width:100%;color:#E11D48;background:none;border:none;cursor:pointer;padding:7px 10px;font-size:0.78rem;">
                                    <span>Log Out</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <!-- Main Body Wrapper -->
        <main style="flex:1;padding:16px 14px;" class="sm:p-6 lg:p-8">
            <div style="max-width:1440px;margin:0 auto;width:100%;">
                @if (session('success'))
                    <div style="margin-bottom:18px;padding:12px 18px;border-radius:14px;background:#E6F8F3;border:1px solid #A7F3D0;color:#0D9488;font-size:0.82rem;font-weight:600;display:flex;align-items:center;gap:10px;" class="dark:bg-emerald-950/40 dark:border-emerald-800 dark:text-emerald-300">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if (session('error'))
                    <div style="margin-bottom:18px;padding:12px 18px;border-radius:14px;background:#FDECEE;border:1px solid #FECDD3;color:#E11D48;font-size:0.82rem;font-weight:600;display:flex;align-items:center;gap:10px;" class="dark:bg-rose-950/40 dark:border-rose-800 dark:text-rose-300">
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer style="padding:16px 24px;border-top:1px solid rgba(226,232,240,0.6);font-size:0.75rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;"
                class="bg-[#EEF2F6] dark:bg-[#0B0F19] text-slate-600 dark:text-slate-400 dark:border-white/5">
            <div>
                Luxora High Fine Joaillerie Suite &copy; {{ date('Y') }} &bull; All Rights Reserved
            </div>
            <div>
                Atelier Core Engine v3.4.2 &bull; GCC Dubai Edition
            </div>
        </footer>

    </div>

</div>

<x-profile-avatar-modal />

</body>
</html>
