<style>
    :root {
        --main-color: #396075;
        --second-color: #55a6d3;
        --third-color: #9BBCFF;
        --background-color: white;

        --bessels: 1200px;
        --shadow: 0px 0px 15px rgba(0, 0, 0, 0.78);

    }
</style>
<h1>S'inscrire</h1>

<?php $this->includePartial("form", $user->getFormRegister()) ?>

