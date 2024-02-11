@if ($errors->any())
    @foreach ($errors->all() as $error )
        <div class="alert rounded-0 animate__animated animate__fadeInRight alert-dismissible fade show position-fixed" role="alert" style="z-index: 999; top: 25%; right: 10px; background-color: red;">
            <strong>{{ $error }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endforeach
@endif

@if ($message = Session::get('error'))
    <div class="alert error-message alert-danger rounded-0 animate__animated animate__fadeInRight alert-dismissible fade show position-fixed" role="alert" style="z-index: 999; top: 25%; right: 10px;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> 
@endif

@if ($message = Session::get('success'))
    <div class="alert success-message rounded-0 animate__animated animate__fadeInRight alert-dismissible fade show position-fixed" role="alert" style="z-index: 999; bottom: 10%; right: 10px; background-color: green;">
        <strong>{{ $message }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div> 
@endif



<script>
    // Auto-dismiss after 10 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('animate__fadeOutRight');
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 6000); // 10 seconds
    });
</script>

<style>
    .error-message {
        background-color: red !important;
        color: white;
    }

    .success-message{
        background-color: green !important;
        color: white;
    }
</style>