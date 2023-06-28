import './bootstrap';

document.getElementById('sector-filter').addEventListener('change', function() {
    var url = new URL(window.location.href);
    var params = url.searchParams;
    params.set('sector', this.value);
    console.log(this.value);
    url.search = params.toString();
    window.location.href = url.toString();
});