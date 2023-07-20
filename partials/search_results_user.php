<a href="profil.php?user=<?= $user['id_user'] ?>" class="overflow-hidden mb-3" style="width:72px">
<?php if ($user['avatar'] !== null) { ?>
    <img src="assets/images/<?= $user['avatar'] ?>" class="border border-1 rounded-circle" style="width:48px; height:48px;">
<?php } else { ?>
    <div class="d-flex justify-content-center align-items-center border border-1 rounded-circle" style="width:48px; height:48px;">IN</div>
<?php } ?>
</a>
