<script src="../js/jquery-3.6.0.min.js"></script>
<script>
    var whichButClicked = 0;

    function whatNext(x, y = 1) {
        if (x == 0) {
            if (y > 1)
                window.location.href = 'application-step' + (y - 1) + ".php";
        } else {
            whichButClicked = x;
        }
    }

    function save(d, k) {
        $.ajax({
            type: "POST",
            url: "../api/save/" + k,
            data: d,
            contentType: false,
            cache: false,
            processData: false,
            success: function(result) {
                console.log(result);
                if (result["response"] == "success") {
                    if (whichButClicked > 1)
                        window.location.href = 'application-step' + whichButClicked + '.php';
                    else
                        window.location.href = '?logout=true';
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
</script>