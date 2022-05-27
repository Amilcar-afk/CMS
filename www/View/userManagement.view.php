<h1>Gestion utilisateurs</h1>
<?php
    $data = [
        $tableUsers->getTableUsers(),
        $users
    ];
    $this->includePartial("table", $data);
?>

<script>
    $.noConflict();
    jQuery(document).ready(function(){
        jQuery('#usersTab').DataTable();
    });
</script>


