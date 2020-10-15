<script>
    function pridejNulu(d) {
        return (d < 10 ? '0' : '') + d;
    }

    window.onload = function() {
        var dnes = new Date();
        var ddmm = pridejNulu(dnes.getDate()) + pridejNulu(dnes.getMonth() + 1);
        

        $.ajax({
            type: 'GET',
            crossDomain: true,
            dataType: 'json',
            /* url:'https://svatky.adresa.info/json?date=0101&lang=cs', */
            url: 'https://svatky.adresa.info/json?date=' + ddmm + '&lang=cs',

            success: function(data) {
            
                document.getElementById('svatek').innerText = data[0].name
            }
        })
    }
</script>