<?php

if (empty($podcast)) {
    echo '<h2 style="color:white;text-align:center;">404!<br>Podcast not found</h2>';
    return;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Bindhu Art Regiment , ART and Literature">
    <title><?= $podcast->title ?> | Podcasts | Bindhu Art Regiment</title>
</head>
<script>
    window.addEventListener("load", function() {
        setTimeout(function() {
            document.body.style.visibility = "visible";
        }, 300);
    });
</script>
<link rel="stylesheet" href="/assets/css/mainx.css" async>

<body>
    <div class="foreground">
        <nav>
            <nav class="navbar_cover">
                <div class="section_1">
                    <div class="main_logo">
                        <a href="/">
                            <img src="/images/logo/mainlogo.png" width="215.82px" height="100px" class="BAR_logo" alt="Bindhu Art Regiment" style="filter: invert();">
                        </a>
                    </div>
                </div>
                <div class="section_2">
                    <div class="explor_main">
                        <a href="#getintouch">
                            <button class="explore">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span> GET IN TOUCH
                            </button>
                        </a>
                    </div>
                    <div class="hamburger_menu_cover">
                        <button class="btn-menu" onclick="show()">
                            <span class="icon">
                                <svg viewBox="0 0 175 80" width="40" height="40">
                                    <rect width="80" height="15" fill="#000" rx="10"></rect>
                                    <rect y="30" width="80" height="15" fill="#000" rx="10"></rect>
                                    <rect y="60" width="80" height="15" fill="#000" rx="10"></rect>
                                </svg>
                            </span>
                            <span class="text">MENU</span>
                        </button>
                        <div id="menu_on_click">
                        <ul class="click_menu">
                                <li class="click_menu" onclick="donotshow()"><a href="/artists" class="click_menu">ARTIST PROFILE</a></li>
                                <li class="click_menu" onclick="donotshow()"><a href="/event-projects" class="click_menu">EVENT AND PROJECTS</a></li>
                                <li class="click_menu" onclick="donotshow()"><a href="/podcasts" class="click_menu">PODCAST</a></li>
                                <li class="click_menu" onclick="donotshow()"><a href="/about-us" class="click_menu">OUR
                                        TEAM</a></li>
                                <li class="click_menu" onclick="donotshow()"><a href="/support-us" class="click_menu">SUPPORT US</a></li>
                            </ul>
                            <div class="cross">
                                <img src="/images/cancel-circle.svg" alt="cancel" onclick="donotshow()">
                            </div>

                        </div>

                    </div>

                </div>
            </nav>
        </nav>

        <div id="content">


            <nav class="nav_cover">
                <div class="section_1--art">
                    <a href="/podcasts">
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
                <div class="art_bill" style="display: flex; justify-content: center; align-items: center;overflow: visible;">
                    <div class="semi_circle" style="position: absolute;z-index: -1;">

                    </div>
                    <h1 class="pnc">
                        <?= wordwrap($podcast->title, 20, '<br>') ?>
                    </h1>
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

                <div class="audio-player" id="player">
                    <?php if ($podcast->soundcloud_url) : ?>
                        <audio controls>
                            <source src="<?= $podcast->soundcloud_url; ?>" type="audio/mpeg">
                            <source src="/uploads/<?= $podcast->audio_file_path ?>" type="audio/mpeg">
                        </audio>
                    <?php else : ?>
                        <audio controls>
                            <source src="/uploads/<?= $podcast->audio_file_path ?>" type="audio/mpeg">
                        </audio>
                    <?php endif; ?>
                </div>

            </div>

        </div>


        <div class="footer_wrap">
            <div class="footer">
            </div>
            <div class="F_A_S">
                <div class="f_s_w">
                    <div class="f_s_1">
                        <div class="reachout_f">
                            <H4>REACH OUT</H4>
                        </div>
                        <div class="info_footer">
                            <h3>
                                bindhuartregiment<br>
                                @gmail.com,<br>
                                +977 9702503767<br>
                                Kathmandu,<br>
                                Nepal
                            </h3>
                        </div>
                    </div>
                    <div class="f_s_2">
                        <div class="getnotified_f">
                            <h4>
                                GET NOTIFIED
                            </h4>
                        </div>
                        <div class="GETOUTEART_f">
                            <h3>
                                get our <br>
                                every<br>
                                article
                            </h3>
                        </div>
                        <form action="/" method="post">
                            <div class="wave-group-f">
                                <input required="" type="email" class="input-f" name="subscriber_email" autocomplete="off" required oninvalid="this.setCustomValidity('Please enter valid email !')">
                                <span class="bar-f"></span>
                                <label class="label-f">
                                    <span class="label-char-f" style="--index: 0">E</span>
                                    <span class="label-char-f" style="--index: 1">M</span>
                                    <span class="label-char-f" style="--index: 2">A</span>
                                    <span class="label-char-f" style="--index: 3">I</span>
                                    <span class="label-char-f" style="--index: 3">L</span>
                                </label>
                            </div>
                            <button class="cta--se" value="submit">
                                <span>SUBMIT</span>
                                <svg viewBox="0 0 13 10" height="10px" width="15px">
                                    <path d="M1,5 L11,5"></path>
                                    <polyline points="8 1 12 5 8 9"></polyline>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="line_f">

                </div>
                <div class="footer_end">
                    <a href="#privacypolicy">
                        <div class="privacy_policy">
                            privacy policy
                        </div>
                    </a>
                    <div class="socials">
                        <div class="soc_text">socials</div>
                        <div class="images_social">
                            <a href="https://www.facebook.com/100093439433363" class="facebook" target="_blank">
                                <img src="/images/images/facebook.svg" width="45px" height="45px" alt="fbimg" class="fbimg">
                            </a>
                            <a href="https://www.instagram.com/bindhuart.reg/" class="instagram" target="_blank">
                                <img src="/images/images/instagram.svg" width="45px" height="45px" alt="instaimg" class="instaimg">
                            </a>
                            <a href="https://twitter.com" class="twitter" target="_blank">
                                <img src="/images/images/twitter.svg" width="45px" height="45px" alt="tweetimg" class="tweetimg">
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="background">
            <div class="follow_light">
                <div id="blobby">
                </div>
                <div id="blurbg"></div>
            </div>
        </div>


        <!-- <script src="/js/mainx.js?v=1.0.5"></script> -->
        <script src="/js/nav.js?v=1.0.5"></script>
        <link rel="stylesheet" href="/assets/css/project.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/getintouch.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/articlemain.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/podcastmain.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/article.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/podcast.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/wre.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/aboutus.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/collab.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/privacypolicy.css?v=1.0.5">
        <link rel="stylesheet" href="/assets/css/artistprofile.css?v=1.0.5">


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

        <script>
            (function() {
                fetch('https://soundcloud.com/oembed?' + new URLSearchParams({
                    format: 'json',
                    maxheight: '166',
                    url: '<?= $podcast->soundcloud_url ?>'
                })).then(response => response.json()).then(data => {
                    try {
                        const div = document.createElement('div');
                        div.innerHTML = data.html;
                        const groups = decodeURIComponent(div.firstChild.src).match(/^.*\/\/api\.soundcloud\.com\/(?<type>[[a-z]*)\/(?<id>\d*)/).groups;
                        const embededCode = `<iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" 
                src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/${groups.id}&color=%23ff5500&auto_play=true&hide_related=true&show_comments=true&show_user=true&show_reposts=false&show_teaser=false"></iframe>
                <div style="font-size: 10px; color: #333;line-break: anywhere;word-break: normal;overflow: hidden;white-space: nowrap;text-overflow: ellipsis; font-family: Interstate,Lucida Grande,Lucida Sans Unicode,Lucida Sans,Garuda,Verdana,Tahoma,sans-serif;font-weight: 100;">
                    <a href="${data.author_url}" title="${data.author_name}" target="_blank" style="color: #333; text-decoration: none;">
                        ${data.author_name}
                    </a> ·
                    <a href="<?= $podcast->soundcloud_url ?>" title="${data.title}" target="_blank" style="color: #333; text-decoration: none;">
                        ${data.title}
                    </a>
                </div>`;
                        document.getElementById('player').innerHTML = embededCode;
                        console.log(data);
                    } catch (error) {
                        console.error(error);
                    }
                }).catch(error => {
                    console.error(error);
                    console.log('Failed to embed soundcloud player');
                });
            })();
        </script>

</body>

</html>