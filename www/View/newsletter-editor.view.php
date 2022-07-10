<section id="back-office-container">
    <header class="content-header">
        <nav>
            <button class="cta-button cta-button--icon cta-button-undo"><span class="material-icons-round">undo</span></button>
            <button class="cta-button cta-button--icon cta-button-redo"><span class="material-icons-round">redo</span></button>
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
                <a href="/newsletterloader/<?= $newsletter->getId() ?>" target="_blank" class="cta-button cta-button--text-icon"><span class="material-icons-round">visibility</span>Preview</a>
                <button class="cta-button cta-button--text-icon cta-button-save" data-newsletter-id="<?=$newsletter->getId()?>"><span class="material-icons-round">save</span>Save</button>
                <?php if ( $newsletter->getStatus() != 'Public'): ?>
                    <a href="" class="cta-button cta-button--text-icon"><span class="material-icons-round">send</span>Published</a>
                <?php endif;?>
            </nav>
        </div>
    </header>
    <section id="container-editor" class="container-main-content container-main-content--padding" >
        <div class="row body-small">
            <?=$newsletter->getContent()?>
            <?php
            $message = [
                [
                    "type"=>'title',
                    "content"=>'Registration confirmation'
                ],
                [
                    "type"=>'text',
                    "content"=>"Welcome . To confirm your email address"
                ],
                [
                    "type"=>'button',
                    "link"=>'gjhjh',
                    "content"=>'Click here'
                ]
            ];
            ?>
            <main>
                <section class="container-main-content container-main-content--setup" >
                    <header>
                        <figure id="back-office-logo"><img src="<?= (isset($logo[0])) ? $logo[0]->getPath() :'/style/images/logo_myfolio.png'  ?>" alt="logo"></figure>
                        <h1 class="title title--main-color">Log In</h1>
                    </header>
                    <div>
                        <?php foreach ($message as $element):?>
                            <?php if ($element["type"] == "title"):?>
                                <tr>
                                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                        <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:20px;font-weight:bold;line-height:24px;text-align:left;color:#212b35;"><?= $element['content'] ?></div>
                                    </td>
                                </tr>
                            <?php elseif ($element["type"] == "text"):?>
                                <tr>
                                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                        <div style="font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#637381;"><?= $element['content'] ?></div>
                                    </td>
                                </tr>
                            <?php elseif ($element["type"] == "button"):?>
                                <tr>
                                    <td align="center" vertical-align="middle" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;width:300px;line-height:100%;">
                                            <tr>
                                                <td align="center" bgcolor="var(--main-color, #396075)" role="presentation" style="border:none;border-radius:3px;cursor:auto;mso-padding-alt:10px 25px;background:var(--main-color, #396075);" valign="middle">
                                                    <a href="<?= $element['link'] ?>" style="display:inline-block;width:250px;background:var(--main-color, #396075);color:var(--background-color, #ffffff);font-family:'Helvetica Neue', Helvetica, Arial, sans-serif;font-size:17px;font-weight:bold;line-height:120%;margin:0;text-decoration:none;text-transform:none;padding:10px 25px;mso-padding-alt:0px;border-radius:3px;" target="_blank"> <?= $element['content'] ?> </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php endif;?>
                        <?php endforeach;?>
                    </div>
                </section>
            </main>
        </div>
    </section>
    <?php include "Partial/component-list.view.php";?>
</section>