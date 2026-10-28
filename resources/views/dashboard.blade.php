<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BRACU Social - Community Feed</title>
    <!-- Nunito Sans: one font family only across the entire site -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,400;0,6..12,600;0,6..12,700;1,6..12,400;1,6..12,600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-page: #F5F3EA;
            --surface-card: #FFFFFF;
            --text-primary: #30352D;
            --text-secondary: #646A60;
            --border: #E5E5DA;
            --bg-hover: #F5F3EA;
            --header-bg: #91A77C;
            --header-hover: #82996C;
            --primary: #526747;
            --primary-hover: #435639;
            --moss: #737F53;
            --active-tint: #E9EEE1;
            --destructive: #8C3B32;
            --destructive-tint: #F4E7E3;
            --label-lost-text: #5E4A1F;
            --label-lost-bg: #EFE8D3;
            --label-found-text: #3F5236;
            --label-found-bg: #E3EAD9;
            --label-solved-text: #FFFFFF;
            --label-solved-bg: #526747;
            --radius-card: 10px;
            --radius-ctrl: 8px;
            --radius-pill: 999px;
            --shadow-card: 0 1px 2px rgba(48,53,45,.06);
            --header-height: 64px;
        }

        @media (prefers-color-scheme: dark) {
            :root {
                --bg-page: #1A1D17;
                --surface-card: #23271F;
                --text-primary: #E8E8DD;
                --text-secondary: #A4A99A;
                --border: #34382E;
                --bg-hover: #2C3025;
                --header-bg: #3A4A33;
                --header-hover: #45573D;
                --primary: #91A77C;
                --primary-hover: #A0B68B;
                --moss: #737F53;
                --active-tint: #2F3A28;
                --destructive: #E0A196;
                --destructive-tint: #3B2624;
                --label-lost-text: #EFE8D3;
                --label-lost-bg: #4A3E20;
                --label-found-text: #E3EAD9;
                --label-found-bg: #2B3A24;
                --label-solved-text: #1A2414;
                --label-solved-bg: #91A77C;
                --shadow-card: none;
            }
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: none !important;
            animation: none !important;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            font-family: 'Nunito Sans', system-ui, Arial, sans-serif;
            font-size: 15px;
            line-height: 1.6;
            color: var(--text-primary);
            background-color: var(--bg-page);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }

        input, textarea, button, select {
            font-family: 'Nunito Sans', system-ui, Arial, sans-serif;
            font-size: 15px;
            color: var(--text-primary);
        }

        :focus-visible {
            outline: 2px solid var(--primary);
            outline-offset: 2px;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            line-height: 1.3;
            color: var(--text-primary);
        }

        h2 {
            font-size: 16px;
            font-weight: 600;
            line-height: 1.4;
            color: var(--text-primary);
        }

        .page-subtitle {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 4px;
            margin-bottom: 20px;
        }

        .text-muted {
            font-size: 13px;
            color: var(--text-secondary);
        }

        /* Sticky Header */
        header.site-header {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--header-height);
            background-color: var(--header-bg);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            padding-top: env(safe-area-inset-top);
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            cursor: pointer;
        }

        .logo-box {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background-color: var(--primary);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-primary);
            letter-spacing: -0.2px;
        }

        .header-search {
            flex: 1;
            max-width: 640px;
            margin: 0 24px;
            position: relative;
        }

        .search-field-wrap {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
        }

        .search-field-wrap svg {
            position: absolute;
            left: 14px;
            color: var(--text-secondary);
            pointer-events: none;
        }

        .search-field-wrap input {
            width: 100%;
            height: 40px;
            background: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-pill);
            padding: 0 16px 0 42px;
            font-size: 14px;
        }

        .search-field-wrap input:focus {
            border-color: var(--primary);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
            position: relative;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-ctrl);
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-primary);
            position: relative;
        }

        .icon-btn:hover {
            background-color: var(--header-hover);
        }

        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 15px;
            user-select: none;
            flex-shrink: 0;
        }

        .avatar.sm {
            width: 32px;
            height: 32px;
            font-size: 13px;
        }

        .avatar.anonymous {
            background-color: #59635C;
        }

        .avatar-btn {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
        }

        /* Popovers */
        .popover-menu {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            background: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            z-index: 150;
            display: none;
        }

        .popover-menu.open {
            display: block;
        }

        .notifications-popover {
            width: 340px;
            max-height: 440px;
            overflow-y: auto;
        }

        .popover-header {
            padding: 14px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .popover-header h3 {
            font-size: 15px;
            font-weight: 600;
        }

        .text-link {
            font-size: 13px;
            color: var(--primary);
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .notification-item {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            gap: 12px;
            cursor: pointer;
            position: relative;
        }

        .account-popover {
            width: 200px;
            padding: 8px 0;
        }

        .account-menu-item {
            width: 100%;
            padding: 10px 16px;
            border: none;
            background: none;
            text-align: left;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .account-menu-item:hover {
            background-color: var(--bg-hover);
        }

        .account-menu-item.danger {
            color: var(--destructive);
        }

        /* Search Dropdown */
        .search-results-card {
            position: absolute;
            top: calc(100% + 6px);
            left: 0;
            right: 0;
            background: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            z-index: 120;
            max-height: 360px;
            overflow-y: auto;
            display: none;
        }

        .search-result-row {
            padding: 10px 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            border-bottom: 1px solid var(--border);
        }

        .search-result-row:last-child {
            border-bottom: none;
        }

        .search-result-row:hover {
            background-color: var(--bg-hover);
        }

        /* Layout Grid */
        .main-layout {
            display: grid;
            grid-template-columns: clamp(224px, 20vw, 320px) minmax(0, 1fr) clamp(288px, 26vw, 400px);
            gap: 24px;
            padding: 24px;
            width: 100%;
            flex: 1;
            align-items: start;
        }

        .sidebar-sticky {
            position: sticky;
            top: calc(var(--header-height) + 24px);
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .card {
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: var(--shadow-card);
            padding: 24px;
        }

        /* Left Navigation */
        .nav-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
            list-style: none;
        }

        .nav-item-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-radius: 10px;
            border: none;
            background: transparent;
            color: var(--text-secondary);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-align: left;
        }

        .nav-item-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .nav-item-btn:hover {
            background-color: var(--bg-hover);
            color: var(--text-primary);
        }

        .nav-item-btn.active, .nav-item-btn[aria-current="page"] {
            background-color: var(--active-tint);
            color: var(--primary);
        }

        /* Right Sidebar Cards */
        .sidebar-heading-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .events-list-compact {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .event-row-compact {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 0;
            cursor: pointer;
            border-bottom: 1px solid var(--border);
        }

        .event-row-compact:last-child {
            border-bottom: none;
        }

        .event-row-compact:hover .event-compact-title {
            color: var(--primary);
        }

        .date-block-48 {
            width: 48px;
            height: 48px;
            background-color: var(--active-tint);
            border-radius: var(--radius-ctrl);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .date-block-48 .day-num {
            font-size: 18px;
            font-weight: 700;
            line-height: 1;
            color: var(--primary);
        }

        .date-block-48 .month-abbr {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--primary);
            margin-top: 2px;
        }

        .event-compact-info {
            flex: 1;
            min-width: 0;
        }

        .event-compact-title {
            font-weight: 600;
            font-size: 14px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .calendar-preview-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
            text-align: center;
            font-size: 12px;
        }

        .cal-preview-day-header {
            font-weight: 600;
            color: var(--text-secondary);
            padding: 4px 0;
        }

        .cal-preview-cell {
            padding: 6px 0;
            border-radius: 4px;
            cursor: pointer;
            color: var(--text-primary);
        }

        .cal-preview-cell.empty {
            cursor: default;
            color: transparent;
        }

        .cal-preview-cell.has-event {
            background-color: var(--active-tint);
            color: var(--primary);
            font-weight: 700;
        }

        .cal-preview-cell.today {
            outline: 1px solid var(--primary);
        }

        /* Center Content Feed */
        .center-feed {
            display: flex;
            flex-direction: column;
            gap: 24px;
            min-width: 0;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: var(--radius-ctrl);
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .btn-primary {
            background-color: var(--primary);
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
        }

        .btn-secondary {
            background-color: var(--surface-card);
            border-color: var(--border);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background-color: var(--bg-hover);
        }

        .btn-destructive {
            background-color: var(--destructive);
            color: #FFFFFF;
        }

        .btn-destructive:hover {
            opacity: 0.9;
        }

        .btn-sm {
            padding: 4px 12px;
            font-size: 13px;
        }

        input[type="text"], input[type="date"], input[type="time"], textarea, select {
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            padding: 10px 14px;
            width: 100%;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--primary);
            outline: none;
        }

        .switch-wrap {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
            font-size: 14px;
        }

        .toggle-switch {
            width: 40px;
            height: 24px;
            border-radius: var(--radius-pill);
            background-color: #8F9488;
            position: relative;
            flex-shrink: 0;
            cursor: pointer;
            border: none;
            padding: 0;
            display: inline-block;
        }

        .toggle-switch.active {
            background-color: var(--primary);
        }

        .toggle-knob {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background-color: #FFFFFF;
            position: absolute;
            top: 3px;
            left: 3px;
        }

        .toggle-switch.active .toggle-knob {
            left: 19px;
        }

        .chip-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: var(--radius-pill);
            font-size: 12px;
            font-weight: 600;
            border: 1px solid var(--border);
            background: var(--surface-card);
            cursor: pointer;
        }

        .chip-pill.active {
            background-color: var(--active-tint);
            border-color: var(--primary);
            color: var(--primary);
        }

        .status-badge {
            font-size: 12px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: var(--radius-pill);
            display: inline-flex;
            align-items: center;
            gap: 4px;
            line-height: 1;
        }

        .status-badge.lost {
            background-color: var(--label-lost-bg);
            color: var(--label-lost-text);
        }

        .status-badge.found {
            background-color: var(--label-found-bg);
            color: var(--label-found-text);
        }

        .status-badge.solved {
            background-color: var(--label-solved-bg);
            color: var(--label-solved-text);
        }

        /* Composer Card */
        .composer-collapsed {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
        }

        .composer-fake-input {
            flex: 1;
            padding: 10px 16px;
            background-color: var(--bg-hover);
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            color: var(--text-secondary);
            font-size: 15px;
            text-align: left;
            cursor: pointer;
        }

        .composer-expanded {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .composer-header-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .composer-user-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .composer-inset-panel {
            background-color: var(--bg-hover);
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .poll-options-builder {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .poll-option-input-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .composer-toggles-row {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .composer-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        .composer-actions-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .image-preview-thumbnail-wrap {
            position: relative;
            display: inline-block;
            margin-top: 8px;
        }

        .image-preview-thumbnail {
            width: 100px;
            height: 100px;
            border-radius: var(--radius-ctrl);
            object-fit: cover;
            border: 1px solid var(--border);
            display: block;
        }

        /* Post Card */
        .post-card {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .post-header-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            position: relative;
        }

        .post-author-wrap {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .author-text {
            display: flex;
            flex-direction: column;
        }

        .author-name-btn {
            background: none;
            border: none;
            padding: 0;
            font-size: 15px;
            font-weight: 600;
            color: var(--text-primary);
            cursor: pointer;
            text-align: left;
        }

        .author-name-btn:hover {
            color: var(--primary);
        }

        .post-meta-line {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .post-title {
            font-size: 18px;
            font-weight: 600;
            line-height: 1.4;
            color: var(--text-primary);
        }

        .post-body {
            font-size: 15px;
            line-height: 1.6;
            color: var(--text-primary);
            white-space: pre-wrap;
        }

        .post-image-wrap {
            width: 100%;
            max-height: 420px;
            overflow: hidden;
            border-radius: var(--radius-ctrl);
            border: 1px solid var(--border);
        }

        .post-image-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Poll Block */
        .poll-block {
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            padding: 16px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background-color: var(--surface-card);
        }

        .poll-question-title {
            font-weight: 600;
            font-size: 15px;
        }

        .poll-options-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .poll-voting-option-label {
            width: 100%;
            padding: 10px 14px;
            border-radius: var(--radius-ctrl);
            border: 1px solid var(--border);
            background: var(--surface-card);
            text-align: left;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .poll-voting-option-label:hover {
            border-color: var(--primary);
            background-color: var(--bg-hover);
        }

        .poll-result-row {
            position: relative;
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            overflow: hidden;
            padding: 10px 14px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
        }

        .poll-result-row.chosen {
            border-color: var(--primary);
            font-weight: 600;
        }

        .poll-progress-bg {
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            background-color: var(--active-tint);
            z-index: 1;
        }

        .poll-result-text {
            position: relative;
            z-index: 2;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .poll-result-stats {
            position: relative;
            z-index: 2;
            font-size: 13px;
            color: var(--text-secondary);
        }

        .poll-result-footer {
            font-size: 13px;
            color: var(--text-secondary);
            margin-top: 4px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        /* Post Action Row */
        .post-action-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 14px;
            border-top: 1px solid var(--border);
        }

        .post-actions-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .post-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: var(--radius-ctrl);
            border: 1px solid transparent;
            background: transparent;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .post-action-btn:hover {
            background-color: var(--bg-hover);
            color: var(--text-primary);
        }

        .post-action-btn.active {
            background-color: var(--active-tint);
            color: var(--primary);
        }

        /* Comments Section */
        .comments-section {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding-top: 12px;
            border-top: 1px solid var(--border);
        }

        .comment-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .comment-bubble {
            flex: 1;
            background-color: var(--bg-hover);
            padding: 8px 12px;
            border-radius: var(--radius-ctrl);
            font-size: 14px;
        }

        .comment-author-line {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 2px;
        }

        .comment-author-name {
            font-weight: 600;
            font-size: 13px;
        }

        .comment-time {
            font-size: 11px;
            color: var(--text-secondary);
        }

        .comment-input-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 4px;
        }

        /* Post 3-dot dropdown menu */
        .post-menu-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-ctrl);
            box-shadow: var(--shadow-card);
            z-index: 50;
            width: 140px;
            display: none;
            overflow: hidden;
        }

        .post-menu-dropdown.open {
            display: block;
        }

        .post-menu-item {
            width: 100%;
            padding: 8px 14px;
            border: none;
            background: transparent;
            text-align: left;
            cursor: pointer;
            font-size: 14px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .post-menu-item:hover {
            background-color: var(--bg-hover);
        }

        .post-menu-item.danger {
            color: var(--destructive);
        }

        /* Empty State */
        .empty-state {
            padding: 40px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 16px;
            color: var(--text-secondary);
        }

        /* Modals & Drawers */
        .modal-backdrop {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 300;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-box {
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            max-width: 600px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h3 {
            font-size: 18px;
            font-weight: 600;
        }

        /* Chat Drawer */
        .chat-drawer {
            display: none;
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 440px;
            height: 540px;
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-card);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            z-index: 250;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-drawer-header {
            background-color: var(--header-bg);
            padding: 12px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-weight: 600;
        }

        .chat-drawer-body {
            display: flex;
            flex: 1;
            min-height: 0;
        }

        .chat-drawer-users {
            width: 140px;
            border-right: 1px solid var(--border);
            overflow-y: auto;
            background-color: var(--bg-hover);
        }

        .chat-user-row {
            padding: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border-bottom: 1px solid var(--border);
        }

        .chat-user-row:hover, .chat-user-row.active {
            background-color: var(--active-tint);
            color: var(--primary);
        }

        .chat-drawer-thread {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            background-color: var(--bg-page);
        }

        .chat-drawer-messages {
            flex: 1;
            padding: 12px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .chat-msg {
            padding: 8px 12px;
            border-radius: var(--radius-ctrl);
            font-size: 13px;
            max-width: 80%;
            word-break: break-word;
        }

        .chat-msg.out {
            align-self: flex-end;
            background-color: var(--primary);
            color: #FFFFFF;
            border-bottom-right-radius: 2px;
        }

        .chat-msg.in {
            align-self: flex-start;
            background-color: var(--surface-card);
            border: 1px solid var(--border);
            color: var(--text-primary);
            border-bottom-left-radius: 2px;
        }

        .chat-drawer-input {
            padding: 8px 12px;
            background-color: var(--surface-card);
            border-top: 1px solid var(--border);
            display: flex;
            gap: 8px;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #30352D;
            color: #FFFFFF;
            padding: 10px 20px;
            border-radius: var(--radius-ctrl);
            font-size: 14px;
            font-weight: 600;
            z-index: 999;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
            display: none;
            text-align: center;
        }

        /* Mobile Bottom Nav */
        .bottom-nav-bar {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background-color: var(--surface-card);
            border-top: 1px solid var(--border);
            z-index: 100;
            justify-content: space-around;
            align-items: center;
            padding-bottom: env(safe-area-inset-bottom);
        }

        .bottom-nav-btn {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 2px;
            background: transparent;
            border: none;
            color: var(--text-secondary);
            font-size: 10px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .bottom-nav-btn.active, .bottom-nav-btn[aria-current="page"] {
            color: var(--primary);
            background-color: var(--active-tint);
        }

        @media (max-width: 1100px) {
            .main-layout {
                grid-template-columns: clamp(208px, 26vw, 260px) minmax(0, 1fr);
            }
            .sidebar-right {
                display: none;
            }
        }

        @media (max-width: 820px) {
            header.site-header {
                padding: 0 16px;
            }
            .logo-title {
                display: none;
            }
            .header-search {
                margin: 0 12px;
            }
            .main-layout {
                grid-template-columns: 1fr;
                padding: 16px;
                padding-bottom: 80px;
            }
            .sidebar-left, .sidebar-right {
                display: none;
            }
            .bottom-nav-bar {
                display: flex;
            }
            .card {
                padding: 16px;
            }
            .post-action-btn .btn-text {
                display: none;
            }
            .toast {
                bottom: 74px;
            }
            .chat-drawer {
                width: calc(100% - 32px);
                right: 16px;
                bottom: 76px;
                height: 70vh;
            }
        }
    </style>
</head>
<body>

    <!-- Sticky Header -->
    <header class="site-header" role="banner">
        <a href="/dashboard" class="header-left" aria-label="Go to Dashboard">
            <div class="logo-box" aria-hidden="true">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
            </div>
            <div class="logo-title">BRACU Social</div>
        </a>

        <div class="header-search">
            <div class="search-field-wrap">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="user-search" placeholder="Search students by name..." autocomplete="off" aria-label="Search students by name">
            </div>
            <div class="search-results-card" id="search-results" role="listbox"></div>
        </div>

        <div class="header-right">
            <!-- Notifications Popover Bell -->
            <button class="icon-btn" id="notif-bell-btn" aria-label="Notifications" onclick="togglePopover('notif-popover')">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
            </button>

            <!-- Notifications Popover Card -->
            <div class="popover-menu notifications-popover" id="notif-popover">
                <div class="popover-header">
                    <h3>Campus Notices</h3>
                    <button class="text-link" onclick="closeAllPopovers()">Close</button>
                </div>
                <div id="notif-list-container">
                    <div class="notification-item">
                        <div class="avatar sm" style="background-color: var(--primary);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <div>
                            <div><strong>Campus Event</strong> Check the Event Board for upcoming workshops and fairs.</div>
                            <div class="text-muted" style="margin-top: 2px;">Campus Notice</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Avatar Button -->
            <button class="avatar-btn" id="account-avatar-btn" aria-label="Account menu" onclick="togglePopover('account-popover')">
                <div class="avatar sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </button>

            <!-- Account Menu Popover -->
            <div class="popover-menu account-popover" id="account-popover">
                <a href="/profile" class="account-menu-item">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    My Profile
                </a>
                <button class="account-menu-item" onclick="openChatDrawer(); closeAllPopovers();">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    Messages
                </button>
                <a href="/logout" class="account-menu-item danger">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main 3-Column Layout -->
    <main class="main-layout" role="main">
        <!-- Left Sidebar Navigation -->
        <aside class="sidebar-left" aria-label="Navigation">
            <div class="sidebar-sticky">
                <div class="card" style="padding: 16px;">
                    <ul class="nav-list" role="list">
                        <li>
                            <button class="nav-item-btn active" id="nav-btn-home" onclick="setFeedFilter('all')">
                                <div class="nav-item-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                    <span>Home</span>
                                </div>
                            </button>
                        </li>
                        <li>
                            <button class="nav-item-btn" id="nav-btn-chat" onclick="openChatDrawer()">
                                <div class="nav-item-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                    <span>Messages</span>
                                </div>
                            </button>
                        </li>
                        <li>
                            <button class="nav-item-btn" id="nav-btn-events" onclick="openEventModal()">
                                <div class="nav-item-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    <span>Events & Calendar</span>
                                </div>
                            </button>
                        </li>
                        <li>
                            <button class="nav-item-btn" id="nav-btn-lostfound" onclick="setFeedFilter('lost')">
                                <div class="nav-item-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                    <span>Lost & Found</span>
                                </div>
                            </button>
                        </li>
                        <li>
                            <button class="nav-item-btn" id="nav-btn-polls" onclick="setFeedFilter('poll')">
                                <div class="nav-item-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
                                    <span>Polls</span>
                                </div>
                            </button>
                        </li>
                        <li>
                            <a href="/profile" class="nav-item-btn">
                                <div class="nav-item-left">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <span>My Profile</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Center Feed -->
        <section class="center-feed">
            <div>
                <h1 id="feed-page-title">Community Feed</h1>
                <div class="page-subtitle" id="feed-page-subtitle">What’s happening at BRACU today.</div>
            </div>

            <!-- Composer Card -->
            <div class="card" id="composer-card">
                <!-- Collapsed State -->
                <div class="composer-collapsed" id="composer-collapsed-view" onclick="expandComposer()">
                    <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                    <button class="composer-fake-input" type="button">Share something with your community…</button>
                </div>

                <!-- Expanded State Form -->
                <form action="/create-post" method="POST" enctype="multipart/form-data" class="composer-expanded" id="composer-expanded-view" style="display: none;">
                    @csrf
                    <div class="composer-header-row">
                        <div class="composer-user-info">
                            <div class="avatar" id="composer-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <div>
                                <span style="font-weight: 600;">Create a post</span>
                                <span class="text-muted" id="composer-anon-label" style="display: none; margin-left: 6px;">(Posting as Anonymous)</span>
                            </div>
                        </div>
                        <button type="button" class="icon-btn" onclick="collapseComposer()" aria-label="Close composer">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        </button>
                    </div>

                    <!-- Title & Body -->
                    <input type="text" name="title" id="post_title" placeholder="Title (required unless adding poll)" required>
                    <textarea name="body" id="post_body" rows="3" placeholder="What's on your mind?" required></textarea>

                    <!-- Image Attachment Controls -->
                    <div style="display: flex; flex-direction: column; align-items: flex-start; gap: 8px;">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <label class="btn btn-secondary btn-sm" style="cursor: pointer;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                                Add image
                                <input type="file" name="image" id="image" accept="image/*" style="display: none;">
                            </label>
                            <button type="button" class="btn btn-secondary btn-sm" id="remove-img-btn" style="display: none;" onclick="removeImage()">Remove image</button>
                        </div>
                        <div class="image-preview-thumbnail-wrap" id="image-preview" style="display: none;">
                            <img id="preview-img" src="" alt="Preview" class="image-preview-thumbnail">
                        </div>
                    </div>

                    <!-- Feature Toggles Chips -->
                    <div class="composer-toggles-row">
                        <label class="chip-pill" id="poll-toggle-pill">
                            <input type="checkbox" name="has_poll" value="1" id="has_poll_checkbox" style="display: none;" onchange="togglePollSection()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
                            Poll
                        </label>
                        <label class="chip-pill" id="lf-toggle-pill">
                            <input type="checkbox" name="lost_and_found" value="1" id="has_lf_checkbox" style="display: none;" onchange="toggleLfSection()">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            Lost & Found
                        </label>
                    </div>

                    <!-- Optional Poll Inset Panel -->
                    <div class="composer-inset-panel" id="poll-section" style="display: none;">
                        <div style="font-size: 13px; font-weight: 600; color: var(--text-secondary);">Poll Configuration</div>
                        <input type="text" name="poll_question" id="poll_question" placeholder="Poll question (e.g. Which date works best?)">
                        
                        <div class="poll-options-builder" id="poll-options-container">
                            <div class="poll-option-input-row">
                                <input type="text" name="poll_options[]" placeholder="Option 1">
                            </div>
                            <div class="poll-option-input-row">
                                <input type="text" name="poll_options[]" placeholder="Option 2">
                            </div>
                        </div>

                        <div>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="addPollOption()">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                Add option
                            </button>
                        </div>

                        <div style="margin-top: 4px;">
                            <label class="switch-wrap">
                                <input type="checkbox" name="poll_multiple_choice" value="1" id="poll_multiple_choice" style="display: none;" onchange="this.nextElementSibling.classList.toggle('active', this.checked)">
                                <span class="toggle-switch">
                                    <span class="toggle-knob"></span>
                                </span>
                                <span>Allow multiple choices</span>
                            </label>
                        </div>
                    </div>

                    <!-- Footer Row -->
                    <div class="composer-footer-row">
                        <label class="switch-wrap">
                            <input type="checkbox" name="anonymous" value="1" id="anonymous_checkbox" style="display: none;" onchange="toggleAnonymous(this)">
                            <span class="toggle-switch" id="anon-switch-ui">
                                <span class="toggle-knob"></span>
                            </span>
                            <span>Post anonymously</span>
                        </label>

                        <div class="composer-actions-right">
                            <button type="button" class="btn btn-secondary" onclick="collapseComposer()">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="publish-btn">Publish</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Posts List Feed -->
            <div id="posts-feed-container" style="display: flex; flex-direction: column; gap: 24px;">
                @forelse ($posts as $post)
                <article class="card post-card" data-post-id="{{$post->id}}" data-author-id="{{$post->user_id}}" data-lost-and-found="{{$post->lost_and_found ? '1' : '0'}}" data-has-poll="{{$post->poll ? '1' : '0'}}">
                    <div class="post-header-row">
                        <div class="post-author-wrap">
                            @if($post->anonymous)
                                <div class="avatar anonymous">?</div>
                                <div class="author-text">
                                    <span class="author-name-btn" style="cursor: default;">Anonymous</span>
                                    <span class="post-meta-line">
                                        {{$post->created_at->format('M j, Y')}}
                                        @if(auth()->id() == $post->user_id)
                                            · only you can see this is yours
                                        @endif
                                    </span>
                                </div>
                            @else
                                <a href="/user/{{$post->user_id}}" class="avatar">{{ strtoupper(substr($post->user->name ?? 'U', 0, 1)) }}</a>
                                <div class="author-text">
                                    <a href="/user/{{$post->user_id}}" class="author-name-btn">{{$post->user->name ?? 'BRACU Student'}}</a>
                                    <span class="post-meta-line">{{$post->created_at->format('M j, Y')}} · {{$post->user->department ?? 'Campus'}}</span>
                                </div>
                            @endif
                        </div>

                        <div style="display: flex; align-items: center; gap: 8px;">
                            @if($post->lost_and_found)
                                @if($post->resolved)
                                    <span class="status-badge solved">Solved</span>
                                @else
                                    <span class="status-badge lost">Lost & Found</span>
                                @endif
                            @endif

                            @if(auth()->id() == $post->user_id)
                                <div style="position: relative;">
                                    <button class="icon-btn" onclick="togglePostMenu({{$post->id}})" aria-label="Post options">
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                    </button>
                                    <div class="post-menu-dropdown" id="post-menu-{{$post->id}}">
                                        <a href="/edit-post/{{$post->id}}" class="post-menu-item">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                                            Edit post
                                        </a>
                                        <form action="/delete-post/{{$post->id}}" method="POST" onsubmit="return confirm('Delete this post? This will permanently remove the post and its comments.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="post-menu-item danger">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                Delete post
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($post->title)
                        <h3 class="post-title">{{$post->title}}</h3>
                    @endif

                    @if($post->body)
                        <div class="post-body">{{$post->body}}</div>
                    @endif

                    @if($post->image)
                        <div class="post-image-wrap">
                            <img src="{{ asset($post->image) }}" alt="Post Image">
                        </div>
                    @endif

                    <!-- Poll Section -->
                    @if($post->poll)
                        <div class="poll-block">
                            <div class="poll-question-title">{{$post->poll->question}}</div>

                            @if($post->poll->hasUserVoted(auth()->id()))
                                <div class="poll-options-list">
                                    @foreach($post->poll->options as $option)
                                        @php
                                            $userVotedThis = $post->poll->getUserVotedOptions(auth()->id())->contains($option->id);
                                            $pct = $option->percentage ?? ($post->poll->total_votes > 0 ? round(($option->votes_count / $post->poll->total_votes) * 100) : 0);
                                        @endphp
                                        <div class="poll-result-row {{$userVotedThis ? 'chosen' : ''}}">
                                            <div class="poll-progress-bg" style="width: {{$pct}}%;"></div>
                                            <div class="poll-result-text">
                                                @if($userVotedThis)
                                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary);"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                                @endif
                                                <span>{{$option->option_text}}</span>
                                            </div>
                                            <div class="poll-result-stats">{{$pct}}% · {{$option->votes_count}}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="poll-result-footer">
                                    <span>You voted · {{$post->poll->total_votes}} votes</span>
                                    <form action="/polls/{{$post->poll->id}}/vote" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-link" style="font-size: 12px;">Remove vote</button>
                                    </form>
                                </div>
                            @else
                                <form action="/polls/{{$post->poll->id}}/vote" method="POST">
                                    @csrf
                                    <div class="poll-options-list">
                                        @foreach($post->poll->options as $option)
                                            <label class="poll-voting-option-label">
                                                @if($post->poll->multiple_choice)
                                                    <input type="checkbox" name="option_ids[]" value="{{$option->id}}">
                                                @else
                                                    <input type="radio" name="option_ids[]" value="{{$option->id}}" required>
                                                @endif
                                                <span>{{$option->option_text}}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    <div style="display: flex; justify-content: flex-end; margin-top: 8px;">
                                        <button type="submit" class="btn btn-primary btn-sm">Cast Vote</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    @endif

                    <!-- Post Actions -->
                    <div class="post-action-row">
                        <div class="post-actions-left">
                            <form action="/posts/{{$post->id}}/like" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="post-action-btn {{$post->isLikedBy(auth()->id()) ? 'active' : ''}}" aria-label="Like post">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                                    <span>{{$post->likesCount()}}</span>
                                    <span class="btn-text">Like</span>
                                </button>
                            </form>
                            <form action="/posts/{{$post->id}}/dislike" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="post-action-btn {{$post->isDislikedBy(auth()->id()) ? 'active' : ''}}" aria-label="Dislike post">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(180deg);"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                                    <span>{{$post->dislikesCount()}}</span>
                                </button>
                            </form>
                            <button type="button" class="post-action-btn" onclick="toggleComments({{$post->id}})" aria-label="Comments">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                <span>{{$post->commentsCount()}}</span>
                                <span class="btn-text">Comments</span>
                            </button>
                        </div>

                        @if(auth()->id() == $post->user_id && $post->lost_and_found && !$post->resolved)
                            <form action="/mark-resolved/{{$post->id}}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary btn-sm">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                    Mark as solved
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section" id="comment-section-{{$post->id}}" style="display: none;">
                        @foreach($post->comments->sortByDesc('created_at') as $comment)
                            <div class="comment-item">
                                <div class="avatar sm">{{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}</div>
                                <div class="comment-bubble">
                                    <div class="comment-author-line">
                                        <span class="comment-author-name">{{$comment->user->name ?? 'Student'}}</span>
                                        <span class="comment-time">{{$comment->created_at->format('M j, Y \a\t g:i A')}}</span>
                                    </div>
                                    <div>{{$comment->comment}}</div>
                                </div>
                            </div>
                        @endforeach

                        <form action="/posts/{{$post->id}}/comment" method="POST" class="comment-input-row">
                            @csrf
                            <div class="avatar sm">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                            <input type="text" name="comment" placeholder="Write a comment..." required>
                            <button type="submit" class="btn btn-primary btn-sm">Post</button>
                        </form>
                    </div>
                </article>
                @empty
                <div class="card empty-state">
                    <svg width="120" height="72" viewBox="0 0 120 72" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path d="M0 48 Q45 28 90 42 Q110 46 120 52 L120 72 L0 72 Z" fill="#D5DEC8" />
                        <path d="M0 58 Q35 44 80 52 Q105 56 120 64 L120 72 L0 72 Z" fill="#91A77C" />
                        <polygon points="24,30 18,48 30,48" fill="#526747" />
                        <polygon points="36,24 28,45 44,45" fill="#526747" />
                        <polygon points="76,28 70,47 82,47" fill="#526747" />
                        <polygon points="90,34 84,50 96,50" fill="#526747" />
                        <path d="M48 72 C50 64 54 58 58 52 C62 58 66 64 68 72 Z" fill="#F5F3EA" />
                    </svg>
                    <div style="font-size: 14px;">No posts yet. Be the first to share something with BRACU Social!</div>
                </div>
                @endforelse
            </div>
        </section>

        <!-- Right Sidebar -->
        <aside class="sidebar-right" aria-label="Campus Highlights">
            <div class="sidebar-sticky">
                <!-- Card 1: Upcoming Events -->
                <div class="card">
                    <div class="sidebar-heading-row">
                        <h2>Upcoming events</h2>
                        <button class="text-link" onclick="openEventModal()">See all</button>
                    </div>
                    <div class="events-list-compact" id="sidebar-upcoming-events">
                        <div class="text-muted" style="padding: 8px 0;">Loading events...</div>
                    </div>
                </div>

                <!-- Card 2: Calendar Preview -->
                <div class="card">
                    <div class="sidebar-heading-row">
                        <h2 id="calendar-month-label">Calendar</h2>
                    </div>
                    <div class="calendar-preview-grid" id="sidebar-calendar-grid"></div>
                </div>

                <!-- Card 3: Account Info -->
                <div class="card">
                    <div class="sidebar-heading-row">
                        <h2>My Profile Info</h2>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 8px; font-size: 14px;">
                        <div><strong>Name:</strong> {{ auth()->user()->name }}</div>
                        <div class="text-muted"><strong>Dept:</strong> {{ auth()->user()->department }}</div>
                        <div class="text-muted"><strong>ID:</strong> {{ auth()->user()->student_id }}</div>
                    </div>
                </div>
            </div>
        </aside>
    </main>

    <!-- Mobile Bottom Navigation Bar -->
    <nav class="bottom-nav-bar" aria-label="Mobile Navigation">
        <button class="bottom-nav-btn active" onclick="setFeedFilter('all')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span>Home</span>
        </button>
        <button class="bottom-nav-btn" onclick="openChatDrawer()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
            <span>Messages</span>
        </button>
        <button class="bottom-nav-btn" onclick="openEventModal()">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <span>Events</span>
        </button>
        <button class="bottom-nav-btn" onclick="setFeedFilter('lost')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
            <span>Lost & Found</span>
        </button>
        <button class="bottom-nav-btn" onclick="setFeedFilter('poll')">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="20" x2="12" y2="10"></line><line x1="18" y1="20" x2="18" y2="4"></line><line x1="6" y1="20" x2="6" y2="16"></line></svg>
            <span>Polls</span>
        </button>
        <a href="/profile" class="bottom-nav-btn">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span>Profile</span>
        </a>
    </nav>

    <!-- Event Board Modal -->
    <div class="modal-backdrop" id="event-modal-backdrop">
        <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="event-modal-title">
            <div class="modal-header">
                <h3 id="event-modal-title">Upcoming Campus Events</h3>
                <button class="icon-btn" onclick="closeEventModal()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>
            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                    <button class="btn btn-secondary btn-sm" id="prev-month">◀ Prev</button>
                    <strong id="modal-month-label"></strong>
                    <button class="btn btn-secondary btn-sm" id="next-month">Next ▶</button>
                </div>
                <div class="calendar-preview-grid" id="modal-calendar-grid" style="font-size: 13px;"></div>
                <div class="text-muted" style="margin-top: 12px; font-size: 13px;">
                    Click any date to add or update an event. Leave blank and submit to delete.
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Drawer -->
    <div class="chat-drawer" id="chat-drawer">
        <div class="chat-drawer-header">
            <span>Student Chat</span>
            <button class="icon-btn" style="color: #FFFFFF;" onclick="closeChatDrawer()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>
        <div class="chat-drawer-body">
            <div class="chat-drawer-users" id="chat-users-list"></div>
            <div class="chat-drawer-thread">
                <div class="chat-drawer-messages" id="chat-messages-container"></div>
                <div class="chat-drawer-input">
                    <input type="text" id="chat-input-text" placeholder="Type a message...">
                    <button class="btn btn-primary btn-sm" id="chat-send-btn">Send</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast-message" class="toast" role="status"></div>

    <script>
        function toggleComments(postId) {
            const commentSection = document.getElementById(`comment-section-${postId}`);
            if (commentSection) {
                commentSection.style.display = (commentSection.style.display === 'none') ? 'flex' : 'none';
            }
        }

        function togglePostMenu(postId) {
            const menu = document.getElementById(`post-menu-${postId}`);
            if (!menu) return;
            const isOpen = menu.classList.contains('open');
            document.querySelectorAll('.post-menu-dropdown').forEach(m => m.classList.remove('open'));
            if (!isOpen) menu.classList.add('open');
        }

        function togglePopover(popoverId) {
            const p = document.getElementById(popoverId);
            if (!p) return;
            const isOpen = p.classList.contains('open');
            closeAllPopovers();
            if (!isOpen) p.classList.add('open');
        }

        function closeAllPopovers() {
            document.querySelectorAll('.popover-menu').forEach(m => m.classList.remove('open'));
        }

        document.addEventListener('click', function(e) {
            if (!e.target.closest('.header-search')) {
                const results = document.getElementById('search-results');
                if (results) results.style.display = 'none';
            }
            if (!e.target.closest('.header-right')) {
                closeAllPopovers();
            }
            if (!e.target.closest('.post-menu-dropdown') && !e.target.closest('[aria-label="Post options"]')) {
                document.querySelectorAll('.post-menu-dropdown').forEach(m => m.classList.remove('open'));
            }
        });

        // Composer Expansion
        function expandComposer() {
            document.getElementById('composer-collapsed-view').style.display = 'none';
            document.getElementById('composer-expanded-view').style.display = 'flex';
        }

        function collapseComposer() {
            document.getElementById('composer-expanded-view').style.display = 'none';
            document.getElementById('composer-collapsed-view').style.display = 'flex';
        }

        // Image upload preview
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('preview-img').src = e.target.result;
                        document.getElementById('image-preview').style.display = 'block';
                        document.getElementById('remove-img-btn').style.display = 'inline-flex';
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        function removeImage() {
            if (imageInput) imageInput.value = '';
            document.getElementById('image-preview').style.display = 'none';
            document.getElementById('preview-img').src = '';
            document.getElementById('remove-img-btn').style.display = 'none';
        }

        // Poll Toggles
        function togglePollSection() {
            const checkbox = document.getElementById('has_poll_checkbox');
            const pollSection = document.getElementById('poll-section');
            const titleInput = document.getElementById('post_title');
            const bodyInput = document.getElementById('post_body');
            const pill = document.getElementById('poll-toggle-pill');

            if (checkbox.checked) {
                pollSection.style.display = 'flex';
                pill.classList.add('active');
                titleInput.required = false;
                bodyInput.required = false;
            } else {
                pollSection.style.display = 'none';
                pill.classList.remove('active');
                titleInput.required = true;
                bodyInput.required = true;
            }
        }

        function toggleLfSection() {
            const checkbox = document.getElementById('has_lf_checkbox');
            const pill = document.getElementById('lf-toggle-pill');
            if (checkbox.checked) {
                pill.classList.add('active');
            } else {
                pill.classList.remove('active');
            }
        }

        function toggleAnonymous(input) {
            const ui = document.getElementById('anon-switch-ui');
            const label = document.getElementById('composer-anon-label');
            const avatar = document.getElementById('composer-avatar');
            ui.classList.toggle('active', input.checked);
            if (input.checked) {
                label.style.display = 'inline';
                avatar.textContent = '?';
                avatar.classList.add('anonymous');
            } else {
                label.style.display = 'none';
                avatar.textContent = "{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}";
                avatar.classList.remove('anonymous');
            }
        }

        function addPollOption() {
            const container = document.getElementById('poll-options-container');
            const count = container.querySelectorAll('.poll-option-input-row').length;
            if (count < 6) {
                const row = document.createElement('div');
                row.className = 'poll-option-input-row';
                row.innerHTML = `<input type="text" name="poll_options[]" placeholder="Option ${count + 1}">`;
                container.appendChild(row);
            }
        }

        // Feed Filter switching
        function setFeedFilter(filter) {
            ['nav-btn-home', 'nav-btn-lostfound', 'nav-btn-polls'].forEach(id => {
                const btn = document.getElementById(id);
                if (btn) btn.classList.remove('active');
            });

            const cards = document.querySelectorAll('.post-card');
            const titleElem = document.getElementById('feed-page-title');
            const subElem = document.getElementById('feed-page-subtitle');

            if (filter === 'lost') {
                const btn = document.getElementById('nav-btn-lostfound');
                if (btn) btn.classList.add('active');
                titleElem.textContent = "Lost & Found";
                subElem.textContent = "Help items find their way back to their owners.";
                cards.forEach(c => {
                    c.style.display = (c.getAttribute('data-lost-and-found') === '1') ? '' : 'none';
                });
            } else if (filter === 'poll') {
                const btn = document.getElementById('nav-btn-polls');
                if (btn) btn.classList.add('active');
                titleElem.textContent = "Polls";
                subElem.textContent = "Vote and see what students think.";
                cards.forEach(c => {
                    c.style.display = (c.getAttribute('data-has-poll') === '1') ? '' : 'none';
                });
            } else {
                const btn = document.getElementById('nav-btn-home');
                if (btn) btn.classList.add('active');
                titleElem.textContent = "Community Feed";
                subElem.textContent = "What’s happening at BRACU today.";
                cards.forEach(c => c.style.display = '');
            }
        }

        // Search functionality
        let searchTimeout;
        const searchInput = document.getElementById('user-search');
        const searchResults = document.getElementById('search-results');

        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                clearTimeout(searchTimeout);
                if (query.length < 2) {
                    searchResults.style.display = 'none';
                    return;
                }
                searchTimeout = setTimeout(() => {
                    fetch(`/search-users?query=${encodeURIComponent(query)}`)
                        .then(r => r.json())
                        .then(users => {
                            if (users.length === 0) {
                                searchResults.innerHTML = '<div style="padding: 14px; text-align: center;" class="text-muted">No students found</div>';
                            } else {
                                searchResults.innerHTML = users.map(u => `
                                    <div class="search-result-row" onclick="window.location.href='/user/${u.id}'">
                                        <div class="avatar sm">${u.name.charAt(0).toUpperCase()}</div>
                                        <div>
                                            <div style="font-weight: 600; font-size: 14px;">${u.name}</div>
                                            <div class="text-muted">${u.department} · ID: ${u.student_id}</div>
                                        </div>
                                    </div>
                                `).join('');
                            }
                            searchResults.style.display = 'block';
                        })
                        .catch(() => {
                            searchResults.style.display = 'none';
                        });
                }, 300);
            });
        }

        // Event Board logic
        const eventBackdrop = document.getElementById('event-modal-backdrop');
        let currentYear, currentMonth;
        let dateToEventName = {};

        function openEventModal() {
            if (eventBackdrop) eventBackdrop.style.display = 'flex';
            const now = new Date();
            currentYear = now.getFullYear();
            currentMonth = now.getMonth();
            fetchEvents().then(renderCalendar);
        }

        function closeEventModal() {
            if (eventBackdrop) eventBackdrop.style.display = 'none';
        }

        function fetchEvents() {
            return fetch('/events')
                .then(r => r.json())
                .then(items => {
                    dateToEventName = {};
                    items.forEach(it => {
                        if (it.name) dateToEventName[it.event_date] = it.name;
                    });
                    renderSidebarEvents(items);
                })
                .catch(() => { dateToEventName = {}; });
        }

        function renderSidebarEvents(items) {
            const container = document.getElementById('sidebar-upcoming-events');
            if (!container) return;
            if (!items || items.length === 0) {
                container.innerHTML = '<div class="text-muted" style="padding: 8px 0;">No upcoming events.</div>';
                return;
            }
            container.innerHTML = items.slice(0, 3).map(it => {
                const d = new Date(it.event_date + 'T00:00:00');
                return `
                    <div class="event-row-compact" onclick="openEventModal()">
                        <div class="date-block-48">
                            <span class="day-num">${d.getDate()}</span>
                            <span class="month-abbr">${d.toLocaleString('default', { month: 'short' })}</span>
                        </div>
                        <div class="event-compact-info">
                            <div class="event-compact-title">${it.name}</div>
                            <div class="text-muted">${it.event_date}</div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function renderCalendar() {
            const grid = document.getElementById('modal-calendar-grid');
            const sideGrid = document.getElementById('sidebar-calendar-grid');
            const monthLabel = document.getElementById('modal-month-label');
            const sideMonthLabel = document.getElementById('calendar-month-label');

            const firstDay = new Date(currentYear, currentMonth, 1);
            const startWeekday = (firstDay.getDay() + 6) % 7;
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

            const monthStr = firstDay.toLocaleString('default', { month: 'long', year: 'numeric' });
            if (monthLabel) monthLabel.textContent = monthStr;
            if (sideMonthLabel) sideMonthLabel.textContent = monthStr;

            const weekdays = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
            let html = weekdays.map(w => `<div class="cal-preview-day-header">${w}</div>`).join('');

            for (let i = 0; i < startWeekday; i++) {
                html += `<div class="cal-preview-cell empty"></div>`;
            }

            for (let d = 1; d <= daysInMonth; d++) {
                const iso = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const hasEvent = !!dateToEventName[iso];
                html += `
                    <div class="cal-preview-cell ${hasEvent ? 'has-event' : ''}" onclick="onCalendarCellClick('${iso}')">
                        ${d}
                    </div>
                `;
            }

            if (grid) grid.innerHTML = html;
            if (sideGrid) sideGrid.innerHTML = html;
        }

        function onCalendarCellClick(iso) {
            const current = dateToEventName[iso] || '';
            const name = prompt(`Set campus event for ${iso}:`, current);
            if (name === null) return;
            const trimmed = name.trim();

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (trimmed === '') {
                fetch('/events', {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ event_date: iso })
                }).then(() => { delete dateToEventName[iso]; renderCalendar(); });
            } else {
                fetch('/events', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
                    body: JSON.stringify({ event_date: iso, name: trimmed })
                }).then(r => r.json()).then(() => { dateToEventName[iso] = trimmed; renderCalendar(); });
            }
        }

        document.getElementById('prev-month')?.addEventListener('click', () => {
            if (currentMonth === 0) { currentMonth = 11; currentYear--; } else { currentMonth--; }
            renderCalendar();
        });

        document.getElementById('next-month')?.addEventListener('click', () => {
            if (currentMonth === 11) { currentMonth = 0; currentYear++; } else { currentMonth++; }
            renderCalendar();
        });

        // Chat Drawer logic
        const chatDrawer = document.getElementById('chat-drawer');
        const chatUsersDiv = document.getElementById('chat-users-list');
        const chatMsgsDiv = document.getElementById('chat-messages-container');
        const chatInput = document.getElementById('chat-input-text');
        const chatSend = document.getElementById('chat-send-btn');
        let activeChatId = null;
        let lastMsgId = 0;
        let chatPollTimer = null;
        let renderedMsgIds = new Set();

        function openChatDrawer() {
            if (chatDrawer) chatDrawer.style.display = 'flex';
            loadChatUsers();
        }

        function closeChatDrawer() {
            if (chatDrawer) chatDrawer.style.display = 'none';
            if (chatPollTimer) { clearInterval(chatPollTimer); chatPollTimer = null; }
        }

        function loadChatUsers() {
            fetch('/chat/users')
                .then(r => r.json())
                .then(users => {
                    chatUsersDiv.innerHTML = users.map(u => `
                        <div class="chat-user-row" data-id="${u.id}">${u.name}</div>
                    `).join('');

                    if (users.length > 0 && !activeChatId) {
                        const first = chatUsersDiv.querySelector('.chat-user-row');
                        if (first) {
                            first.classList.add('active');
                            activeChatId = parseInt(first.getAttribute('data-id'));
                            loadChatMessages(true).then(startChatPolling);
                        }
                    }
                });
        }

        function loadChatMessages(initial = false) {
            if (!activeChatId) return Promise.resolve();
            const qs = lastMsgId ? `?since_id=${lastMsgId}` : '';
            return fetch(`/chat/messages/${activeChatId}${qs}`)
                .then(r => r.json())
                .then(msgs => {
                    if (initial) {
                        chatMsgsDiv.innerHTML = '';
                        renderedMsgIds = new Set();
                    }
                    msgs.forEach(m => {
                        if (renderedMsgIds.has(m.id)) return;
                        const div = document.createElement('div');
                        div.className = 'chat-msg ' + (m.sender_id === {{ auth()->id() }} ? 'out' : 'in');
                        div.textContent = m.body;
                        chatMsgsDiv.appendChild(div);
                        renderedMsgIds.add(m.id);
                        lastMsgId = Math.max(lastMsgId, m.id);
                    });
                    chatMsgsDiv.scrollTop = chatMsgsDiv.scrollHeight;
                });
        }

        function startChatPolling() {
            if (chatPollTimer) clearInterval(chatPollTimer);
            chatPollTimer = setInterval(() => loadChatMessages(false), 2000);
        }

        chatUsersDiv?.addEventListener('click', (e) => {
            const item = e.target.closest('.chat-user-row');
            if (!item) return;
            chatUsersDiv.querySelectorAll('.chat-user-row').forEach(it => it.classList.remove('active'));
            item.classList.add('active');
            activeChatId = parseInt(item.getAttribute('data-id'));
            lastMsgId = 0;
            loadChatMessages(true).then(startChatPolling);
        });

        chatSend?.addEventListener('click', () => {
            if (!activeChatId) return;
            const body = chatInput.value.trim();
            if (!body) return;

            fetch(`/chat/messages/${activeChatId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ body })
            }).then(r => r.json()).then(m => {
                chatInput.value = '';
                if (!renderedMsgIds.has(m.id)) {
                    const div = document.createElement('div');
                    div.className = 'chat-msg out';
                    div.textContent = m.body;
                    chatMsgsDiv.appendChild(div);
                    renderedMsgIds.add(m.id);
                }
                lastMsgId = Math.max(lastMsgId, m.id);
                chatMsgsDiv.scrollTop = chatMsgsDiv.scrollHeight;
            });
        });

        chatInput?.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                chatSend.click();
            }
        });

        // Initialize events on page load
        document.addEventListener('DOMContentLoaded', () => {
            const now = new Date();
            currentYear = now.getFullYear();
            currentMonth = now.getMonth();
            fetchEvents().then(renderCalendar);
        });
    </script>
</body>
</html>
