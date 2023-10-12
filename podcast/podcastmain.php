<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="Bindhu Art Regiment , ART and Literature">
    <title>Podcasts | Bindhu Art Regiment</title>
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
            <div class="billboard_1_pod">
                <div class="billboard_2_pod">
                    <h1 class="tell">
                        Our
                        <br>
                        Podcast
                    </h1>
                    <div class="subscribe_box">
                        <p class="subscribe">Browse our podcast</p>
                    </div>
                </div>
            </div>

            <div class="wlc->podcast">
                <p class="wlc->podcast">
                    Let's amplify our Voice <br><br>
                    We intend to meet and talk with creators employing art as reflection of individuals and collectives to inspire
                    positivity and awareness. We highly appreciate the creator's abilities to respond to the world around us and
                    truly grateful for creating impacts in needed circumstances. In our podcast we feature artists and communities
                    who are overshadowed in contemporary times. Let's together celebrate the freedom of expression of all artists.
                </p>
            </div>

            <?php
            $podcasts = ORM::table('podcasts')->orderBy('created_at', 'desc')->get();
            ?>

            <div class="all_episodes">
                <div class="allep_title">
                    <h1>ALL EPISODES</h1>
                </div>
                <?php foreach ($podcasts as $podcast) : ?>
                    <div class="poet1">
                        <div class="poetimg">
                            <img src="/uploads/<?= $podcast->thumbnail ?>" width="300px" height="" alt="Bindu Art Regiment">
                        </div>
                        <div class="poetdetails">
                            <div class="poettitle">
                                <h4><?= $podcast->title ?> | <?= formatDuration($podcast->duration) ?></h4>
                            </div>
                            <div class="poetsubtitle">
                                <h6><?= nDate($podcast->created_at) ?></h6>
                            </div>
                            <div class="podpoetinfo">
                                <p><?= str_limit(strip_tags($podcast->description), 200) ?></p>
                            </div>
                            <div class="poet_listen_pods">
                                <a href="/podcasts/<?= slugify($podcast->title, $podcast->id) ?>" style="display: flex;align-items:center">
                                    <p>
                                        LISTEN PODS
                                    </p>
                                    <div class="play">
                                        <img src="/images/play3.svg" alt="listen podcast">
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
</body>

</html>