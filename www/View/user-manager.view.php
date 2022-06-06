<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color">SITE MAP</h1>
            <nav>
                <a href="/settings/user-manager" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="user-manager-container"><span class="material-icons-round">supervisor_account</span>User manager</a>
                <a href="/settings/style" class="cta-button cta-button--menu main-nav-choice" data-wc-target="style-container"><span class="material-icons-round">brush</span>Style</a>
                <a href="/settings/database" class="cta-button cta-button--menu main-nav-choice" data-wc-target="database-container"><span class="material-icons-round">cloud</span>Database</a>
                <a href="/settings/media-library" class="cta-button cta-button--menu main-nav-choice" data-wc-target="media-library-container"><span class="material-icons-round">video_library</span>Media library</a>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="user-manager-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">USER MANAGER</h1>
                </header>

                <article>
                    <table id="usersTab" class="display">
                        <thead>
                        <tr>
                            <th>
                                Fisrtname
                            </th>
                            <th>
                                Lastname
                            </th>
                            <th>
                                Email
                            </th>
                            <th>
                                Creation date
                            </th>
                            <th>
                                Rank
                            </th>
                            <th>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($users as $user):?>
                            <tr>
                                <td>
                                    <?=$user->getFirstname()?>
                                </td>
                                <td>
                                    <?=$user->getLastname()?>
                                </td>
                                <td>
                                    <?=$user->getMail()?>
                                </td>
                                <td>

                                </td>
                                <td>
                                    <?=$user->getRank()?>
                                </td>
                                <td>
                                    <button class="cta-button cta-button-a" data-a-target="container-setting-navigation-<?=$user->getId() ?>"><span class="material-icons-round">delete</span></button>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>

                    <script>
                        $(document).ready(function () {
                            $('#usersTab').DataTable();
                        });
                    </script>
                </article>

            </div>

        </section>
    </section>

</section>