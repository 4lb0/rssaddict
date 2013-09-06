<html>
    <head>
        <link rel="stylesheet" href="http://yui.yahooapis.com/combo?pure/0.2.1/base-min.css&pure/0.2.1/grids-min.css&pure/0.2.1/menus-min.css">
        <link rel="stylesheet" href="<?= link_to('style.css') ?>">
        <title><?= $title ?> | <?= $config['_site']['label'] ?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
    </head>
    <body>

        <div class="pure-g-r" id="layout">
            <div class="pure-u-1" id="menu">
                <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <a class="pure-menu-heading" href="<?= link_to('') ?>"><?= $config['_site']['label'] ?></a>
                    <ul>
                        <li<?php if ($section === false): ?> class="pure-menu-selected"<?php endif; ?>>
                            <a href="<?= link_to('') ?>">Portada</a>
                        </li>
                    <?php foreach ($config['_sections'] as $name => $label): ?> 
                        <?php if (!configIsSpecial($name)): ?>
                        <li<?php if ($section == $name): ?> class="pure-menu-selected"<?php endif; ?>>
                        <a href="<?= link_to($name . '/') ?>"><?= $label ?></a>
                        </li>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
