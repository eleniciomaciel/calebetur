<footer class="footer">
    <div class="container-fluid">
        <div class="copyright float-right" id="date">
            , T&E Consultoria <i class="material-icons">favorite</i> by
            <a href="#" target="_blank">Soluções Web</a> para sua gestão.
        </div>
    </div>
</footer>
<script>
    const x = new Date().getFullYear();
    let date = document.getElementById('date');
    date.innerHTML = '&copy; ' + x + date.innerHTML;
</script>