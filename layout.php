            <div class="pure-u-5-8">
                <div class="pure-u-1">
                    <h1><a target="_blank" href="<?= $main->getLink() ?>"><?= $main->getTitle() ?></a></h1>
                    <p><?= $main->getDescription() ?></p>
                    <p class="about">Publicado por <em><?= $main->getProvider() ?></em> el <?= $main->getDate() ?>.</p>
                </div>
                <?php foreach ($submain as $i => $article): ?>
                <div class="pure-u-2-5<?= ($i % 2 == 0) ? '' : ' right' ?>">
                    <h2><a target="_blank" href="<?= $article->getLink() ?>"><?= $article->getTitle() ?></a></h2>
                    <p><?= $article->getDescription() ?></p>
                    <p class="about">Publicado por <em><?= $article->getProvider() ?></em> el <?= $article->getDate() ?>.</p>
                </div>
                <?php endforeach; ?>
                <?php foreach ($important as $i => $article): ?>
                <div class="pure-u-2-5<?= ($i % 2 == 0) ? '' : ' right' ?>">
                    <h3><a target="_blank" href="<?= $article->getLink() ?>"><?= $article->getTitle() ?></a></h3>
                    <p><?= $article->getDescription() ?></p>
                <p class="about">Publicado por <em><?= $article->getProvider() ?></em> el <?= $article->getDate() ?>.</p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="pure-u-1-4 sidebar right">
                <h3>Más noticias</h3>
                <ul>
                <?php foreach ($news as $article): ?>
                    <li>
                        <a target="_blank" href="<?= $article->getLink() ?>"><?= $article->getTitle() ?></a>
                    <span class="about"><em><?= $article->getProvider() ?></em>, <?= $article->getDate() ?>.</span>
                    </li>
                <?php endforeach; ?>
            </div>
