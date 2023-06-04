</div>

<script type="module">
  import Toastify from "../js/toastify-es.js";

  let sessionAlert = Toastify({
    text: "<?= $_SESSION["alert"] ?>",
    duration: 3000,
    close: true,
    gravity: "top", // `top` or `bottom`
    position: "center", // `left`, `center` or `right`
    stopOnFocus: true, // Prevents dismissing of toast on hover
    style: {
      background: "var(--accent)",
    },
    offset: {
      y: 30
    },
    onClick: function() {}, // Callback after click
  });

  <?php
  if (isset($_SESSION["alert"])) {
    echo "sessionAlert.showToast()";
    unset($_SESSION["alert"]);
  }
  ?>
</script>
</body>

</html>