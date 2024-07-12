<script src="js/sweetalert.js"></script>

<script>
            swal({
                title: "<?php echo $_SESSION['status']; ?>",

                icon: "<?php echo $_SESSION['status_code']; ?>",
                button: "Ok, Done",
            });
        </script>
        