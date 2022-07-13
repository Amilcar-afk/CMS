<section id="back-office-container">
    <section class="container-main-content container-main-content--menu">
        <div class="menu-container">
            <h1 class="title title--main-color place-menu">SETTINGS</h1>
            <nav>
                <a href="/settings/user-manager" class="cta-button cta-button--menu main-nav-choice selected" data-wc-target="user-manager-container"><span class="material-icons-round">supervisor_account</span>User manager</a>
                <?php if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin'): ?>
                    <a href="/settings/style" class="cta-button cta-button--menu main-nav-choice" data-wc-target="style-container"><span class="material-icons-round">brush</span>Style</a>
                    <a href="/settings/configuration" class="cta-button cta-button--menu main-nav-choice" data-wc-target="database-container"><span class="material-icons-round">cloud</span>Configuration</a>
                    <a href="/settings/media-library" class="cta-button cta-button--menu main-nav-choice" data-wc-target="media-library-container"><span class="material-icons-round">video_library</span>Media library</a>
                <?php endif; ?>
            </nav>
        </div>
        <section class="collapse-parent">

            <div id="user-manager-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1">
                <header>
                    <h1 class="title title--black">USER MANAGER</h1>
                </header>

                <button class="cta-button-user-update-class cta-button cta-button-a cta-button--submit cta-button--submit--add " data-a-target="container-my-profile">
                    My Profile
                </button>

                <?php if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin'): ?>
                    <button class="cta-button-user-compose-class cta-button cta-button-a cta-button--submit cta-button--submit--add" data-a-target="container-new-user">
                            New User
                    </button>
                    <article>
                        <table id="usersTab" class="table display">
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
                                            <span style="font-size: 1rem"><?=$user->getRank()?></span>
                                            <?php
                                                if($user->getRank() === "admin"){
                                                    echo '<button data-id-user='.$user->getId().' style="margin-left: 5px" onclick="updateRank(this)">User</button>';
                                                }else{
                                                    echo '<button data-id-user='.$user->getId().' style="margin-left: 5px" onclick="updateRank(this)">Admin</button>';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <button class="cta-button cta-button-a" data-a-target="container-setting-navigation-<?=$user->getId() ?>" data-id-user="<?=$user->getId()?>"><span class="material-icons-round" onclick="deleteUser(this.parentNode)">delete</span></button>
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
                <?php endif;?>
            </div>
        </section>
        <div id="addUser-container" class="collapse--open" data-group-collapse="section-container" style="opacity: 1"></div>
    </section>

    <?php if(isset($_SESSION['Auth']) && $_SESSION['Auth']->rank == 'admin'): ?>

        <section id="container-new-user" class="container-main-content container-main-content--menu a-zoom-out-end">
            <button id="cta-button-close-container-new-user" class="cta-button cta-button--icon cta-button-a" data-a-target="container-new-user"><span class="material-icons-round">close</span></button>
            <div class="menu-container"></div>
            <section class="collapse-parent">
                <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                    <header>
                        <h1 class="title title--black">NEW USER</h1>
                        <p>Until that the account is not confirmed by email it will not be visible</p>
                    </header>

                    <article class="composeUser_class calendar_article2 col-6">
                            <?php $this->includePartial("form", $newuser->userCompose('cta-button-compose-user')) ?>
                    </article>
                </div>
            </section>
        </section>
    <?php endif;?>


    <section id="container-my-profile" class="container-main-content container-main-content--menu a-zoom-out-end">
        <button id="cta-button-close-container-my-profile" class="cta-button cta-button--icon cta-button-a" data-a-target="container-my-profile"><span class="material-icons-round">close</span></button>
        <div class="menu-container"></div>
        <section class="collapse-parent">
            <div id="text-elements-container" class="collapse--open" data-group-collapse="add-elements-conatiner">
                <header>
                    <h1 class="title title--black">MY PROFILE</h1>
                </header>

                <article class="composeUpdate_class calendar_article2 col-6">
                        <?php $this->includePartial("form", $newuser->updateUser()) ?>
                </article>
            </div>
        </section>
    </section>

</section>
