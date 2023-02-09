<?php
if ($this->alerts) {
    foreach ($this->alerts as $alert) { ?>
        <div class="alert alert-<?= $alert['type'] ?> alert-dismissible fade show" role="alert" style="
  position: fixed;
  z-index: 10;
  left : 10%;
  width: 80%;
  bottom: 0;">
            <span>
                <?= $alert['message'] ?>
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }
}
?>
</div>
</div>
</body>
</html>