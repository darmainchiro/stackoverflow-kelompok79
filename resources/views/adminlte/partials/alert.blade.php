<script>
    @if(session('success'))
    Swal.fire('success', "{{ session('success') }}", 'success')
    @endif
</script>