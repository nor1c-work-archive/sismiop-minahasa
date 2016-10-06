<script type="text/javascript">
  function target_popup(form) {
    window.open('', 'formpopup', 'width=400,height=400,resizeable,scrollbars');
    form.target = 'formpopup';
  }
</script>

<form action="bayar.php" method="post" onsubmit="target_popup(this)">
    <!-- form fields etc here -->
    <input type="submit" name="name" value="Bayar">
</form>
