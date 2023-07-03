<script>
    $(document).ready(function() {
        window.onload = function() {
            jam();
        }

        var valDate = document.querySelector('#date')
        var month = document.querySelector('#month')
        var date = new Date()
        var bulan = ('Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember')
        bulan = bulan.split(" ")
        d = date.getDate()
        m = date.getMonth()
        y = date.getFullYear()

        valDate.append(d)
        $('#date').css('fontSize', '25px')
        $('#date').css('marginTop', '-5px')
        month.append(bulan[m].substr(0,3))
        $('#month').css('marginTop', '-12px')
        $('#month').css('fontSize', '25px')

        setInterval(function jam() {
            var dateTime = document.querySelector('#dateTime')
            var date = new Date(),
                h, m, s;
            h = date.getHours();
            m = set(date.getMinutes());
            s = set(date.getSeconds());

            dateTime.innerHTML = h + ':' + m + ':' + s;
            dateTime.style.fontSize = '12.5px'
            // dateTime.style.marginTop = '2px'
            dateTime.style.marginLeft = '2px'

        }, 1000)

        function set(dateTime) {
            dateTime = dateTime < 10 ? '0' + dateTime : dateTime;
            return dateTime;
        }
    })
</script>