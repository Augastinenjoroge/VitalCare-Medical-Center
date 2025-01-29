<?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        ?>
    </div>
<?php endif; ?>
