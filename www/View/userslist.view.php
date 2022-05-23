<div class="col-12 row gris-background article-card row">
    <div class="main-color-background article-card col-offset-5">
        <h1 class=" article-card ">Users List</h1>
    </div>
    <div class="main-color-background article-card col-11 mt-2 row">
        <table class="second-color-background-default article-card col-12">
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>creation Date</th>
                <th>rank</th>
                <th colspan="2" class="text-center">Actions</th>






                
            </tr>
            <tbody>
                <?php foreach ($usersLIst as $user) { ?>
                    <tr>
                        <td><?= $user->firstname;?></td>
                        <td><?= $user->lastname;?></td>
                        <td><?= $user->email;?></td>
                        <td><?= $user->creationDate;?></td>
                        <td><?= $user->rank;?></td>
         
                    <td class="text-center">
                        <a class="btn btn-warning" href="">
                            <!-- <i class="fas fa-pen"></i> -->
                            <button>M</button>
                        </a>
                    </td>
                    <td  class="text-center">
                        <a class="btn btn-danger" href="/user_delete/id=2"
                            onclick="return confirm('Etes vous sûr de ...')">
                            <!-- <i class="fas fa-trash"></i> -->
                            <button>D</button>
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

