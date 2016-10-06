<table>
<td>
<?php

for ($i=1; $i <= 24; $i++) { ?>

  <?php if ($i <= 12) { ?>
      <?php echo "$i <br>" ?>
<?php } } ?>
</td>

<td>
<?php

for ($i=1; $i <= 24; $i++) { ?>
  <?php if ($i > 12) { ?>
      <?php echo "$i <br>" ?>
<?php } } ?>
</td>
</table>
