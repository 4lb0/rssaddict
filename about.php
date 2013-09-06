            <div class="pure-u-1">
                <h1><?= $config['_site']['about'] ?> <?= $config['_site']['label'] ?></h1>
                <p>Poweready by <strong><a href="<?= $config['_app']['site'] ?>"><?= $config['_app']['name'] ?></a></strong>. Design by <a href="http://purecss.io/">Pure</a>.</p>
                <h2>RSS list</h2>
                <ul>
<?php foreach ($config as $provider => $urls): ?>
<?php if (!configIsSpecial($provider)): ?>
                <li>
                    <h3><?= $urls['_label'] ?></h3>
                    <ul>
<?php foreach ($urls as $section => $url): ?>
<?php if (!configIsSpecial($section)): ?>
                    <li><a href="<?= $url ?>"><?= $section ?></a></li>
                <?php endif; ?>
                <?php endforeach; ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php endforeach; ?>
                </ul>
            </div>
