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