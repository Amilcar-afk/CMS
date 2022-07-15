<section id="back-office-container">
    <header class="content-header">
        <nav>
            <?php if ( $newsletter->getStatus() != 'Public'): ?>
               <button class="cta-button cta-button--icon cta-button-undo"><span class="material-icons-round">undo</span></button>
               <button class="cta-button cta-button--icon cta-button-redo"><span class="material-icons-round">redo</span></button>
            <?php endif;?>
        </nav>
        <div>
            <label>
                Newsletter
                .
                <?=ucfirst($newsletter->getTitle())?>
            </label>
        </div>
        <div class="burger-menu-container">
            <button class="cta-button cta-button--menu-burger">
                <span class="material-icons-round">menu</span>
            </button>
            <nav>
                <?php if ( $newsletter->getStatus() != 'Public'): ?>
                    <button class="cta-button cta-button--text-icon cta-button-save" data-status="Draft" data-newsletter-id="<?=$newsletter->getId()?>"><span class="material-icons-round">save</span>Save</button>
                    <a href="" class="cta-button cta-button--text-icon cta-button-save" data-status="Public" data-newsletter-id="<?=$newsletter->getId()?>"><span class="material-icons-round">send</span>Published</a>
                <?php endif;?>
            </nav>
        </div>
    </header>
    <section id="container-editor" class="container-main-content container-main-content--padding" >
        <div class="row body-small">
            <main>
                <section class="container-main-content container-main-content--setup" >
                    <header>
                        <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
                        <h1 class="title title--main-color"><?= (isset($siteName)) ? $siteName : "" ?></h1>
                    </header>
                    <div style="width: 100%">
                        <?php foreach ($message as $element):?>
                            <?php if ($element["type"] == "title"):?>
                                <div class="module" data-module-type="title" style="padding:0px;margin-bottom:30px;margin-top:30px;width:100%;font-size:20px;font-weight:bold;line-height:24px;text-align:left;"><?= $element['content'] ?></div>
                            <?php elseif ($element["type"] == "text"):?>
                                <div class="module" data-module-type="text" style="padding:0px;width:100%;font-size:16px;font-weight:400;line-height:24px;"><?= $element['content'] ?></div>
                            <?php elseif ($element["type"] == "button"):?>
                                <button data-module-type="button" href="<?= $element['link'] ?>" style="width: 100%" class="module cta-button cta-button--submit" target="_blank"> <?= $element['content'] ?> </button>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </section>
                <tbody>
                <tr>
                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:11px;font-weight:400;line-height:16px;text-align:center;color:#445566;">You are receiving this email because you registered.</div>
                    </td>
                </tr>
                <tr>
                    <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                        <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:11px;font-weight:400;line-height:16px;text-align:center;color:#445566;">&copy; All Rights Reserved.</div>
                    </td>
                </tr>
                </tbody>
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style width="100%">
                    <tbody>
                    <tr>
                        <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                            <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:11px;font-weight:bold;line-height:16px;text-align:center;color:#445566;"><a class="footer-link" href="https://www.google.com" style="color: #888888;">Unsubscribe</a></div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </section>
</section>