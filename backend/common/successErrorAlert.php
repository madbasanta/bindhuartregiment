<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between" role="alert">
        <span class="message"><?= $_SESSION['success'] ?></span>
        <span class="time text-danger" data-cnt="10">10 sec</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php unset($_SESSION['success']);
endif; ?>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
        <span class="message">Error: <?= $_SESSION['error'] ?></span>
        <span class="time text-danger" data-cnt="10">10 sec</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php unset($_SESSION['error']);
endif; ?>

<script>
    setTimeout(() => {
        document.querySelector('.alert.alert-dismissible')?.remove();
    }, 10000);
    var timerInv = setInterval(() => {
        let timer = document.querySelector('.time');
        if(!timer) {
            return clearInterval(timerInv);
        }
        timer.textContent = (parseInt(timer.dataset.cnt) - 1) + ' sec';
        timer.setAttribute('data-cnt', parseInt(timer.dataset.cnt) - 1);
        if (parseInt(timer.dataset.cnt) === 0) {
            clearInterval(timerInv);
        }
    }, 1000);
</script>