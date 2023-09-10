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
        Welcome to our podcast section, where we explore the world of community-based art, collaborative projects,
        poetry, and more. In this series, we'll take you on a journey through the creative minds of artists and poets
        who are using their ideas to create something. We'll hear from poets, visual artists, performance artist ,
        musician , filmmakers and more as they discuss their work and the impact it has on the world around them. From
        collaborative art projects to poetry slams, we'll delve into the many ways that art can bring people together
        and inspire change. Join us as we explore the power of creativity to transform the scene of art in our
        community.
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
                    <a href="#podcast?id=<?= $podcast->id ?>" style="display: flex;align-items:center">
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