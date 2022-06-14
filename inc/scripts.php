<script src="../js/jquery-3.6.0.min.js"></script>
<script>
    var whichButClicked = 0;

    function saveWhatNext(x, y = 1) {
        if (x == 1) {
            if (y > 1)
                window.location.href = 'application-step' + (x - 1) + ".php";
        } else {
            whichButClicked = x;
        }
    }
</script>