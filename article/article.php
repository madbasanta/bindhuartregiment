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

            <div class="" style="max-width: 1185px;margin: 50px auto;">
                <a href="#articlemain">
                    <div class="recents">
                        <button class="cta">
                            <span class="hover-underline-animation"> ARTICLES </span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" fill="black" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10">
                                </path>
                            </svg>
                        </button>
                    </div>
                </a>
                <div class="">

                    <?php

                    $articles = ORM::table('blog_posts')->select([
                        'blog_posts.*',
                        '(select name from categories where categories.id = blog_posts.category_id) as category_name',
                    ])->having('category_name', 'Article')->orderBy('created_at', 'desc')->get();

                    ?>

                    <div class="grid-container">
                        <?php foreach ($articles as $article) : ?>
                            <a href="/articles/<?= slugify($article->title, $article->id) ?>" class="grid-item " style="margin-top: 20px;">
                                <div class="collab_1">
                                    <div class="img_pro" style="text-align: left;">
                                        <img src="/uploads/<?= $article->thumbnail ?>" style="max-width: 100%;" alt="<?= $article->title ?>" class="collab_1">
                                    </div>
                                    <div class="collab_text_1">
                                        <p class="collab_text_main_1" style="text-align: left;">
                                            <?= $article->title ?>
                                            <br><br>
                                            <span style="font-weight: normal;">
                                                <?= $article->shortdesc ?>
                                                <br>
                                                See more...
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

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
</body>

</html>