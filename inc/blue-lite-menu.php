<?php

/** 
 * Dynamic Mobile Menu Breakpoint CSS
 */

$bp_min = get_theme_mod('blue_lite_mobile_menu_breakpoint', 768);
$bp_max = $bp_min + 1;  

?>

<style>
    /* BLUE LITE MENU - Base Styles */
    .nav-menu {
        border-radius: 5px;
        background-color: #48649F;
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
    }

    .nav-menu li {
        z-index: 1000;
        position: relative;
    }

    .nav-menu li a {
        border-radius: 5px;
        display: block;
        padding: 8px;
        text-decoration: none;
        background-color: #48649F;
        color: #fff;
    }

    .nav-menu li a:hover {
        background-color: #428BCA;
    }

    .nav-menu li ul {
        display: none;
        position: absolute;
        background-color: #48649F;
        margin: 0;
        list-style: none;
    }

    /* Menu Toggle Button */
    .menu-toggle {
        display: none;
        background-color: #48649F;
        color: #fff;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        border-radius: 5px;
        margin: 0px 0;
    }

    .menu-toggle:hover {
        background-color: #428BCA;
    }


    /* Desktop Navigation */
    @media (min-width: <?php echo esc_attr($bp_max); ?>px) {

        .menu-toggle,
        .submenu-toggle {
            display: none;
        }

        /* Add padding to main navigation bar */
        .nav-menu {
            padding: 5px 10px;
        }

        /* Add spacing between top-level items */
        .nav-menu>li {
            margin: 0 2px;
        }

        .nav-menu li:hover>ul {
            display: block;
            background-color: transparent;
        }

        .nav-menu li ul li a {
            padding: 8px;
        }

        .nav-menu li ul {
            min-width: 200px;
            padding: 5px 0;
            /* Add vertical padding to dropdowns */
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .nav-menu li ul li {
            width: 100%;
        }

        .nav-menu li ul li a {
            padding: 10px 15px;
            white-space: nowrap;
            transition: background-color 0.5s;
        }

        .nav-menu li:hover>ul {
            display: block;
            background-color: #48649F;
            margin-top: 0px;
            /* Add gap between parent and dropdown */
        }

        /* Improve dropdown accessibility */
        .nav-menu {
            position: relative;
            z-index: 1000;
        }

        .nav-menu li {
            position: relative;
            z-index: 1001;
        }

        .nav-menu li ul {
            min-width: 200px;
            padding: 5px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            z-index: 1002;
            position: absolute;
            top: 100%;
            left: 0;
        }

        /* Handle nested dropdowns */
        .nav-menu li ul li ul {
            top: 0;
            left: 100%;
            margin-left: 1px;
            z-index: 1003;
        }

        /* Extend hover area */
        .nav-menu li ul:before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            width: 100%;
            height: 10px;
        }

        .nav-menu li:hover>ul {
            display: block;
            background-color: #48649F;
            margin-top: 5px;
        }

        .nav-menu li ul li a {
            padding: 10px 15px;
            white-space: nowrap;
            transition: background-color 0.5s;
            display: block;
        }

        /* Add dropdown indicators */
        .nav-menu li.menu-item-has-children>a:after {
            content: '▾';
            margin-left: 5px;
            display: inline-block;
        }

        .nav-menu li ul li.menu-item-has-children>a:after {
            content: '▸';
            float: right;
            margin-left: 5px;
        }

        /* Dropdown container */
        .nav-menu li ul {
            min-width: 250px;
            padding: 5px;
            background-color: transparent;
            border-radius: 5px;
            box-shadow: 0 2px 1px rgba(0, 0, 0, 0.2);
            z-index: 1002;
        }

        /* Dropdown items as buttons */
        .nav-menu li ul li a {
            background-color: #48649F;
            color: #fff;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-menu li ul li a:hover {
            background-color: #428BCA;
        }

        /* Fix nested dropdowns */
        .nav-menu li ul li ul {
            top: -10px;
            /* Account for parent padding */
            left: 100%;
            margin-left: 1px;
        }

        /* Remove double background from container */
        .nav-menu li:hover>ul {
            display: block;
            background-color: transparent;
            margin-top: 5px;
        }

        /* Fix submenu indicators */
        .nav-menu li ul li.menu-item-has-children>a:after {
            content: '▸';
            float: right;
            margin-left: 8px;
            color: #ffffff;
        }
    }


    /* Mobile Navigation */
    @media (max-width: <?php echo esc_attr($bp_min); ?>px) {

        /* Menu Structure */
        .nav-menu {
            display: none;
            flex-direction: column;
        }

        .nav-menu.active {
            display: flex;
        }

        .nav-menu li {
            width: 100%;
            padding: 0;
            position: relative;
        }

        .nav-menu li a {
            padding: 15px 50px 15px 15px;
            border-radius: 0;
        }

        .nav-menu li:not(:last-child)>a {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Submenu Styles */
        .nav-menu li ul {
            position: static;
            width: 100%;
            padding-left: 20px;
            display: none;
        }

        .nav-menu li ul li {
            width: 100%;
        }

        .nav-menu li ul li a {
            padding: 12px 15px;
            background-color: #3a517f;
        }

        .nav-menu li:hover ul {
            display: none;
        }

        .nav-menu li.show-submenu>ul {
            display: block;
        }

        /* Toggle Buttons */
        .menu-toggle {
            display: block;
            padding: 14px 15px;
        }

        .submenu-toggle {
            position: absolute;
            right: 0;
            top: 0;
            width: 48px;
            height: 48px;
            background: rgba(0, 0, 0, 0.1);
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .submenu-toggle:hover {
            background: rgba(0, 0, 0, 0.2);
        }
    }
</style>