<h1>Gestion utilisateurs</h1>
<?php
    $data = [
        $tableUsers->getTableUsers(),
        $users
    ];
    $this->includePartial("table", $data);
?>

<script>
    $(document).ready(function () {
        $('#usersTab').DataTable();
    });
</script>
