<script>
    @if(session('success'))
    Swal.fire('success', "{{ session('success') }}", 'success')
    @elseif(session('error'))
    Swal.fire('error', "{{ session('error') }}", 'error')
    @endif
</script>