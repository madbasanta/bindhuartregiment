<?php 
    $podcast = ORM::table('podcasts')->find($_GET['id'] ?? 0);
    if(empty($podcast)) {
        echo '<h2 style="color:white;text-align:center;">404!<br>Podcast not found</h2>';
        return;
    }
?>

<nav class="nav_cover">
    <div class="section_1--art">
        <a href="#podcastmain">
            <div class="cover_arrowdown">
                <div class="animated_arrow_cover">

                    <div class="animated_arrow">

                        <div class="coverarrow">
                            <img src="/article/images/arrow-left.svg" alt="imga" class="arrowimgafter">
                            <img src="/article/images/arrow-left-white.svg" alt="img" class="arrowimg">
                        </div>

                    </div>
                </div>
            </div>
            <div class="back">
                <img src="/article/images/arrow-left-white.svg" alt="back" class="back">
            </div>
        </a>


    </div>
    <div class="section_2--art">
        <div class="explore_pod">
            <a href="#getintouch">
                <button class="explore_pod">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <p class="getintouch">GET IN TOUCH</p>
                </button>
            </a>
        </div>

    </div>
</nav>



<div class="content_wrap">
    <div class="art_bill">
        <div class="semi_circle">
            <div class="pnc_cov" style="margin-top: 25%;">
                <h1 class="pnc">
                    <?= wordwrap($podcast->title, 20, '<br>') ?>
                </h1>
            </div>
        </div>
    </div>
    <div class="img_bill">
        <img src="/uploads/<?= $podcast->thumbnail ?>" alt="podcastimgbill" class="pod_bill">
    </div>

    <style>
        .poddesc a {
            color: #f50;
        }
    </style>
    <div class="?->a poddesc">
        <?= $podcast->description ?>
    </div>

    <div class="audio-player">
        <audio controls>
            <source src="/uploads/<?= $podcast->audio_file_path ?>" type="audio/mpeg">
        </audio>
    </div>
</div>

<style>
    @font-face {
        font-family: Poppins;
        font-weight: bold;
        src: url(/assets/css/fonts/Poppins/Poppins-Bold.ttf);
    }

    @font-face {
        font-family: Jost;
        src: url(/assets/css/fonts/Jost/Jost-VariableFont_wght.ttf);
    }

    @font-face {
        font-family: Poppins;
        src: url(/assets/css/fonts/Poppins/Poppins-Light.ttf);
        font-weight: lighter;
    }

    body {
        overflow-x: hidden;
    }

    a {
        text-decoration: none;
    }

    nav {
        display: none;
    }

    nav.navbar_cover {
        display: none;
    }

    nav.nav_cover {
        background: white;
        display: flex;
        justify-content: space-between;

    }

    img.arrowimgafter {
        transform: translateY(0);
        transform: translateX(140px);
    }

    .animated_arrow {
        border: solid black 2px;
    }

    .cover_arrowdown {
        justify-content: normal;
        margin-top: -75px;
        margin-left: -80px;

    }

    button.explore_pod {
        position: relative;
        padding: 1em 1.8em;
        outline: none;
        border: 1px solid black;
        background: transparent;
        color: black;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 15px;
        overflow: hidden;
        transition: 0.2s;
        border-radius: 20px;
        cursor: pointer;
        font-weight: bold;
    }

    button.explore_pod:hover {
        box-shadow: 0 0 10px #ae00ff, 0 0 25px #001eff, 0 0 50px #ae00ff;
        transition-delay: 0.6s;
        border-radius: 20px;
    }

    button.explore_pod span {
        position: absolute;
    }

    button.explore_pod span:nth-child(1) {
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #ae00ff);
    }

    button.explore_pod:hover span:nth-child(1) {
        left: 100%;
        transition: 0.7s;
    }

    button.explore_pod span:nth-child(3) {
        bottom: 0;
        right: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #001eff);
    }

    button.explore_pod:hover span:nth-child(3) {
        right: 100%;
        transition: 0.7s;
        transition-delay: 0.35s;
    }

    button.explore_pod span:nth-child(2) {
        top: -100%;
        right: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(180deg, transparent, #ae00ff);
    }

    button.explore_pod:hover span:nth-child(2) {
        top: 100%;
        transition: 0.7s;
        transition-delay: 0.17s;
    }

    button.explore_pod span:nth-child(4) {
        bottom: -100%;
        left: 0;
        width: 2px;
        height: 100%;
        background: linear-gradient(360deg, transparent, #001eff);
    }

    button.explore_pod:hover span:nth-child(4) {
        bottom: 100%;
        transition: 0.7s;
        transition-delay: 0.52s;
    }

    button.explore_pod:active {
        background: #ae00af;
        background: linear-gradient(to top right, #ae00af, #001eff);
        color: #bfbfbf;
        box-shadow: 0 0 8px #ae00ff, 0 0 8px #001eff, 0 0 8px #ae00ff;
        transition: 0.1s;
    }

    button.explore_pod:active span:nth-child(1) span:nth-child(2) span:nth-child(2) span:nth-child(2) {
        transition: none;
        transition-delay: none;
    }

    .explore_pod {
        margin: 5px;
        height: fit-content;
    }

    .back {
        display: none;
    }

    .section_2--art {
        display: flex;
        justify-content: space-between;
    }

    .explor_main {
        margin: 10px;
    }

    .checkout {
        margin: 10px;
        height: fit-content;
    }

    .cssbuttons-io-button {
        background: black;
        color: white;
        font-family: Poppins;
        padding: 0.35em;
        padding-left: 1.2em;
        font-size: 17px;
        font-weight: bold;
        border-radius: 0.9em;
        border: none;
        letter-spacing: 0.05em;
        display: flex;
        align-items: center;
        box-shadow: inset 0 0 1.6em -0.6em black;
        overflow: hidden;
        position: relative;
        height: 2.8em;
        padding-right: 3.3em;
    }

    .cssbuttons-io-button .icon {
        background: white;
        margin-left: 1em;
        position: absolute;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 2.2em;
        width: 2.2em;
        border-radius: 0.7em;
        box-shadow: 0.1em 0.1em 0.6em 0.2em black;
        right: 0.3em;
        transition: all 0.3s;
    }

    .cssbuttons-io-button:hover .icon {
        width: calc(100% - 0.6em);
    }

    .cssbuttons-io-button .icon svg {
        width: 1.1em;
        transition: transform 0.3s;
        color: black;
    }

    .cssbuttons-io-button:hover .icon svg {
        transform: translateX(0.1em);
    }

    .cssbuttons-io-button:active .icon {
        transform: scale(0.95);
    }

    button.explore_pod {
        color: black;
        border: 1px solid black;
    }

    @media only screen and (max-width: 500px) {
        .cover_arrowdown {
            display: none;
        }

        .back {
            display: block;
        }

        .section_1--art {
            width: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .explor_main {
            justify-content: center;
            display: flex;
            align-items: center;
        }

        button.cssbuttons-io-button {
            font-size: 10px;
        }

        button.explore_pod {
            font-size: 7px;
            width: 80px;
            height: 27px;
        }

        .section_2--art {
            align-items: center;
        }
    }
</style>