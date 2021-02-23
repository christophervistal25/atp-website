<button id="export_p_list">Export Personnel List</button>
<button id="export_p_total">Export Personnel Total</button>
<script>
    document.querySelector('#export_p_list').addEventListener('click', () => window.location.href = '/admin/personnel/list/download');

    document.querySelector('#export_p_total').addEventListener('click', () => window.location.href = '/admin/personnel/total/download/');
</script>